<?php

require_once dirname(__FILE__) . '/../lib/concursos_pendientesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/concursos_pendientesGeneratorHelper.class.php';

/**
 * concursos_pendientes actions.
 *
 * @package    symfony
 * @subpackage concursos_pendientes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class concursos_pendientesActions extends autoConcursos_pendientesActions {

    protected function buildQuery() {
        $query = parent::buildQuery();
        //Query customization
        $query->addWhere('concurso_estado_id=?', 1);
        //->addWhere('concurso_tipo_id=?', 1);

        $filter_column = $this->getUser()->getAttribute('concursos_pendientes.filters', null, 'admin_module');

        $this->filtershow = $filter_column;
        $sort = $this->getSort();
        $sort_column = $this->getUser()->getAttribute('concursos_pendientes.sort', null, 'admin_module');
        if ($sort_column[0] == 'concurso_categoria_id') {
            $query->leftJoin('r.ConcursoCategoria esu');
            $query->orderBy('esu.name' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'user_id') {
            $query->leftJoin('r.User esu');
            $query->orderBy('esu.username' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'concurso_tipo_id') {
            $query->leftJoin('r.ConcursoTipo esu');
            $query->orderBy('esu.name' . ' ' . $sort[1]);
        } else {
            if ($sort[0] != "") {
                $query->addOrderBy($sort[0] . ' ' . $sort[1]);
            } else {
                $query->addOrderBy('created_at DESC');
            }
        }

        return $query;
    }

    public function executeChangeCategoryCombo(sfWebRequest $request) {
        $concurso_tipo_id = $request->getParameter('concurso_tipo_id');
        if ($concurso_tipo_id == 1) {
            $this->categoryRecord = Doctrine::getTable("ConcursoCategoria")->createQuery()->select('id', 'name')->where("concurso_tipo_id=1")->execute();
        } else {
            $this->categoryRecord = Doctrine::getTable("ConcursoCategoria")->createQuery()->select('id', 'name')->where("concurso_tipo_id=2")->execute();
        }
        $option = '<option selected="selected" value="">Selecciona categoría</option>';
        foreach ($this->categoryRecord as $k => $record) {
            $option.= '<option value="' . $record->getId() . '">' . $record->getName() . '</option>';
        }
        return $this->renderText($option);
    }

    public function executeShow(sfWebRequest $request) {
        $this->concurso = $this->getRoute()->getObject();

        $this->n_concursos_destacados = Doctrine::getTable('concurso')
                ->createQuery('c')
                ->where('c.destacado = true')
                ->andWhere('c.concurso_estado_id=2 or c.concurso_estado_id=3')
                ->count();

        $this->n_concursos_destacados_tiempo = array();
        $this->n_concursos_destacados_tiempo[1] = Doctrine::getTable('ConcursosDestacadosTemporales')
                ->createQuery('c')
                ->andWhere('tipo_tiempo_id=1')
                ->count();
        $this->n_concursos_destacados_tiempo[2] = Doctrine::getTable('ConcursosDestacadosTemporales')
                ->createQuery('c')
                ->andWhere('tipo_tiempo_id=2')
                ->count();
        $this->n_concursos_destacados_tiempo[3] = Doctrine::getTable('ConcursosDestacadosTemporales')
                ->createQuery('c')
                ->andWhere('tipo_tiempo_id=3')
                ->count();

        $this->puntos = Doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic = false')->execute();
        $this->comentarios = Doctrine::getTable('ComentarioConcurso')->findBy('concurso_id', $this->concurso->getId());
    }

    public function executeListVolver(sfWebRequest $request) {
        $concurso = $this->getRoute()->getObject();
        $this->redirect('concurso/show?id=' . $concurso->getId());
    }

    public function executeShowIncidencia(sfWebRequest $request) {
        $this->forward404Unless($this->concurso = Doctrine::getTable('Concurso')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
    }

    public function executeShowPlanAccion(sfWebRequest $request) {
        $this->forward404Unless($this->contribucion = Doctrine::getTable('Contribucion')->findOneBy('id', $request->getParameter('id')));
        $this->forward404Unless($this->concurso = Doctrine::getTable('Concurso')->findOneBy('id', $this->contribucion->concurso_id));
        $this->setLayout('layout_emergente_new');
    }

    public function executeShowResumenPlanAccion(sfWebRequest $request) {
        $this->forward404Unless($this->contribucion = Doctrine::getTable('Contribucion')->findOneBy('id', $request->getParameter('id')));
        $this->forward404Unless($this->concurso = Doctrine::getTable('Concurso')->findOneBy('id', $this->contribucion->concurso_id));
        $this->setLayout('layout_emergente_new');
    }

    public function executeChangeStatus(sfWebRequest $request) {
        $this->forward404Unless($estado = $request->getParameter("estado"), 'Es necesario indicar el nuevo estado.');
        $this->forward404Unless($id = $request->getParameter("id"), 'Es necesario indicar el id del concurso.');
        $point_type = $request->getParameter('point_type');
        $this->concurso = $this->getRoute()->getObject();
        $last = $this->concurso->getConcursoEstadoId();
        $this->concurso->setConcursoEstadoId($request->getParameter("estado"));

        if ($estado == 2) {
            //hay que mandar una notificación a los usurios configurados
            if ($this->concurso->getConcursoTipoId() == 1) {   //empresa
                if ($notifificaciones = Doctrine::getTable('UserNotification')
                        ->createQuery()
                        ->where('concurso_empresa_value=1')
                        ->andWhere('concurso_empresa_nombre like ?', $this->concurso->getEmpresa()->getName())
                        ->andWhere('concurso_empresa_provincia_id=?', $this->concurso->getStatesID())
                        ->andWhere('concurso_empresa_ciudad_id=?', $this->concurso->getCityId())
                        ->execute()) {
                    foreach ($notifificaciones as $not)
                        $not->getUser()->sendNotification_NewConcursoEmpresa($this->concurso);
                }
            } elseif ($this->concurso->getConcursoTipoId() == 2) {  //producto
                if ($notifificaciones = Doctrine::getTable('UserNotification')
                        ->createQuery()
                        ->where('concurso_producto_value=1')
                        ->andWhere('concurso_producto_nombre like ?', $this->concurso->getProducto()->getName())
                        ->andWhere('concurso_producto_marca like ?', $this->concurso->getProducto()->getMarca())
                        ->execute()) {
                    foreach ($notifificaciones as $not)
                        $not->getUser()->sendNotification_NewConcursoProducto($this->concurso);
                }
            }

            $this->concurso->setFechaActivacion(date('Y-m-d'));

            //los puntos
            $codigos = Doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic=false')->execute();
            foreach ($codigos as $codigo) {
                if ($request->getParameter($codigo->getCodigo())) {
                    $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo($codigo->getCodigo());

                    $this->concurso->getUser()->getProfile()->setPuntos($puntos, $point_type);
                    ColaboradorPuntosHistoricoTable::new_log($this->concurso->getUserId(), $codigo->getDescripcion(), $puntos, 'concurso', $this->concurso->getId());
                }
            }
            if (($otro_descripcion = $request->getParameter('otro_descripcion')) && ($otro_puntos = $request->getParameter('otro_puntos'))) {
                $puntos_otro = str_replace('.', '', $otro_puntos);
                $this->concurso->getUser()->getProfile()->setPuntos($puntos_otro, $point_type);
                ColaboradorPuntosHistoricoTable::new_log($this->concurso->getUserId(), $otro_descripcion, $puntos_otro, 'concurso', $this->concurso->getId());
            }
        } elseif ($estado == 3)
            $this->concurso->setFechaReferendum(date('Y-m-d'));
        elseif ($estado == 4)
            $this->concurso->setFechaDeliberacion(date('Y-m-d H:i:s'));
        elseif ($estado == 5)
            $this->concurso->setFechaObservacion(date('Y-m-d H:i:s'));
        elseif ($estado == 6)
            $this->concurso->setFechaCerrado(date('Y-m-d H:i:s'));
        elseif ($estado == 7)
            $this->concurso->setFechaRechazado(date('Y-m-d H:i:s'));
        elseif ($estado == 8)
            $this->concurso->setFechaNulo(date('Y-m-d H:i:s'));
        elseif ($estado == 10) {
            $this->concurso->setFechaRevision(date('Y-m-d H:i:s'));
            $this->concurso->setRevisionLastStateId($last);
        }

        if (($last == 2 || $last == 3) && $estado > 3) {
            // si pasamos de activo ó referendum, a otro estado, quitamos el posible destacado y el destacado de sus contribuciones
            $this->concurso->quitarDestacadoConcursoYContribuciones();
        }

        $this->concurso->save();
        if ($estado == 2) {
            $contribucion = $this->concurso->getContribucionPrincipal();
            $contribucion->setContribucionEstadoId(2);
            $contribucion->save();
        }


        // guardamos en el histórico cada cambio de estado
        $concurso_historico = new ConcursoHistorico();
        $concurso_historico->setConcursoId($this->concurso->getId());
        $concurso_historico->setDate(date('Y-m-d H:i:s'));
        $concurso_historico->setEstadoInicial($last);
        $concurso_historico->setEstadoFinal($estado);
        $concurso_historico->save();


        if ($request->getParameter('siguiente') == 1) {
            if ($concurso = Doctrine::getTable('Concurso')->createQuery()->where("concurso_estado_id=1")->orderBy("created_at desc")->fetchOne())
                $this->redirect("concursos_pendientes/show?id=" . $concurso->id);
            else
                $this->redirect("@homepage");
        }
        else
        if ($estado == 2) {
            $this->redirect("concurso/show?id=" . $this->concurso->id);
        } else {
            $this->redirect("concursos_pendientes/show?id=" . $this->concurso->id);
        }
    }

    public function executeRevertStatus(sfWebRequest $request) {
        $concurso = $this->getRoute()->getObject();

        if (!in_array($concurso->concurso_estado_id, array(3, 4, 5, 6, 7, 8))) {
            $this->forward404();
        }

        if ($concurso_historico = Doctrine::getTable('ConcursoHistorico')->createQuery()->where("concurso_id=" . $concurso->getId())->orderBy("created_at desc")->fetchOne()) {
            $estado_anterior = $concurso_historico->getEstadoInicial();
            $estado_actual = $concurso_historico->getEstadoFinal();
            $concurso->setConcursoEstadoId($estado_anterior);

            if ($estado_actual == 3)
                $concurso->setFechaReferendum(null);
            if ($estado_actual == 4)
                $concurso->setFechaDeliberacion(null);
            if ($estado_actual == 5)
                $concurso->setFechaObservacion(null);
            if ($estado_actual == 6)
                $concurso->setFechaCerrado(null);
            if ($estado_actual == 7)
                $concurso->setFechaRechazado(null);
            if ($estado_actual == 8)
                $concurso->setFechaNulo(null);

            $concurso->save();

            $concurso_historico->delete();
        }

        $this->redirect("concursos_pendientes/show?id=" . $concurso->id);
    }

    public function executeRechazar(sfWebRequest $request) {
        $this->concurso = Doctrine::getTable("Concurso")->findOneById($request->getParameter("id"));
        $this->form = new ContactSimpleForm(array(), array('subject' => "Tu concurso en auditoscopia ha sido rechazado. Necesitas corregirlo", "concurso" => $this->concurso));
    }

    public function executeContacted(sfWebRequest $request) {
        $this->concurso = Doctrine::getTable("Concurso")->findOneById($request->getParameter("concurso_id"));

        $this->form = new ContactSimpleForm(array(), array('subject' => "Tu concurso no cumple con las condiciones de participación. Por favor ¡corrígelo!", "concurso" => $this->concurso));
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->processContactForm($request, $this->form, $this->type);
        $this->setTemplate("rechazar");
    }

    protected function processContactForm(sfWebRequest $request, sfForm $form, $type) {
        //$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $form->bind($request->getParameter($form->getName()));
        if ($form->isValid()) {
            $user = Doctrine::getTable("sfGuardUser")->findOneById($this->form->getValue("user_id"));
            $concurso = Doctrine::getTable("Concurso")->findOneById($this->form->getValue("concurso_id"));
            $to = array($user->email_address);
            $from = sfConfig::get('app_default_mailfrom');
            $subject = $this->form->getValue("subject");
            $body = $this->form->getValue("body");
            $this->sendMail($to, $from, $subject, $body);
            $this->getUser()->setFlash('notice', 'Se ha enviado el correo electrónico a la/el usuaria/o ' . $user->username);
            $this->redirect("concursos_pendientes/changeStatus?id=" . $concurso->id . "&estado=9");
        }
    }

    public function sendMail($to, $from, $subject, $body, $consumer = null, $group = null) {
        $mensaje = Swift_Message::newInstance();
        $mensaje->setFrom($from);
        $mensaje->setTo($to);
        $mensaje->setSubject($subject);
        $mensaje->setBody($body);
        $mensaje->setContentType('text/html');
        $this->getMailer()->send($mensaje);
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
            $this->concurso_destacado = new ConcursosDestacadosTemporales();
            $this->concurso_destacado->concurso_id = $request->getParameter("concurso_id");
            $this->concurso_destacado->tipo_tiempo_id = $request->getParameter("tiempo");
            $this->concurso_destacado->created_at = date("Y-m-d H:i:s");
            $this->concurso_destacado->updated_at = date("Y-m-d H:i:s");
            if ($concurso_previo = $this->concurso_destacado->existsOtherInTime($request->getParameter("tiempo"))) {
                $concurso_previo->delete();
            }
            $this->concurso_destacado->save();
            $this->redirect("concursos_pendientes/show?id=" . $this->concurso_destacado->concurso_id);
        } else if ($request->getParameter("tipo") == "normal") {
            $this->concurso = Doctrine::getTable("Concurso")->findOneById($request->getParameter("concurso_id"));
            $this->concurso->destacado = 1;
            $this->concurso->fecha_destacado = date("Y-m-d H:i:s");
            $this->concurso->save();
            $this->redirect("concursos_pendientes/show?id=" . $this->concurso->id);
        }
    }

    public function executeRetirar(sfWebRequest $request) {
        if ($request->getParameter("tipo") == "temporal") {
            $this->concurso_destacado = Doctrine::getTable("ConcursosDestacadosTemporales")
                    ->findOneByConcursoIdAndTipoTiempoId($request->getParameter("concurso_id"), $request->getParameter("tiempo"));
            $this->concurso_destacado->delete();
            $this->redirect("concursos_pendientes/show?id=" . $request->getParameter("concurso_id"));
        } else if ($request->getParameter("tipo") == "normal") {
            $this->concurso = Doctrine::getTable("Concurso")->findOneById($request->getParameter("concurso_id"));
            $this->concurso->destacado = 0;
            $this->concurso->fecha_destacado = null;
            $this->concurso->save();
            $this->redirect("concursos_pendientes/show?id=" . $this->concurso->id);
        }
    }

    public function executeObserver(sfWebRequest $request) {

        $this->concurso = $this->getRoute()->getObject();
        $this->form = new ConcursoBeneficioForm();
    }

    public function executeObserved(sfWebRequest $request) {

        $concurso = Doctrine::getTable("Concurso")->findOneById($request->getParameter("concurso_id"));
        $this->form = new ConcursoBeneficioForm();
        $this->procesarForm($request, $this->form, $concurso);
        $this->setTemplate('observer');
    }

    public function procesarForm(sfWebRequest $request, sfForm $form, $concurso) {
        if ($concurso_beneficio = $this->processForm($request, $this->form)) {
            $concurso->repartirBeneficio($concurso_beneficio);
        }

        $this->redirect("concursos_pendientes/changeStatus?id=" . $concurso_beneficio->concurso_id . "&estado=5");
    }

    public function executeEdit(sfWebRequest $request) {
        $concurso = $this->getRoute()->getObject();
        if ($concurso->getConcursoTipoId() == 1) {
            $this->forward('concursos_pendientes', 'editEmpresa');
        } elseif ($concurso->getConcursoTipoId() == 2) {
            $this->forward('concursos_pendientes', 'editProducto');
        } else {
            $this->forward404('El concurso no es correcto.');
        }
    }

    public function executeEditProducto(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
        $concurso = Doctrine::getTable('Concurso')->findOneBy('id', $this->id);
        $this->form = new ConcursoProductoFormBackend($concurso);
        $this->form->setDefaults($this->form->getDefaultValuesConcurso());

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('concurso'), $request->getFiles('concurso'));
            if ($this->form->isValid()) {
                $id = $this->form->save();
                $notice = "The item was updated successfully.";
                $this->getUser()->setFlash('notice', $notice);
                $this->redirect('concursos_pendientes/show?id=' . $id);
            }
        }
    }

    public function executeEditEmpresa(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
        $concurso = Doctrine::getTable('Concurso')->findOneBy('id', $this->id);
        $this->form = new ConcursoEmpresaFormBackend($concurso);
        $this->form->setDefaults($this->form->getDefaultValuesConcurso());

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('concurso'), $request->getFiles('concurso'));
            if ($this->form->isValid()) {
                $id = $this->form->save();                
                $notice = "The item was updated successfully.";
                $this->getUser()->setFlash('notice', $notice);
                $this->redirect('concursos_pendientes/show?id=' . $id);
            }
        }
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->concurso = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->concurso);
        $this->processForm($request, $this->form);
        $this->setTemplate('edit');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {        
        
        $concurso = $request->getParameter('concurso');
        $request_parameters = $request->getParameter($form->getName());
        $form->bind($request_parameters, $request->getFiles($form->getName()));        
        if ($form->isValid()) {          
            $concurso_beneficio = $form->save();
            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $concurso_beneficio)));
            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . 'El elemento se ha creado correctamente y ahora puede crear otro elemento.');
                if (isset($concurso['concurso_tipo_id']) && $concurso['concurso_tipo_id'] == 2) {
                    $this->redirect('@concurso_concursos_pendientes_product_new');
                } else {
                    $this->redirect('@concursos_pendientes_new');
                }
            } else {
                $notice = "The item was created successfully.";
                $this->getUser()->setFlash('notice', $notice);
                $this->redirect('concursos_pendientes/show?id=' . $concurso_beneficio->getId());
            }
        }
        else
        {          
          $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);        
        }
        return false;
    }

    public function executeVolver(sfWebRequest $request) {
        $this->redirect('@concurso');
    }

    public function executeNewComentario(sfWebRequest $request) {
        $this->forward404Unless($this->concurso_id = $request->getParameter('id'), 'Necesitas el id del concurso');
        $this->form = new ComentarioConcursoForm(array(), array('concurso_id' => $this->concurso_id, 'user_id' => $this->getUser()->getGuardUser()->getId()));

        if ($request->isMethod('POST')) {
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $this->form->save();
                $this->setTemplate('success');
            }
        }
    }

    public function executeDownload_pdfIncidencia(sfWebRequest $request) {
        $this->forward404Unless($concurso = Doctrine::getTable('concurso')->findOneBy('id', $request->getParameter('id')));

        $pdf = new PDFClass();
        $pdf->AddPage();
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 150, 8, 40);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Write(5, $concurso->getName());
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 11);
        $pdf->WriteHTML(html_entity_decode($concurso->getIncidencia()));
        $pdf->Output(sprintf($concurso->getName() . '.pdf'), 'D');
        throw new sfStopException();
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        $ss__DeleteQry = Doctrine_Query::create()->delete()->from('ConcursoHistorico tbl');
        $ss__DeleteQry->andWhereIn('tbl.concurso_id', $request->getParameter('id'));
        $ss__DeleteQry->execute();
        
        if ($this->getRoute()->getObject()->delete()) {
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect('@concursos_pendientes');
    }

}
