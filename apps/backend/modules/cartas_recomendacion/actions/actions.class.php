<?php

require_once dirname(__FILE__) . '/../lib/cartas_recomendacionGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/cartas_recomendacionGeneratorHelper.class.php';

/**
 * cartas_recomendacion actions.
 *
 * @package    symfony
 * @subpackage cartas_recomendacion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cartas_recomendacionActions extends autoCartas_recomendacionActions {

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());
        $filter_column = $this->getUser()->getAttribute('cartas_recomendacion.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

        //Query customization
        $query->andWhere('is_first = ?', 0);
        $query->andWhere('profesional_letter_type_id=?', 1);
        $query->andWhereIn('profesional_letter_estado_id', array(2, 9));


        $request = sfContext::getInstance()->getRequest();
        
        if(! $request->hasParameter('sort') && ! $request->hasParameter('sort_type'))
        {
          $query->orderBy('created_at DESC');
        }


        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

    public function executeShow(sfWebRequest $request) {
        $this->concurso = $this->getRoute()->getObject();
    }

    public function executeShowIncidencia(sfWebRequest $request) {
        $this->setLayout('layout_emergente_new');
        $this->cartas = Doctrine::getTable('ProfesionalLetter')->findOneBy('id', $request->getParameter('id'));
        $this->professional_des = Doctrine::getTable('Profesional')->findOneBy('id', $this->cartas->getProfesionalId());
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

            case 'activity_name_tres':
                $sort[0] = 'ptt.name';
                break;

            case 'SectorName':
                $sort[0] = 'ptu.name';
                break;

            case 'SubSectorName':
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

            case 'first_name':
                $sort[0] = 'p.first_name';
                break;

            case 'last_name_one':
                $sort[0] = 'p.last_name_one';
                break;

            case 'last_name_two':
                $sort[0] = 'p.last_name_two';
                break;
        }

        $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    }

    protected function isValidSortColumn($column) {
        $extraColumn = array('city_name', 'state_name', 'activity_name_tres', 'username', 'last_name_one', 'SectorName', 'SubSectorName', 'last_name_two', 'first_name', 'created_at');

        return Doctrine_Core::getTable('ProfesionalLetter')->hasColumn($column) || in_array($column, $extraColumn);
    }

    public function executeChangeStatus(sfWebRequest $request) {
        $this->forward404Unless($estado = $request->getParameter("estado", 2), 'Es necesario indicar el nuevo estado.');
        $this->forward404Unless($id = $request->getParameter("id"), 'Es necesario indicar el id del carta.');

        $this->cartas = $this->getRoute()->getObject();


        $request->setParameter("recomend_profesional", true);

        $last = $this->cartas->getProfesionalLetterEstadoId();
        $this->cartas->setProfesionalLetterEstadoId($estado);

        if ($estado == 2) {
            $flag = Doctrine::getTable('UserNotification')->isActiveNotification('publica_recomend_disaprov_value', $this->cartas->getProfesional()->getUserId());
            if ($flag->count()) {
                cp::sendLetterActiveMail($this->cartas);
            }

            // Alert, if disaproval rate more than 25%
            Doctrine::getTable('ProfesionalLetter')->makeAatioAlert($this->cartas->getProfessionalId());

            $this->cartas->setFechaActivacion(date('Y-m-d'));

            //los puntos
            $codigos = Doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic=true')->execute();
            foreach ($codigos as $codigo) {
                if ($request->getParameter($codigo->getCodigo())) {
                    $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo($codigo->getCodigo());

                    $this->cartas->getUser()->getProfile()->setPuntos($puntos);
                    ColaboradorPuntosHistoricoTable::new_log($this->cartas->getUserId(), $codigo->getDescripcion(), $puntos, 'carta', $this->cartas->getId());
                }
            }
            if (($otro_descripcion = $request->getParameter('otro_descripcion')) && ($otro_puntos = $request->getParameter('otro_puntos'))) {
                $this->cartas->getUser()->getProfile()->setPuntos($otro_puntos);
                ColaboradorPuntosHistoricoTable::new_log($this->cartas->getUserId(), $otro_descripcion, $otro_puntos, 'carta', $this->cartas->getId());
            }
        } elseif ($estado == 3)
            $this->cartas->setFechaReferendum(date('Y-m-d'));
        elseif ($estado == 4)
            $this->cartas->setFechaDeliberacion(date('Y-m-d H:i:s'));
        elseif ($estado == 5)
            $this->cartas->setFechaObservacion(date('Y-m-d H:i:s'));
        elseif ($estado == 6)
            $this->cartas->setFechaCerrado(date('Y-m-d H:i:s'));
        elseif ($estado == 7)
            $this->cartas->setFechaRechazado(date('Y-m-d H:i:s'));
        elseif ($estado == 8)
            $this->cartas->setFechaNulo(date('Y-m-d H:i:s'));
        elseif ($estado == 10) {
            $this->cartas->setFechaRevision(date('Y-m-d H:i:s'));
            $this->cartas->setRevisionLastStateId($last);
        }

        $this->cartas->save();

        // guardamos en el histórico cada cambio de estado
        $cartas_historico = new ProfesionalLetterHistorico();
        $cartas_historico->setProfesionalLetterId($this->cartas->getId());
        $cartas_historico->setDate(date('Y-m-d H:i:s'));
        $cartas_historico->setEstadoInicial($last);
        $cartas_historico->setEstadoFinal($estado);
        $cartas_historico->save();

        //$this->redirect("cartas_pendientes/show?id=".$this->cartas->id);
        /* if ($estado==2)
          {
          $this->redirect("cartas/show?id=".$this->cartas->id);
          } else {
          $this->redirect("cartas_pendientes/show?id=".$this->cartas->id);
          } */

        if ($request->getParameter('siguiente') == 1) {
            if ($profesionalData = Doctrine::getTable('ProfesionalLetter')->createQuery()->where("profesional_letter_estado_id=1")->orderBy("created_at desc")->fetchOne())
                $this->redirect("cartas_recomendacion/show?id=" . $profesionalData->id);
            else
                $this->redirect("@homepage");
        }
        else {
            $this->redirect("cartas_recomendacion/show?id=" . $this->cartas->id);
        }
    }

    public function executeRevertStatus(sfWebRequest $request) {
        $cartas = $this->getRoute()->getObject();

        if (!in_array($cartas->profesional_letter_estado_id, array(2))) {
            $this->forward404();
        }

        if ($cartas_historico = Doctrine::getTable('ProfesionalLetterHistorico')->createQuery()->where("profesional_letter_id=" . $cartas->getId())->orderBy("created_at desc")->fetchOne()) {
            $estado_anterior = $cartas_historico->getEstadoInicial();
            $estado_actual = $cartas_historico->getEstadoFinal();
            $cartas->setProfesionalLetterEstadoId($estado_anterior);

            if ($estado_actual == 2)
                $cartas->setFechaActivacion(null);
            /* if ($estado_actual==4) $cartas->setFechaDeliberacion(null);
              if ($estado_actual==5) $cartas->setFechaObservacion(null);
              if ($estado_actual==6) $cartas->setFechaCerrado(null);
              if ($estado_actual==7) $cartas->setFechaRechazado(null);
              if ($estado_actual==8) $cartas->setFechaNulo(null); */

            $cartas->save();

            $cartas_historico->delete();
        }

        $this->redirect("cartas_recomendacion/show?id=" . $cartas->id);
    }

    public function executeAddEditRecommand(sfWebRequest $request) {
        $this->profesional_letter = Doctrine::getTable('Profesional')->find($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->profesional_letter);
        $this->processForm($request, $this->form);
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        if ($request->isMethod('post')) {
            $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
            if ($form->isValid()) {
                $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

                try {
                    $profesional_letter = $form->save();
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

                $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $profesional_letter)));

                if ($request->hasParameter('_save_and_add')) {
                    $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                    $this->redirect('@profesional_cartas_recomendacion_create?id=' . $profesional_letter->getId());
                } else {
                    $this->getUser()->setFlash('notice', $notice);

                    if ($request->getParameter('letter_id', ''))
                        $this->redirect('@profesional_letter_cartas_recomendacion');
                    else
                        $this->redirect("@profesional_letter");
                }
            }
            else {
                $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
            }
        }
    }

}
