<?php

require_once dirname(__FILE__) . '/../lib/profesionalesListaBlancaGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/profesionalesListaBlancaGeneratorHelper.class.php';

/**
 * profesionalesListaBlanca actions.
 *
 * @package    symfony
 * @subpackage profesionalesListaBlanca
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profesionalesListaBlancaActions extends autoProfesionalesListaBlancaActions {

    public function executeLista(sfWebRequest $request) {
        $this->setTemplate('index');
        $this->executeIndex($request);
    }

    public function executeAutocompleteDireccion(sfWebRequest $request) {
        $results = ProfesionalTable::getInstance()->getAutocompleteDireccion($request->getParameter('q'));

        foreach ($results as $result) {
            $html[] = $result['direccion'];
        }

        ProjectUtility::decorateJsonResponse($this->getResponse());
        return $this->renderText(json_encode($html));
    }

    public function executeAutocompleteName(sfWebRequest $request) {
        $results = ProfesionalTable::getInstance()->getAutocompleteName($request->getParameter('q'));
        $html = array();
        foreach ($results as $result) {
            $html[] = $result['name'];
        }
        ProjectUtility::decorateJsonResponse($this->getResponse());

        return $this->renderText(json_encode($html));
    }

    protected function buildQuery() {
        switch ($this->getActionName()) {
            case 'lista':
                $tableMethod = 'getListaQuery';
                break;

            default:
                $tableMethod = $this->configuration->getTableMethod();
                break;
        }
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $this->addSortQuery($query);

        $request = sfContext::getInstance()->getRequest();

        if(! $request->hasParameter('sort') && ! $request->hasParameter('sort_type'))
        {
          $query->orderBy('created_at DESC');
        }


        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

    /**
     * Muestra todos las respuestas a los cuestionarios
     *
     * @param sfWebRequest $request
     */
    public function executeListCuestionarios(sfWebRequest $request) {
        $empresa = Doctrine_Core::getTable('Empresa')->find($request->getParameter('id'));
        $this->respuestas = $empresa->getCuestionarios($request->getParameter('aprobados', 1));
    }

    /**
     *
     */
    public function executeShow(sfWebRequest $request) {
        $this->profesional = Doctrine_Core::getTable('Profesional')->find($request->getParameter('id'));

        $this->n_profesional_destacados = Doctrine::getTable('profesional')
                ->createQuery('p')
                ->where('p.destacado = true')
                ->andWhere('p.profesional_estado_id=2 or p.profesional_estado_id=3')
                ->count();

        $this->n_profesional_destacados_tiempo = array();
        $this->n_profesional_destacados_tiempo[1] = Doctrine::getTable('ProfesionalDestacadosTemporales')
                ->createQuery('p')
                ->andWhere('tipo_tiempo_id=1')
                ->count();
        $this->n_profesional_destacados_tiempo[2] = Doctrine::getTable('ProfesionalDestacadosTemporales')
                ->createQuery('p')
                ->andWhere('tipo_tiempo_id=2')
                ->count();
        $this->n_profesional_destacados_tiempo[3] = Doctrine::getTable('ProfesionalDestacadosTemporales')
                ->createQuery('p')
                ->andWhere('tipo_tiempo_id=3')
                ->count();

        $this->n_contribuciones_destacados = Doctrine::getTable('contribucion')
                ->createQuery('p')
                ->where('p.concurso_id=?', $this->profesional->getId())
                ->andWhere('p.destacado=1')
                ->count();

        $this->puntos = Doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic = true')->execute();

        $this->arr_cambios_estados_reactivaciones = $this->profesional->getArrFechasReactivaciones();
        $this->arr_cambios_estados_revisiones = $this->profesional->getArrFechasRevisiones();
    }

    /**
     *
     * @param sfWebRequest $request
     */
    public function executeDestacadoManager(sfWebRequest $request) {
        $this->profesional = Doctrine_Core::getTable('Profesional')->find($request->getParameter('id'));
    }

    /**
     * A�ade o quita la empresa como destacada
     *
     * @param sfWebRequest $request
     */
    public function executeToggleDestacar(sfWebRequest $request) {
        $tipo = $request->getParameter('tipo');
        /** @var Profesional $profesional  */
        $profesional = Doctrine_Core::getTable('Profesional')->find($request->getParameter('id'));

        switch ($tipo) {
            case 'sector':
                if ($profesional->isDestacadaPorSector()) {
                    $profesionalDestacada = Doctrine_Core::getTable('ProfesionalDestacada')->findByProfesionalIdAndSector($request->getParameter('id'));
                    $profesionalDestacada->delete();
                    return $this->redirect('profesional_show_destacados', array('id' => $profesional->getId()));
                } else {
                    //test if there're 5...
                    if (Doctrine_Core::getTable('ProfesionalDestacada')->countProfesionalSector($profesional) >= sfConfig::get('app_backend_max_destacados', 5)) {
                        $this->getUser()->setFlash('msg', 'Solo puedes destacar hasta 5 profesionales por actividad');
                        return $this->redirect('profesional_show_destacados', array('id' => $profesional->getId()));
                    }
                    $profesionalDestacada = $this->prepareProfesionalDestacada($request->getParameter('id'));
                    if (!$profesional->getProfesionalTipoTres()->isNew()) {
                        $profesionalDestacada->setProfesionalTipoTresId($profesional->getProfesionalTipoTres()->getId());
                    } else {
                        $profesionalDestacada->setProfesionalTipoDosId($profesional->getProfesionalTipoDos()->getId());
                    }
                }

                break;

            case 'provincia':
                if ($profesional->isDestacadaPorProvincia()) {
                    $profesionalDestacada = Doctrine_Core::getTable('ProfesionalDestacada')->findByProfesionalIdAndProvincia($request->getParameter('id'));
                    $profesionalDestacada->delete();
                    return $this->redirect('profesional_show_destacados', array('id' => $profesional->getId()));
                } else {
                    //test if there're 5...
                    if (Doctrine_Core::getTable('ProfesionalDestacada')->countProfesionalProvincia($profesional->getStatesId()) >= sfConfig::get('app_backend_max_destacados', 5)) {
                        $this->getUser()->setFlash('msg', 'Solo puedes destacar hasta 5 profesionales por provincia');
                        return $this->redirect('profesional_show_destacados', array('id' => $profesional->getId()));
                    }

                    $profesionalDestacada = $this->prepareProfesionalDestacada($request->getParameter('id'));
                    $profesionalDestacada->setStatesId($profesional->getStatesId());
                }
                break;

            case 'localidad':
                if ($profesional->isDestacadaPorLocalidad()) {
                    $profesionalDestacada = Doctrine_Core::getTable('ProfesionalDestacada')->findByProfesionalIdAndLocalidad($request->getParameter('id'));
                    $profesionalDestacada->delete();
                    return $this->redirect('profesional_show_destacados', array('id' => $profesional->getId()));
                } else {
                    if (Doctrine_Core::getTable('ProfesionalDestacada')->countProfesionalLocalidad($profesional->getCityId()) >= sfConfig::get('app_backend_max_destacados', 5)) {
                        $this->getUser()->setFlash('msg', 'Solo puedes destacar hasta 5 profesionales por localidad');
                        return $this->redirect('profesional_show_destacados', array('id' => $profesional->getId()));
                    }
                    $profesionalDestacada = $this->prepareProfesionalDestacada($request->getParameter('id'));
                    $profesionalDestacada->setCityId($profesional->getCityId());
                    $profesionalDestacada->setCombinado(Profesional::COMBINADO_NULO);
                }
                break;

            case 'sector_provincia':
                if ($profesional->isDestacadaPorSectorProvincia()) {
                    //borra destacado
                    $profesionalDestacada = Doctrine_Core::getTable('ProfesionalDestacada')->findByProfesionalIdAndSectorProvincia($request->getParameter('id'));
                    $profesionalDestacada->delete();
                    return $this->redirect('profesional_show_destacados', array('id' => $profesional->getId()));
                } else {
                    if (Doctrine_Core::getTable('ProfesionalDestacada')->countProfesionalSectorProvincia($profesional) >= sfConfig::get('app_backend_max_destacados', 5)) {
                        $this->getUser()->setFlash('msg', 'Solo puedes destacar hasta 5 profesionales por actividad y provincia');
                        return $this->redirect('profesional_show_destacados', array('id' => $profesional->getId()));
                    }
                    $profesionalDestacada = $this->prepareProfesionalDestacada($request->getParameter('id'));
                    $profesionalDestacada->setStatesId($profesional->getStatesId());
                    $profesionalDestacada->setCombinado(Profesional::COMBINADO_PROVINCIA);
                    if (!$profesional->getProfesionalTipoTres()->isNew()) {
                        $profesionalDestacada->setProfesionalTipoTresId($profesional->getProfesionalTipoTres()->getId());
                    } else {
                        $profesionalDestacada->setProfesionalTipoDosId($profesional->getProfesionalTipoDos()->getId());
                    }
                }
                break;

            case 'sector_localidad':
                if ($profesional->isDestacadaPorSectorLocalidad()) {
                    //borra destacado
                    $profesionalDestacada = Doctrine_Core::getTable('ProfesionalDestacada')->findByProfesionalIdAndSectorLocalidad($request->getParameter('id'));
                    $profesionalDestacada->delete();
                    return $this->redirect('profesional_show_destacados', array('id' => $profesional->getId()));
                } else {
                    if (Doctrine_Core::getTable('ProfesionalDestacada')->countProfesionalSectorLocalidad($profesional) >= sfConfig::get('app_backend_max_destacados', 5)) {
                        $this->getUser()->setFlash('msg', 'Solo puedes destacar hasta 5 profesionales por actividad y localidad');
                        return $this->redirect('profesional_show_destacados', array('id' => $profesional->getId()));
                    }
                    $profesionalDestacada = $this->prepareProfesionalDestacada($request->getParameter('id'));
                    $profesionalDestacada->setCityId($profesional->getCityId());
                    $profesionalDestacada->setCombinado(Profesional::COMBINADO_LOCALIDAD);
                    if (!$profesional->getProfesionalTipoTres()->isNew()) {
                        $profesionalDestacada->setProfesionalTipoTresId($profesional->getProfesionalTipoTres()->getId());
                    } else {
                        $profesionalDestacada->setProfesionalTipoDosId($profesional->getProfesionalTipoDos()->getId());
                    }
                }
                break;
        }

        $profesionalDestacada->setRank(ProfesionalDestacadaTable::getLastRank($profesional, $tipo) + 1);
        $profesionalDestacada->save();

        return $this->redirect('profesional_show_destacados', array('id' => $profesional->getId()));
    }

    protected function prepareProfesionalDestacada($id) {
        $profesionalDestacada = new ProfesionalDestacada();
        $profesionalDestacada->setProfesionalId($id);
        return $profesionalDestacada;
    }

    public function executeSortDestacado(sfWebRequest $request) {
        $profesional = $request->getParameter('elements');
        $profesional = array_map(function($value) {
                    return substr($value, 8);
                }, $profesional);
        $params = substr($request->getParameter('type'), 10);
        preg_match('#([A-Za-z_]+)_([0-9]+)#', $params, $type);
        ProfesionalDestacadaTable::getInstance()->setOrder($type[1], $type[2], $profesional);

        ProjectUtility::decorateJsonResponse($this->getResponse());
        return $this->renderText('');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $profesional = $form->save();

                $asValues = $request->getParameter($form->getName());
                ProfesionalLetter::addProfesionalLetter($profesional, $asValues);
            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ? 's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $profesional)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@profesional_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);
                $this->redirect(array('sf_route' => 'profesional_lista'));
            }
        } else {
            $gform = $form->getEmbeddedForm('profesionalGoogleMap');
            $gformValues = $form->getTaintedValues();
            $gform->setDefaults(array('address' => 'de'));
            $gform->bind($gformValues['profesionalGoogleMap'], array());
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        //test if there a product with this cuestionario
        $cuestionario = $this->getRoute()->getObject();
        try {
            $cuestionario->delete();
            $this->getUser()->setFlash('notice', 'Se ha borrado la empresa correctamente.');
        } catch (Doctrine_Connection_Mysql_Exception $e) {
            $this->getUser()->setFlash('error', 'No se puede borrar esta empresa porqu� tiene concursos o cuestionarios asociados');
        }

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));


        $this->redirect('@empresa');
    }

    public function executeRechazar(sfWebRequest $request) {
        $this->profesional = Doctrine::getTable("Profesional")->findOneById($request->getParameter("id"));
        $this->form = new ContactProfesionalSimpleForm(array(), array('subject' => "Tu profesional en auditoscopia ha sido rechazado. Necesitas corregirlo", "profesional" => $this->profesional));
    }

    public function executeContacted(sfWebRequest $request) {
        $this->profesional = Doctrine::getTable("Profesional")->findOneById($request->getParameter("profesional_id"));

        $this->form = new ContactProfesionalSimpleForm(array(), array('subject' => "Tu profesional no cumple con las condiciones de participaci�n. Por favor �corr�gelo!", "profesional" => $this->profesional));
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->processContactForm($request, $this->form, $this->type);
        $this->setTemplate("rechazar");
    }

    protected function processContactForm(sfWebRequest $request, sfForm $form, $type) {
        $form->bind($request->getParameter($form->getName()));
        if ($form->isValid()) {
            $user = Doctrine::getTable("sfGuardUser")->findOneById($this->form->getValue("user_id"));
            $profesional = Doctrine::getTable("Profesional")->findOneById($this->form->getValue("profesional_id"));
            $to = array($user->email_address);
            $from = sfConfig::get('app_default_mailfrom');
            $subject = $this->form->getValue("subject");
            $body = $this->form->getValue("body");
            $this->sendMail($to, $from, $subject, $body);
            $this->getUser()->setFlash('notice', 'Se ha enviado el correo electr�nico a la/el usuaria/o ' . $user->username);
            $this->redirect("profesionales_pendientes/changeStatus?id=" . $profesional->id . "&estado=9");
        }
    }

    public function sendMail($to, $from, $subject, $body, $consumer = null, $group = null) {
        $mensaje = Swift_Message::newInstance();
        $mensaje->setFrom($from);
        $mensaje->setTo($to);
        $mensaje->setSubject($subject);
        $mensaje->setBody($body);

        $mensaje->setBody($body);

        $this->getMailer()->send($mensaje);
    }

    public function executeChangeStatus(sfWebRequest $request) {
        $this->forward404Unless($estado = $request->getParameter("estado"), 'Es necesario indicar el nuevo estado.');
        $this->forward404Unless($id = $request->getParameter("id"), 'Es necesario indicar el id del profesional.');

        $this->profesional = $this->getRoute()->getObject();
        $last = $this->profesional->getProfesionalEstadoId();
        $this->profesional->setProfesionalEstadoId($request->getParameter("estado"));

        if ($estado == 2) {
            //hay que mandar una notificaci�n a los usurios configurados

            /* if($notifificaciones = Doctrine::getTable('UserNotification')
              ->createQuery()
              ->where('publica_profesional_value=1')
              ->execute()){
              foreach ($notifificaciones as $not)
              $not->getUser()->sendNotification_NewProfesional($this->concurso);
              } */

            $this->profesional->setFechaActivacion(date('Y-m-d'));

            //los puntos
            $codigos = Doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic=true')->execute();
            foreach ($codigos as $codigo) {
                if ($request->getParameter($codigo->getCodigo())) {
                    $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo($codigo->getCodigo());

                    $this->profesional->getUser()->getProfile()->setPuntos($puntos);
                    ColaboradorPuntosHistoricoTable::new_log($this->profesional->getUserId(), $codigo->getDescripcion(), $puntos, 'profesional', $this->profesional->getId());
                }
            }
        } elseif ($estado == 3)
            $this->profesional->setFechaReferendum(date('Y-m-d'));
        elseif ($estado == 4)
            $this->profesional->setFechaDeliberacion(date('Y-m-d H:i:s'));
        elseif ($estado == 5)
            $this->profesional->setFechaObservacion(date('Y-m-d H:i:s'));
        elseif ($estado == 6)
            $this->profesional->setFechaCerrado(date('Y-m-d H:i:s'));
        elseif ($estado == 7)
            $this->profesional->setFechaRechazado(date('Y-m-d H:i:s'));
        elseif ($estado == 8)
            $this->profesional->setFechaNulo(date('Y-m-d H:i:s'));
        elseif ($estado == 10) {
            $this->profesional->setFechaRevision(date('Y-m-d H:i:s'));
            $this->profesional->setRevisionLastStateId($last);
        }

        $this->profesional->save();

        // guardamos en el hist�rico cada cambio de estado
        $profesional_historico = new ProfesionalHistorico();
        $profesional_historico->setProfesionalId($this->profesional->getId());
        $profesional_historico->setDate(date('Y-m-d H:i:s'));
        $profesional_historico->setEstadoInicial($last);
        $profesional_historico->setEstadoFinal($estado);
        $profesional_historico->save();

        /* if ($estado==2)
          {
          $this->redirect("profesionalLista/show?id=".$this->profesional->id);
          } else {
          $this->redirect("profesionales_pendientes/show?id=".$this->profesional->id);
          } */
        $this->redirect("profesionalLista/show?id=" . $this->profesional->id);
    }

    public function executeDestacar(sfWebRequest $request) {
        /* $n_concursos_destacados = Doctrine::getTable('concurso')
          ->createQuery('c')
          ->leftJoin('c.ConcursoEstado e')
          ->where('e.value=2')
          ->orWhere('e.value=3')
          ->orWhere('e.value=4')
          ->orWhere('e.value=5')
          ->count(); */
        /* $n_concursos_destacados = Doctrine::getTable('ConcursosDestacadosTemporales')
          ->createQuery('c')
          ->leftJoin('c.Concurso con')
          ->leftJoin('con.ConcursoEstado e')
          ->where('e.value=2')
          ->orWhere('e.value=3')
          ->orWhere('e.value=4')
          ->orWhere('e.value=5')
          ->andWhere('tipo_tiempo_id=?', $request->getParameter("tiempo"))
          ->count();

          if($n_concursos_destacados>10)
          $this->forward404('Has sobrepasado el n� m�x de concursos destacados.'); */

        if ($request->getParameter("tipo") == "temporal") {
            $this->forward404Unless($request->getParameter("tiempo"));
            $this->profesional_destacado = new ProfesionalDestacadosTemporales();
            $this->profesional_destacado->profesional_id = $request->getParameter("profesional_id");
            $this->profesional_destacado->tipo_tiempo_id = $request->getParameter("tiempo");
            $this->profesional_destacado->created_at = date("Y-m-d H:i:s");
            $this->profesional_destacado->updated_at = date("Y-m-d H:i:s");
            /* if ($concurso_previo=$this->profesional_destacado->existsOtherInTime($request->getParameter("tiempo")))
              {
              $concurso_previo->delete();
              } */
            $this->profesional_destacado->save();
            $this->redirect("profesionalLista/show?id=" . $this->profesional_destacado->profesional_id);
        } else if ($request->getParameter("tipo") == "normal") {
            $this->profesional = Doctrine::getTable("Profesional")->findOneById($request->getParameter("profesional_id"));
            //$this->profesional->destacado=1;
            $this->profesional->fecha_destacado = date("Y-m-d H:i:s");
            $this->profesional->save();
            $this->redirect("profesionalLista/show?id=" . $this->profesional->id);
        }
    }

    public function executeRetirar(sfWebRequest $request) {
        if ($request->getParameter("tipo") == "temporal") {
            $this->profesional_destacado = Doctrine::getTable("ProfesionalDestacadosTemporales")
                    ->findOneByProfesionalIdAndTipoTiempoId($request->getParameter("profesional_id"), $request->getParameter("tiempo"));
            $this->profesional_destacado->delete();
            $this->redirect("profesionalLista/show?id=" . $request->getParameter("profesional_id"));
        } else if ($request->getParameter("tipo") == "normal") {
            $this->profesional = Doctrine::getTable("Profesional")->findOneById($request->getParameter("profesional_id"));
            $this->profesional->destacado = 0;
            $this->profesional->fecha_destacado = null;
            $this->profesional->save();
            $this->redirect("profesionalLista/show?id=" . $this->profesional->id);
        }
    }

    public function executeRevertStatus(sfWebRequest $request) {
        $profesional = $this->getRoute()->getObject();

        if (!in_array($profesional->profesional_estado_id, array(3, 4, 5, 6, 7, 8))) {
            $this->forward404();
        }

        if ($profesional_historico = Doctrine::getTable('ProfesionalHistorico')->createQuery()->where("profesional_id=" . $profesional->getId())->orderBy("created_at desc")->fetchOne()) {
            $estado_anterior = $profesional_historico->getEstadoInicial();
            $estado_actual = $profesional_historico->getEstadoFinal();
            $profesional->setProfesionalEstadoId($estado_anterior);

            if ($estado_actual == 3)
                $profesional->setFechaReferendum(null);
            if ($estado_actual == 4)
                $profesional->setFechaDeliberacion(null);
            if ($estado_actual == 5)
                $profesional->setFechaObservacion(null);
            if ($estado_actual == 6)
                $profesional->setFechaCerrado(null);
            if ($estado_actual == 7)
                $profesional->setFechaRechazado(null);
            if ($estado_actual == 8)
                $profesional->setFechaNulo(null);

            $profesional->save();

            $profesional_historico->delete();
        }

        $this->redirect("profesionales_pendientes/show?id=" . $profesional->id);
    }

}
