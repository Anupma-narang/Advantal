<?php

require_once dirname(__FILE__) . '/../lib/profesionalListaGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/profesionalListaGeneratorHelper.class.php';
sfProjectConfiguration::getActive()->loadHelpers(array('I18N'));

/**
 * profesionalLista actions.
 *
 * @package    symfony
 * @subpackage profesionalLista
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profesionalListaActions extends autoProfesionalListaActions {

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();

        $featured_limit = Doctrine::getTable('Profesional')->getFeatreudLimit();

        //if featured limit is more then 10 then show error message
        if ($featured_limit[0]['profesional_limit'] >= 11) {
            $this->getUser()->setAttribute('is_limit_exceed', true);
        } else {
            $this->getUser()->setAttribute('is_limit_exceed', false);
        }
    }

    public function executeLista(sfWebRequest $request) {
        $this->setTemplate('index');
        $this->executeIndex($request);
    }

    public function executeAutocompleteDireccion(sfWebRequest $request) {
        $results = ProfesionalTable::getInstance()->getAutocompleteDireccion($request->getParameter('q'));
        
        $html = array();
        foreach ($results as $result) {
            if(isset($result['address']) && !empty($result['address']))
                $html[] = $result['address'];
        }

        ProjectUtility::decorateJsonResponse($this->getResponse());
        return $this->renderText(json_encode($html));
    }

    public function executeAutocompleteName(sfWebRequest $request) {
        $results = ProfesionalTable::getInstance()->getAutocompleteName($request->getParameter('q'));
        $html = array();
        foreach ($results as $result) {

            $html[] = $result['first_name'];
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

        $filter_column = $this->getUser()->getAttribute('profesionalLista.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

        $this->addSortQuery($query);
        $this->addSortQuery($query);

        $request = sfContext::getInstance()->getRequest();

        if(! $request->hasParameter('sort') && ! $request->hasParameter('sort_type'))
        {
          $query->orderBy('created_at DESC');
        }

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();
        $query->andWhereIn('profesional_estado_id', array(2, 9));
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

        $featured_limit = Doctrine::getTable('Profesional')->getFeatreudLimit();

        //if featured limit is more then 10 then show error message
        if ($featured_limit[0]['profesional_limit'] >= 11) {
            $this->getUser()->setAttribute('is_limit_exceed', true);
        } else {
            $this->getUser()->setAttribute('is_limit_exceed', false);
        }
        $this->profesional = Doctrine::getTable("Profesional")->findOneById($request->getParameter("id"));

        $lastReferal = cp::getModuleFromRefrel();
        if ($lastReferal['parameters']['module'] == 'escritorio' && $this->profesional->profesional_estado_id == 1) {
            $this->redirect(url_for("@profesional") . '/' . $this->profesional->getId());
        }


        $this->activeReasonForm = new ProfesionalPendienteReasonForm($this->profesional);
        $this->profesionalRecomenda = Doctrine_Core::getTable('ProfesionalLetter')->findOneByProfesionalId($request->getParameter('id'));

        $this->letterCount = Doctrine_Core::getTable('ProfesionalLetter')->getAttachedRecomendation($request->getParameter('id'));

        if ($request->isMethod('post')) {
            $this->activeReasonForm->bind($request->getParameter($this->activeReasonForm->getName()));
            if ($this->activeReasonForm->isValid()) {
                $this->activeReasonForm->save();
                $signature = ($request->getParameter('siguiente') == 1) ? '&siguiente=1' : '';
                $this->redirect(url_for('profesionalLista/changeStatus?id=' . $this->profesional->getId() . $signature));
            }
        }


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




        // Pagination
        $q = Doctrine_Query::create()->from('ProfesionalLetter pl')
                ->select('pl.id, pl.name, pl.updated_at, pl.created_at, pl.user_id')
                ->where('pl.profesional_id = ?', $request->getParameter('id'))
                ->andWhere('pl.profesional_letter_estado_id = ?', 2)
                ->andWhere('pl.profesional_letter_type_id = ?', 1)
                ->orderBy('pl.id ' . 'DESC');
        $this->rLetter = new sfDoctrinePager('ProfesionalLetter', 25);
        $this->rLetter->setQuery($q);
        $this->rLetter->setPage($request->getParameter('page', 1));
        $this->rLetter->init();


        $qp = Doctrine_Query::create()->from('ProfesionalLetter pl')
                ->select('pl.id, pl.name, pl.updated_at, pl.created_at, pl.user_id')
                ->where('pl.profesional_id = ?', $request->getParameter('id'))
                ->andWhere('pl.profesional_letter_estado_id = ?', 2)
                ->andWhere('pl.profesional_letter_type_id = ?', 2)
                ->orderBy('pl.id ' . 'DESC');
        $this->dLetter = new sfDoctrinePager('ProfesionalLetter', 25);
        $this->dLetter->setQuery($qp);
        $this->dLetter->setPage($request->getParameter('pg', 1));
        $this->dLetter->init();
  
        $this->chartData = Doctrine::getTable('ProfesionalLetter')->getProfesionalChartData($request->getParameter('id'));
 }

    /**
     *
     * @param sfWebRequest $request
     */
    public function executeDestacadoManager(sfWebRequest $request) {
        $this->profesional = Doctrine_Core::getTable('Profesional')->find($request->getParameter('id'));
    }

    /**
     * Añade o quita la empresa como destacada
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
                        $this->getUser()->setFlash('msg', 'Sólo puedes destacar hasta 5 profesionales por actividad.');
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
                        $this->getUser()->setFlash('msg', 'Sólo puedes destacar hasta 5 profesionales por provincia.');
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
                        $this->getUser()->setFlash('msg', 'Sólo puedes destacar hasta 5 profesionales por localidad.');
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
                        $this->getUser()->setFlash('msg', 'Sólo puedes destacar hasta 5 profesionales por actividad y provincia.');
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
                        $this->getUser()->setFlash('msg', 'Sólo puedes destacar hasta 5 profesionales por actividad y localidad.');
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
                    return substr($value, 12);
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
                Alertas::saveNewProfesionalAlerts($profesional);
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
        $o__alert = new Alertas();
        try {
            $o__alert->deleteProfesionalAlerts($cuestionario->getId());
            $cuestionario->delete();
            $this->getUser()->setFlash('notice', 'El elemento se ha borrado correctamente.');
        } catch (Doctrine_Connection_Mysql_Exception $e) {
            $this->getUser()->setFlash('error', 'No se puede borrar esta empresa porqué tiene concursos o cuestionarios asociados');
        }
        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        $this->redirect(array('sf_route' => 'profesional_lista'));
        //$this->redirect('@empresa');
    }

    public function executeRechazar(sfWebRequest $request) {
        $this->profesional = Doctrine::getTable("Profesional")->findOneById($request->getParameter("id"));
        $this->form = new ContactProfesionalSimpleForm(array(), array('subject' => "El profesional que has dado de alta en auditoscopia ha sido rechazado. Necesitas revisarlo.", "profesional" => $this->profesional));
    }

    public function executeContacted(sfWebRequest $request) {
        $this->profesional = Doctrine::getTable("Profesional")->findOneById($request->getParameter("profesional_id"));

        $this->form = new ContactProfesionalSimpleForm(array(), array('subject' => "Tu profesional no cumple con las condiciones de participación. Por favor ¡corrígelo!", "profesional" => $this->profesional));
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->processContactForm($request, $this->form, $this->type);
        $this->setTemplate("rechazar");
    }

    protected function processContactForm(sfWebRequest $request, sfForm $form, $type) {
        $form->bind($request->getParameter($form->getName()));
        if ($form->isValid()) {
            $profesional = Doctrine::getTable('Profesional')->sendContactMail($this);
            $this->redirect("profesionalLista/changeStatus?id=" . $profesional->id . "&estado=9&rechazar=1");
        }
    }

    public function executeChangeStatus(sfWebRequest $request) {
        $this->forward404Unless($estado = $request->getParameter("estado", 2), 'Es necesario indicar el nuevo estado.');
        $this->forward404Unless($id = $request->getParameter("id"), 'Es necesario indicar el id del profesional.');
        $request->setParameter("alta_profesional", true);
        $this->profesional = $this->getRoute()->getObject();
        $last = $this->profesional->getProfesionalEstadoId();
        $this->profesional->setProfesionalEstadoId($estado);

        if ($estado == 2) {
            $this->profesional->setFechaActivacion(date('Y-m-d'));

            //los puntos
            $codigos = Doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic=true')->execute();
            foreach ($codigos as $codigo) {
                if ($request->getParameter($codigo->getCodigo())) {
                    $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo($codigo->getCodigo());
                    $this->profesional->getUser()->getProfile()->setPuntos($puntos);
                    $puntosHistoric = Doctrine::getTable('ColaboradorPuntosHistorico')->new_log($this->profesional->getUserId(), $codigo->getDescripcion(), $puntos, 'profesional', $this->profesional->getId());
                }
            }
        }

        $this->profesional->save();

        // guardamos en el histórico cada cambio de estado
        $profesional_historico = new ProfesionalHistorico();
        $profesional_historico->setProfesionalId($this->profesional->getId());
        $profesional_historico->setDate(date('Y-m-d H:i:s'));
        $profesional_historico->setEstadoInicial($last);
        $profesional_historico->setEstadoFinal($estado);
        $profesional_historico->save();

        if ($request->getParameter('siguiente') == 1) {
            if ($profesionalData = Doctrine::getTable('profesional')->createQuery()->where("profesional_estado_id=1")->orderBy("created_at desc")->fetchOne())
                $this->redirect("profesionalLista/show?id=" . $profesionalData->getId());
            else
                $this->redirect("@homepage");
        }
        else if ($request->getParameter('rechazar') == 1) {
            $this->redirect("@profesional_lista");
        } else {
            if ($estado == 2) {
                $this->redirect("@profesional_lista");
            } else {
                $this->redirect("profesionalLista/show?id=" . $this->profesional->id);
            }
        }
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
          $this->forward404('Has sobrepasado el nº máx de concursos destacados.'); */

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

        $profesional = $this->getRoute()->getObject();
        $profesional->setProfesionalEstadoId(1);
        $profesional->save();

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

        $this->redirect("profesionalLista/show?id=" . $profesional->id);
    }

    protected function addSortQuery($query) {
        $sort = isset($sort) ? $sort : array();

        if (array(null, null) == ($sort = $this->getSort())) {
            return;
        }

        if (!in_array(strtolower($sort[1]), array('asc', 'desc'))) {
            $sort[1] = 'asc';
        }

        switch ($sort[0]) {

            case 'tipo_tres':
                $sort[0] = 'ptt.name';
                break;

            case 'States':
                $sort[0] = 's.name';
                break;

            case 'City':
                $sort[0] = 'c.name';
                break;

            case 'profesional_tipo_uno':
                $sort[0] = 'ptu.name';
                break;

            case 'profesional_tipo_dos':
                $sort[0] = 'ptd.name';
                break;

            case 'username':
                $sort[0] = 'sf.username';
                break;
        }

        $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    }

    protected function isValidSortColumn($column) {
        $extraColumn = array('profesional_tipo_uno', 'profesional_tipo_dos', 'City', 'States', 'tipo_tres', 'username', 'last_name_one', 'last_name_two', 'first_name', 'created_at');

        return in_array($column, $extraColumn);
    }

    /**
     * Muestra todos las respuestas a los cuestionarios
     *
     * @param sfWebRequest $request
     */
    public function executeShowRecomendation(sfWebRequest $request) {
        $this->setLayout('layout_emergente_new');
        $this->profesionalRecomenda = Doctrine_Core::getTable('ProfesionalLetter')->findOneById($request->getParameter('id'));
        $this->professional_des = Doctrine::getTable('Profesional')->findOneBy('id', $this->profesionalRecomenda->getProfesionalId());
    }

    /**
     * Muestra todos las respuestas a los cuestionarios
     *
     * @param sfWebRequest $request
     */
    public function executeDownload_pdf(sfWebRequest $request) {
        $this->forward404Unless($profesionalRecomenda = Doctrine_Core::getTable('ProfesionalLetter')->findOneById($request->getParameter('id')));
        $pdf = new PDFClass();
        $pdf->AddPage();
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 30, 9, 60);
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/auditoscopia.png', 140, 20, 40);
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/audio-scopia-pdf-image.png', 25, 30, 230, 270);
        $pdf->Ln(25);
        $pdf->Cell(25);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Write(25, htmlentities('Recomendacion', ENT_QUOTES, "UTF-8"));
        $pdf->Ln(25);
        $pdf->Cell(25);
        $pdf->SetFont('Arial', '', 11);
        $pdf->WriteHTML(html_entity_decode($profesionalRecomenda->getDescription()));

        $pdf->Output(sprintf('Recomendación.pdf'), 'D');
        throw new sfStopException();
    }

    /**
     * Set selected profesional as featured on homepage
     * @param sfWebRequest $request
     */
    public function executeSetFeatured(sfWebRequest $request) {
        //get profesional id
        $profesional_id = $request->getParameter('id');
        //get contest
        $profesional = Doctrine::getTable('Profesional')->find($profesional_id);
        //get featured limit
        $featured_limit = Doctrine::getTable('Profesional')->getFeatreudLimit();

        //if featured limit is more then 10 then show error message
        if ($featured_limit[0]['profesional_limit'] >= 11) {
            //show profesional contest error message
            $this->getUser()->setFlash('alert', 'No puedes destacar más de 11 profesionales del Directorio en la Home.');
            $this->redirect('profesional_lista');
        }

        //make contest as featured
        $profesional->setFeatured(true);
        $profesional->save();
        $this->getUser()->setFlash('notice', 'Profesional añadido a la Home');
        $this->redirect('profesional_lista');
    }

    /**
     * Remove selected profesional from homepage
     * @param sfWebRequest $request
     */
    public function executeRemoveFeatured(sfWebRequest $request) {
        //get profesional id
        $profesional_id = $request->getParameter('id');
        //get contest
        $profesional = Doctrine::getTable('Profesional')->find($profesional_id);

        $profesional->setFeatured(false);
        $profesional->setFeaturedOrder(null);
        $profesional->save();

        $this->redirect('profesional_lista');
    }

    /**
     * Set selected profesional as featured order for homepage
     * @param sfWebRequest $request
     */
    public function executeSetFeaturedOrder(sfWebRequest $request) {
        //get profesional id
        $this->profesional_id = $request->getParameter('id');
        //get contest
        $profesional = Doctrine::getTable('Profesional')->find($this->profesional_id);
        if ($profesional) {
            if ($profesional->getFeatured()) {

                $this->profesional_featured_order = $profesional->getFeaturedOrder() ? $profesional->getFeaturedOrder() : '';
                $this->error_message = null;
                //if form is submitted
                if ($request->getMethod() == sfWebRequest::POST) {
                    //get contest featured order value
                    $this->profesional_featured_order = intval($request->getParameter('featured_order'));
                    //validated value
                    if ($this->profesional_featured_order && $this->profesional_featured_order > 0 && $this->profesional_featured_order <= 10) {
                        //save contest
                        $profesional->setFeaturedOrder($this->profesional_featured_order);
                        $profesional->save();
                        $this->getUser()->setFlash('notice', 'Has asignado el orden número ' . $this->profesional_featured_order . ' a este elemento de la Home');
                        $this->redirect('profesional_lista');
                    } else {
                        $this->error_message = 'Sólo puedes introducir números.';
                    }
                }
            } else {
                $this->getUser()->setFlash('alert', 'Para asignar un orden a un elemento de la Home, necesitas primero destacarlo.');
                $this->redirect('profesional_lista');
            }
        }
    }

}
