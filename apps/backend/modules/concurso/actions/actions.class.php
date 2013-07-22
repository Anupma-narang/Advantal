<?php

require_once dirname(__FILE__) . '/../lib/concursoGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/concursoGeneratorHelper.class.php';

/**
 * concurso actions.
 *
 * @package    auditoscopia
 * @subpackage concurso
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class concursoActions extends autoConcursoActions {

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            if ($request->hasParameter("columnname")) {
                $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type'), $request->getParameter('columnname')));
            } else {
                $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
            }
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
        $filter_index = $this->getUser()->getAttribute('concurso.filters', null, 'admin_module');

        //get featured limit
        $featured_limit = Doctrine::getTable('Concurso')->getFeatreudLimit('company');
        if ($featured_limit[0]['contest_limit'] >= 10) {
            $this->getUser()->setAttribute('is_compnay_limit_exceed', true);
        } else {
            $this->getUser()->setAttribute('is_compnay_limit_exceed', false);
        }
        $featured_limit = Doctrine::getTable('Concurso')->getFeatreudLimit('product');
        if ($featured_limit[0]['contest_limit'] >= 10) {
            $this->getUser()->setAttribute('is_product_limit_exceed', true);
        } else {
            $this->getUser()->setAttribute('is_product_limit_exceed', false);

        }
        
    }

    public function executeNewEmpresa(sfWebRequest $request) {
        $this->form = new ConcursoEmpresaFormBackend();

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('concurso'), $request->getFiles('concurso'));
            if ($this->form->isValid()) {
                $id = $this->form->save();
                if ($request->hasParameter('_save_and_add')) {
                    $this->getUser()->setFlash('notice', 'El elemento se ha creado correctamente y ahora puede crear otro elemento');
                    $this->redirect('concurso/newEmpresa');
                }
                $this->getUser()->setAttribute('notice_message', 'El artículo fue creado con éxito');
                $this->getUser()->setFlash('notice', 'El artículo fue creado con éxito');
                $this->redirect('concurso/show?id=' . $id);
            }else
            {              
              $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);        
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
                $this->getUser()->setAttribute('notice_message', 'El elemento se ha actualizado correctamente');
                $this->getUser()->setFlash('notice', 'El elemento se ha actualizado correctamente');
                $this->redirect('concurso/show?id=' . $id);
            }else
            {
              $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
            }
        }
    }

    public function executeNewProducto(sfWebRequest $request) {
        $this->form = new ConcursoProductoFormBackend();

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('concurso'), $request->getFiles('concurso'));
            if ($this->form->isValid()) {
                $id = $this->form->save();
                if ($request->hasParameter('_save_and_add')) {
                    $this->getUser()->setFlash('notice', 'El elemento se ha creado correctamente y ahora puede crear otro elemento');
                    $this->redirect('concurso/newProducto');
                }
                $this->getUser()->setAttribute('notice_message', 'El artículo fue creado con éxito');
                $this->getUser()->setFlash('notice', 'El artículo fue creado con éxito');
                $this->redirect('concurso/show?id=' . $id);
            }else
            {
              $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
            }
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
                $this->getUser()->setAttribute('notice_message', 'El elemento se ha actualizado correctamente');
                $this->getUser()->setFlash('notice', 'El elemento se ha actualizado correctamente');
                $this->redirect('concurso/show?id=' . $id);
            }else
            {
              $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
            }
        }
    }

    public function executeEdit(sfWebRequest $request) {
        $concurso = $this->getRoute()->getObject();
        if ($concurso->getConcursoTipoId() == 1) {
            $this->redirect('concurso/editEmpresa?id=' . $concurso->getId());
        } elseif ($concurso->getConcursoTipoId() == 2) {
            $this->redirect('concurso/editProducto?id=' . $concurso->getId());
        } else {
            $this->forward404('El concurso no es correcto.');
        }
    }

    public function executeNew(sfWebRequest $request) {
        $this->redirect('concurso/newEmpresa');
    }

    public function executeShowEmpresa(sfWebRequest $request) {        
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

        $this->n_contribuciones_destacados = Doctrine::getTable('contribucion')
                ->createQuery('c')
                ->where('c.concurso_id=?', $this->concurso->getId())
                ->andWhere('c.destacado=1')
                ->count();

        $this->puntos = Doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic = false')->execute();
        $this->comentarios = Doctrine::getTable('ComentarioConcurso')->findBy('concurso_id', $this->concurso->getId());

        $this->arr_cambios_estados_reactivaciones = $this->concurso->getArrFechasReactivaciones();
        $this->arr_cambios_estados_revisiones = $this->concurso->getArrFechasRevisiones();


        $featured_limit = Doctrine::getTable('Concurso')->getFeatreudLimit('company');
        
        //$this->concurso->getId()
        $q = Doctrine::getTable('ConcursoReferendum')
                ->createQuery('c')
                ->where('c.concurso_id=?', $this->concurso->getId())                
                ->fetchArray();
        
                
        //if featured limit is more then 10 then show error message
        if ($featured_limit[0]['contest_limit'] >= 10) {
            $this->getUser()->setAttribute('is_limit_exceed', true);
        } else {
            $this->getUser()->setAttribute('is_limit_exceed', false);
        }        
    }

    public function executeShowProducto(sfWebRequest $request) {
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

        $this->n_contribuciones_destacados = Doctrine::getTable('contribucion')
                ->createQuery('c')
                ->where('c.concurso_id=?', $this->concurso->getId())
                ->andWhere('c.destacado=1')
                ->count();

        $this->puntos = Doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic = false')->execute();
        $this->comentarios = Doctrine::getTable('ComentarioConcurso')->findBy('concurso_id', $this->concurso->getId());

        $this->arr_cambios_estados_reactivaciones = $this->concurso->getArrFechasReactivaciones();
        $this->arr_cambios_estados_revisiones = $this->concurso->getArrFechasRevisiones();
        $featured_limit = Doctrine::getTable('Concurso')->getFeatreudLimit('product');

        //if featured limit is more then 10 then show error message
        if ($featured_limit[0]['contest_limit'] >= 10) {
            $this->getUser()->setAttribute('is_limit_exceed', true);
        } else {
            $this->getUser()->setAttribute('is_limit_exceed', false);
        }
    }

    public function executeShow(sfWebRequest $request) {

        
        
        $concurso = $this->getRoute()->getObject();
        
        if ($concurso->getConcursoTipoId() == 1) {
            $this->redirect('concurso/showEmpresa?id=' . $concurso->getId());
        } elseif ($concurso->getConcursoTipoId() == 2) {
            $this->redirect('concurso/showProducto?id=' . $concurso->getId());
        } else {
            $this->forward404('El concurso no es correcto.');
        }

        $featured_limit = Doctrine::getTable('Concurso')->getFeatreudLimit($concurso->getEmpresaId() ? 'company' : 'product');

        //if featured limit is more then 10 then show error message
        if ($featured_limit[0]['contest_limit'] >= 10) {
            $this->getUser()->setAttribute('is_limit_exceed', true);
        } else {
            $this->getUser()->setAttribute('is_limit_exceed', false);
        }
        
    }

    public function executeShowIncidencia(sfWebRequest $request) {
        $this->forward404Unless($this->concurso = Doctrine::getTable('Concurso')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
    }

    public function executeListVolver(sfWebRequest $request) {
        $concurso = $this->getRoute()->getObject();
        $this->redirect('concurso/show?id=' . $concurso->getId());
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
        elseif ($estado == 4) {
            $this->concurso->setFechaDeliberacion(date('Y-m-d H:i:s'));
            $this->concurso->asignarPuntosGanadores();
        } elseif ($estado == 5)
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
                $this->redirect("concurso/show?id=" . $concurso->id);
            else
                $this->redirect("@homepage");
        }
        else
            $this->redirect("concurso/show?id=" . $this->concurso->id);
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

        $this->redirect("concurso/show?id=" . $concurso->id);
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
            $this->redirect("concurso/changeStatus?id=" . $concurso->id . "&estado=9");
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
            $this->redirect("concurso/show?id=" . $this->concurso_destacado->concurso_id);
        } else if ($request->getParameter("tipo") == "normal") {
            $this->concurso = Doctrine::getTable("Concurso")->findOneById($request->getParameter("concurso_id"));
            $this->concurso->destacado = 1;
            $this->concurso->fecha_destacado = date("Y-m-d H:i:s");
            $this->concurso->save();
            $this->redirect("concurso/show?id=" . $this->concurso->id);
        }
    }

    public function executeRetirar(sfWebRequest $request) {
        if ($request->getParameter("tipo") == "temporal") {
            $this->concurso_destacado = Doctrine::getTable("ConcursosDestacadosTemporales")
                    ->findOneByConcursoIdAndTipoTiempoId($request->getParameter("concurso_id"), $request->getParameter("tiempo"));
            $this->concurso_destacado->delete();
            $this->redirect("concurso/show?id=" . $request->getParameter("concurso_id"));
        } else if ($request->getParameter("tipo") == "normal") {
            $this->concurso = Doctrine::getTable("Concurso")->findOneById($request->getParameter("concurso_id"));
            $this->concurso->destacado = 0;
            $this->concurso->fecha_destacado = null;
            $this->concurso->save();
            $this->redirect("concurso/show?id=" . $this->concurso->id);
        }
    }

    public function executeRetirarcuncurso(sfWebRequest $request) {
        $this->contribucion = Doctrine::getTable("Contribucion")->findOneById($request->getParameter("contribucion_id"));
        $this->contribucion->destacado = 0;
        $this->contribucion->fecha_destacado = null;
        $this->contribucion->save();
        $this->redirect("concurso/show?id=" . $request->getParameter('concurso_id'));
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

        $this->redirect("concurso/changeStatus?id=" . $concurso_beneficio->concurso_id . "&estado=5");
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $concurso_beneficio = $form->save();
            $this->getUser()->setFlash('notice', 'El artículo fue creado con éxito');
            //return $concurso_beneficio;
            $this->redirect("concurso/show?id=" . $concurso_beneficio->getId());
        }
        return false;
    }

    protected function only_estado() {
        $query = parent::buildQuery();

        //Query customization
        $query->addWhere('concurso_estado_id=?', 1);

        return $query;
    }

    protected function buildQuery() {
        $filtering_estados_tipos = sfContext::getInstance()->getUser()->getAttribute('concurso.filtering_estados_tipos', '', 'admin_module');
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $filter_column = $this->getUser()->getAttribute('concurso.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

        $sort = $this->getSort();
        $sort_column = $this->getUser()->getAttribute('concurso.sort', null, 'admin_module');
        if ($sort_column[0] == 'concurso_tipo_id') {
            $query->leftJoin('r.ConcursoTipo esu');
            $query->orderBy('esu.name' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'concurso_categoria_id') {
            $query->leftJoin('r.ConcursoCategoria esu');
            $query->orderBy('esu.name' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'concurso_estado_id') {
            $query->leftJoin('r.ConcursoEstado esu');
            $query->orderBy('esu.name' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'user_id') {
            $query->leftJoin('r.User esu');
            $query->orderBy('esu.username' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'empresa_id') {
            if (array_key_exists('columnname', $_GET)) {
                if ($_GET['columnname'] == 'empresa') {
                    $query->leftJoin('r.Empresa esu');
                    $query->orderBy('esu.name' . ' ' . $sort[1]);
                } elseif ($_GET['columnname'] == 'sector') {
                    $query->leftJoin('r.Empresa esu');
                    $query->orderBy('esu.EmpresaSectorUno.name' . ' ' . $sort[1]);
                } elseif ($_GET['columnname'] == 'subsector') {
                    $query->leftJoin('r.Empresa esu');
                    $query->orderBy('esu.EmpresaSectorDos.name' . ' ' . $sort[1]);
                } elseif ($_GET['columnname'] == 'tresector') {
                    $query->leftJoin('r.Empresa esu');
                    $query->orderBy('esu.EmpresaSectorTres.name' . ' ' . $sort[1]);
                }
            } elseif (isset($sort_column[2]) && !empty($sort_column[0])) {
                if ($sort_column[2] == 'empresa') {
                    $query->leftJoin('r.Empresa esu');
                    $query->orderBy('esu.name' . ' ' . $sort[1]);
                } elseif ($sort_column[2] == 'sector') {
                    $query->leftJoin('r.Empresa esu');
                    $query->orderBy('esu.EmpresaSectorUno.name' . ' ' . $sort[1]);
                } elseif ($sort_column[2] == 'subsector') {
                    $query->leftJoin('r.Empresa esu');
                    $query->orderBy('esu.EmpresaSectorDos.name' . ' ' . $sort[1]);
                } elseif ($sort_column[2] == 'tresector') {
                    $query->leftJoin('r.Empresa esu');
                    $query->orderBy('esu.EmpresaSectorTres.name' . ' ' . $sort[1]);
                }
            } else {
                $query->leftJoin('r.Empresa esu');
                $query->orderBy('esu.name' . ' ' . $sort[1]);
            }
        } elseif ($sort_column[0] == 'states_id') {
            $query->leftJoin('r.States esu');
            $query->orderBy('esu.name' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'city_id') {
            $query->leftJoin('r.City esu');
            $query->orderBy('esu.name' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'producto_id') {
            if (array_key_exists('columnname', $_GET)) {
                if ($_GET['columnname'] == 'producto') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.name' . ' ' . $sort[1]);
                } elseif ($_GET['columnname'] == 'marca') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.marca' . ' ' . $sort[1]);
                } elseif ($_GET['columnname'] == 'productuno') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.ProductoTipoUno.name' . ' ' . $sort[1]);
                } elseif ($_GET['columnname'] == 'productdos') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.ProductoTipoDos.name' . ' ' . $sort[1]);
                } elseif ($_GET['columnname'] == 'producttres') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.ProductoTipoTres.name' . ' ' . $sort[1]);
                } elseif ($_GET['columnname'] == 'modelo') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.modelo' . ' ' . $sort[1]);
                }
            } elseif (isset($sort_column[2]) && !empty($sort_column[0])) {
                if ($sort_column[2] == 'producto') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.name' . ' ' . $sort[1]);
                } elseif ($sort_column[2] == 'marca') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.marca' . ' ' . $sort[1]);
                } elseif ($sort_column[2] == 'productuno') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.ProductoTipoUno.name' . ' ' . $sort[1]);
                } elseif ($sort_column[2] == 'productdos') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.ProductoTipoDos.name' . ' ' . $sort[1]);
                } elseif ($sort_column[2] == 'producttres') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.ProductoTipoTres.name' . ' ' . $sort[1]);
                } elseif ($sort_column[2] == 'modelo') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.modelo' . ' ' . $sort[1]);
                }
            }
        } else {
            if ($sort[0] != "") {
                $query->addOrderBy($sort[0] . ' ' . $sort[1]);
            } else {
                $query->addOrderBy('created_at desc');
            }
        }

//        echo $query->getSqlQuery();exit;

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

    public function executeNewComentario(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
        $this->forward404Unless($this->concurso_id = $request->getParameter('id'), 'Necesitas el id del concurso');
        $this->form = new ComentarioConcursoForm(array(), array('concurso_id' => $this->concurso_id, 'user_id' => $this->getUser()->getGuardUser()->getId()));

        if ($request->isMethod('POST')) {
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $this->form->save();
                //$this->setTemplate('success');
                $this->redirect("concurso/show?id=" . $this->id);
            }
        }
    }

    public function executeFilter(sfWebRequest $request) {
        $filter_parts = $this->getUser()->getAttribute('concurso.filtering_estados_tipos', null, 'admin_module');
        if ($filter_parts) {
            $val = $filter_parts;
            //echo $val;
            switch ($val) {
                case 'empresa_entidad': $active_filters = array('concurso_tipo_id' => 1);
                    break;
                case 'producto': $active_filters = array('concurso_tipo_id' => 2);
                    break;
                case 'activo': $active_filters = array('concurso_estado_id' => 2);
                    break;
                case 'referendum': $active_filters = array('concurso_estado_id' => 3);
                    break;
                case 'deliberacion': $active_filters = array('concurso_estado_id' => 4);
                    break;
                case 'observacion': $active_filters = array('concurso_estado_id' => 5);
                    break;
                case 'rechazados': $active_filters = array('concurso_estado_id' => 7);
                    break;
                case 'cerrados': $active_filters = array('concurso_estado_id' => 6);
                    break;
                case 'nulos': $active_filters = array('concurso_estado_id' => 8);
                    break;
                case 'revision': $active_filters = array('concurso_estado_id' => 10);
                    break;
                case 'borrador': $active_filters = array('concurso_estado_id' => 9);
                    break;
                default: $active_filters = array();
                    break;
            }
            $this->getUser()->setAttribute('concurso.filtering_estados_tipos', $val, 'admin_module');
        } else {
            $this->getUser()->setAttribute('concurso.filtering_estados_tipos', null, 'admin_module');
        }
        parent::executeFilter($request);
    }

    public function executeFiltering(sfWebRequest $request) {
        $val = $request->getParameter('val');

        switch ($val) {
            case 'empresa_entidad': $active_filters = array('concurso_tipo_id' => 1);
                break;
            case 'producto': $active_filters = array('concurso_tipo_id' => 2);
                break;
            case 'activo': $active_filters = array('concurso_estado_id' => 2);
                break;
            case 'referendum': $active_filters = array('concurso_estado_id' => 3);
                break;
            case 'deliberacion': $active_filters = array('concurso_estado_id' => 4);
                break;
            case 'observacion': $active_filters = array('concurso_estado_id' => 5);
                break;
            case 'rechazados': $active_filters = array('concurso_estado_id' => 7);
                break;
            case 'cerrados': $active_filters = array('concurso_estado_id' => 6);
                break;
            case 'nulos': $active_filters = array('concurso_estado_id' => 8);
                break;
            case 'revision': $active_filters = array('concurso_estado_id' => 10);
                break;
            case 'borrador': $active_filters = array('concurso_estado_id' => 9);
                break;
            default: $active_filters = array();
                break;
        }

        $this->getUser()->setAttribute('concurso.filters', $active_filters, 'admin_module');
        $this->getUser()->setAttribute('concurso.filtering_estados_tipos', $val, 'admin_module');
        $this->redirect('@concurso');
    }

    /**
     * Set selected contest as featured on homepage
     * @param sfWebRequest $request
     */
    public function executeSetFeatured(sfWebRequest $request) {
        //get contest id
        $contest_id = $request->getParameter('id');
        //get contest
        $contest = Doctrine::getTable('Concurso')->find($contest_id);
        //get featured limit
        $featured_limit = Doctrine::getTable('Concurso')->getFeatreudLimit($contest->getEmpresaId() ? 'company' : 'product');

        //if featured limit is more then 10 then show error message
        if ($featured_limit[0]['contest_limit'] >= 10) {
            //show company contest error message
            if ($contest->getEmpresaId()) {
                $this->getUser()->setFlash('alert', 'No puedes destacar más de 10 concursos de Empresa/Entidad en la Home.');
            }
            //show product contest error message
            else {
                $this->getUser()->setFlash('alert', 'No puedes destacar más de diez concursos de Producto en la Home.');
            }
            $this->redirect($request->getReferer());
        }

        //make contest as featured
        $contest->setFeatured(true);
        $contest->save();
        //set flash message
        if ($contest->getEmpresaId()) {
            $this->getUser()->setFlash('notice', 'Empresa o Entidad añadida a la Home');
        } else {
            $this->getUser()->setFlash('notice', 'Producto añadido a la Home');
        }

        $this->redirect('concurso');
    }

    /**
     * remove the selected contest from homepage
     * @param sfWebRequest $request
     */
    public function executeRemoveFeatured(sfWebRequest $request) {
        //get contest id
        $contest_id = $request->getParameter('id');
        //get contest
        $contest = Doctrine::getTable('Concurso')->find($contest_id);
        $contest->setFeatured(false);
        $contest->setFeaturedOrder(null);
        $contest->save();
        $this->redirect($request->getReferer());
    }

    public function executeSetCompanyFeaturedOrder(sfWebRequest $request) {
        $this->setFeaturedOrder($request);
    }

    public function executeSetProductFeaturedOrder(sfWebRequest $request) {
        $this->setFeaturedOrder($request);
    }

    /**
     * Set selected contest as featured order for homepage
     * @param sfWebRequest $request
     */
    public function setFeaturedOrder(sfWebRequest $request) {
        //get contest id
        $this->contest_id = $request->getParameter('id');
        //get contest
        $contest = Doctrine::getTable('Concurso')->find($this->contest_id);
        if ($contest) {
            //if contest if feature
            if ($contest->getFeatured()) {
                $this->contest_featured_order = $contest->getFeaturedOrder() ? $contest->getFeaturedOrder() : '';
                $this->error_message = null;
                //if form is submitted
                if ($request->getMethod() == sfWebRequest::POST) {
                    //get contest featured order value
                    $this->contest_featured_order = $request->getParameter('featured_order');
                    //validated value
                    if ($this->contest_featured_order && $this->contest_featured_order > 0 && $this->contest_featured_order <= 10) {
                        //save contest
                        $contest->setFeaturedOrder($this->contest_featured_order);
                        $contest->save();
                        $this->getUser()->setFlash('notice', 'Has asignado el orden número ' . $this->contest_featured_order . ' a este elemento de la Home');
                        $this->redirect('concurso');
                    } else {
                        $this->error_message = 'Sólo puedes introducir números.';
                    }
                }
            } else {
                $this->getUser()->setFlash('alert', 'Para asignar un orden a un elemento de la Home, necesitas primero destacarlo.');
                $this->redirect('concurso');
            }
        } else {
            
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

        try {
            // concurso_revision
            // concurso_referendum
            // concurso_historico
            // concurso_beneficio
            // concurso_archivo
            // concursos_destacados_temporales
            // $request->getParameter("id");
            $ss__DeleteQry = Doctrine_Query::create()->delete()->from('ConcursoHistorico tbl');
            $ss__DeleteQry->andWhereIn('tbl.concurso_id', $request->getParameter('id'));
            $ss__DeleteQry->execute();

            $concurso = Doctrine::getTable('concurso')->findOneBy('id', $request->getParameter('id'));
            if ($concurso->getConcursoEstadoId() == 1) {
                $this->getRoute()->getObject()->delete();
                $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
            } else {
                $this->getUser()->setFlash('error', "Sólo puedes borrar concursos en estado de Revista.");
            }
        } catch (Doctrine_Connection_Mysql_Exception $e) {

            $this->getUser()->setFlash('error', "Sólo puedes borrar concursos en estado de Revista.");
        }
        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        $this->redirect('@concurso');
    }

}

