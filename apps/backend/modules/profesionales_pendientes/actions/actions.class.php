<?php

require_once dirname(__FILE__) . '/../lib/profesionales_pendientesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/profesionales_pendientesGeneratorHelper.class.php';

/**
 * profesionales_pendientes actions.
 *
 * @package    symfony
 * @subpackage profesionales_pendientes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profesionales_pendientesActions extends autoProfesionales_pendientesActions {

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $filter_column = $this->getUser()->getAttribute('profesionales_pendientes.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

        //Query customization
        $query->addWhere('profesional_estado_id=?', 1);

        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

    public function executeShow(sfWebRequest $request) {


        $this->profesional = Doctrine::getTable("Profesional")->findOneById($request->getParameter("id"));
        $this->activeReasonForm = new ProfesionalPendienteReasonForm($this->profesional);

        $this->letterCount = Doctrine_Core::getTable('ProfesionalLetter')->getAttachedRecomendation($request->getParameter('id'));
        if ($request->isMethod('post')) {
            $this->activeReasonForm->bind($request->getParameter($this->activeReasonForm->getName()), $request->getFiles($this->activeReasonForm->getName()));

            if ($this->activeReasonForm->isValid()) {
                $this->activeReasonForm->save();
                $signature = ($request->getParameter('siguiente') == 1) ? '&siguiente=1' : '';
                $this->redirect(url_for('profesionales_pendientes/changeStatus?id=' . $this->profesional->getId() . $signature));
            }
        }


        $this->n_profesional_destacados = Doctrine::getTable('profesional')
                ->createQuery('p')
                //->where('c.destacado = true')
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
        $this->puntos = Doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic = true')->execute();
        $this->profesionalRecomenda = Doctrine_Core::getTable('ProfesionalLetter')->findOneByProfesionalId($request->getParameter('id'));
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

    public function executeListVolver(sfWebRequest $request) {
        $profesional = $this->getRoute()->getObject();
        $this->redirect('profesionalLista/show?id=' . $profesional->getId());
    }

    public function executeChangeStatus(sfWebRequest $request) {
        $this->forward404Unless($estado = $request->getParameter("estado", 2), 'Es necesario indicar el nuevo estado.');
        $this->forward404Unless($id = $request->getParameter("id"), 'Es necesario indicar el id del profesional.');
        $request->setParameter("alta_profesional", true);
        $this->profesional = $this->getRoute()->getObject();
        $last = $this->profesional->getProfesionalEstadoId();
        $this->profesional->setProfesionalEstadoId($estado);

        if ($estado == 2) {


            $profesional = Doctrine_Query::create()
                    ->select('p.id')
                    ->from('Profesional p')
                    ->where('p.id != ?', $this->profesional->getId())
                    ->andwhere('p.first_name = ?', $this->profesional->getFirstName())
                    ->andwhere('p.last_name_one = ?', $this->profesional->getLastNameOne())
                    ->andwhere('p.last_name_two = ?', $this->profesional->getLastNameTwo())
                    ->andwhere('p.road_type_id = ?', $this->profesional->getRoadTypeId())
                    ->andwhere('p.address = ?', $this->profesional->getAddress())
                    ->andwhere('p.numero = ?', $this->profesional->getNumero())
                    ->andwhere('p.city_id = ?', $this->profesional->getCityId())
                    ->andwhere('p.profesional_estado_id = 2')
                    ->andwhere('p.states_id = ?', $this->profesional->getStatesId())
                    ->execute();
            if (count($profesional) > 0) {
                $this->getUser()->setFlash('errorDuplicate', 'Ya existe un profesional con esas características. Por favor revísalo.');                
                $this->redirect('profesionales_pendientes/show?id=' . $this->profesional->getId());
            }
            
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
                $this->redirect("profesionales_pendientes/show?id=" . $profesionalData->getId());
            else
                $this->redirect("@homepage");
        }
        else if ($request->getParameter('rechazar') == 1) {
            $this->redirect("@profesional");
        } else {
            if ($estado == 2) {
                $this->redirect("@profesional");
            } else {
                $this->redirect("profesionales_pendientes/show?id=" . $this->profesional->id);
            }
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

        $this->redirect("concursos_pendientes/show?id=" . $concurso->id);
    }

    public function executeVolver(sfWebRequest $request) {
        $this->redirect('@profesionales_pendientes');
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

            $this->redirect("profesionales_pendientes/changeStatus?id=" . $profesional->id . "&estado=9&rechazar=1");
        }
    }

    public function executeDestacar(sfWebRequest $request) {

        if ($request->getParameter("tipo") == "temporal") {
            $this->forward404Unless($request->getParameter("tiempo"));
            $this->profesional_destacado = new ProfesionalDestacadosTemporales();
            $this->profesional_destacado->profesional_id = $request->getParameter("profesional_id");
            $this->profesional_destacado->tipo_tiempo_id = $request->getParameter("tiempo");
            $this->profesional_destacado->created_at = date("Y-m-d H:i:s");
            $this->profesional_destacado->updated_at = date("Y-m-d H:i:s");

            $this->profesional_destacado->save();
            $this->redirect("profesionales_pendientes/show?id=" . $this->profesional_destacado->profesional_id);
        } else if ($request->getParameter("tipo") == "normal") {
            $this->profesional = Doctrine::getTable("Profesional")->findOneById($request->getParameter("profesional_id"));
            $this->profesional->destacado = 1;
            $this->profesional->fecha_destacado = date("Y-m-d H:i:s");
            $this->profesional->save();
            $this->redirect("profesionales_pendientes/show?id=" . $this->profesional->id);
        }
    }

    public function executeRetirar(sfWebRequest $request) {
        if ($request->getParameter("tipo") == "temporal") {
            $this->profesional_destacado = Doctrine::getTable("ProfesionalDestacadosTemporales")
                    ->findOneByProfesionalIdAndTipoTiempoId($request->getParameter("profesional_id"), $request->getParameter("tiempo"));
            $this->profesional_destacado->delete();
            $this->redirect("profesionales_pendientes/show?id=" . $request->getParameter("profesional_id"));
        } else if ($request->getParameter("tipo") == "normal") {
            $this->profesional = Doctrine::getTable("Profesional")->findOneById($request->getParameter("profesional_id"));
            $this->profesional->destacado = 0;
            $this->profesional->fecha_destacado = null;
            $this->profesional->save();
            $this->redirect("profesionales_pendientes/show?id=" . $this->profesional->id);
        }
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $profesionalPendient = $form->save();

                $asValues = $request->getParameter($form->getName());
                ProfesionalLetter::addProfesionalLetter($profesionalPendient, $asValues);
                Alertas::saveNewProfesionalAlerts($profesionalPendient);
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $profesionalPendient)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');
                $this->redirect('@profesionales_pendientes_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);
                $this->redirect(array('sf_route' => 'profesionales_pendientes'));
            }
        } else {
            $gform = $form->getEmbeddedForm('profesionalGoogleMap');
            $gformValues = $form->getTaintedValues();
            $gform->setDefaults(array('address' => 'de'));
            $gform->bind($gformValues['profesionalGoogleMap'], array());

            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
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

            case 'activity_name':
                $sort[0] = 'ptt.name';
                break;

            case 'profesional_tipo_uno':
                $sort[0] = 'ptu.name';
                break;

            case 'profesional_tipo_dos':
                $sort[0] = 'ptd.name';
                break;

            case 'state_name':
                $sort[0] = 's.name';
                break;

            case 'city_name':
                $sort[0] = 'c.name';
                break;

            case 'username':
                $sort[0] = 'sf.username';
                break;
        }

        $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    }

    protected function isValidSortColumn($column) {
        $extraColumn = array('city_name', 'state_name', 'activity_name', 'profesional_tipo_uno', 'profesional_tipo_dos', 'username', 'last_name_one', 'last_name_two', 'first_name', 'created_at');

        return Doctrine_Core::getTable('ProfesionalTipoDos')->hasColumn($column) || in_array($column, $extraColumn);
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $cuestionario = $this->getRoute()->getObject();
        $o__alert = new Alertas();
        try {
            $o__alert->deleteProfesionalAlerts($cuestionario->getId());
            $cuestionario->delete();
            $this->getUser()->setFlash('notice', 'El elemento se ha borrado correctamente.');
        } catch (Doctrine_Connection_Mysql_Exception $e) {
            $this->getUser()->setFlash('error', 'No se puede borrar esta producto porqué tiene concursos o cuestionarios asociados');
        }

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        /* if ($this->getRoute()->getObject()->delete()) {
          $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
          } */

        $this->redirect('@profesionales_pendientes');
    }

}
