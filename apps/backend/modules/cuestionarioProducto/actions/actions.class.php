<?php

require_once dirname(__FILE__) . '/../lib/cuestionarioProductoGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/cuestionarioProductoGeneratorHelper.class.php';

/**
 * cuestionario actions.
 *
 * @package    auditoscopia
 * @subpackage cuestionario
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cuestionarioProductoActions extends autoCuestionarioProductoActions {

    protected function addSortQuery($query) {
        if (array(null, null) == ($sort = $this->getSort())) {
            return;
        }

        if (!in_array(strtolower($sort[1]), array('asc', 'desc'))) {
            $sort[1] = 'asc';
        }

        switch ($sort[0]) {
            case 'sector':
                $sort[0] = 'ptu.name';
                break;
            case 'subsector':
                $sort[0] = 'ptd.name';
                break;
            case 'actividad':
                $sort[0] = 'ptt.name';
                break;
        }

        $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    }

    protected function isValidSortColumn($column) {
        return Doctrine_Core::getTable('ListaCuestionario')->hasColumn($column) || $column == 'sector' || $column == 'subsector' || $column == 'actividad';
    }

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());
        $this->filtershow = $filter_column = $this->getUser()->getAttribute('cuestionarioProducto.filters', null, 'admin_module');


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

    public function executePendientes() {
        $respuestas = Doctrine_Core::getTable('ListaCuestionarioUser')->getPendientes();
        if (count($respuestas) == 0) {
            return $this->renderText('<ul><li>No existen datos.</li></ul>');
        }
        return $this->renderPartial('alertaCuestionarios', array('respuestas' => $respuestas));
    }

    public function executeAutocompletKpi(sfWebRequest $request) {
        $results = KpiTable::getInstance()->getAutocomplete($request->getParameter('q'), $request->getParameter('tipo'), $request->getParameter('id'));
        $values = array();
        foreach ($results as $result) {
            $values[$result['id']] = $result['nombre'];
        }
        ProjectUtility::decorateJsonResponse($this->getResponse());

        return $this->renderText(json_encode($values));
    }

    public function executeAddKpi(sfWebRequest $request) {
        $newValue = $request->getParameter('value');
        if ($newValue == '') {
            return $this->renderText(json_encode(array('id' => '')));
        }
        $tipo = $request->getParameter('tipo');
        ProjectUtility::decorateJsonResponse($this->getResponse());
        //mira si existe el valor por si se apreta el boton añadir sin querer...
        $kpi = KpiTable::getInstance()->nombreExist($newValue, $tipo);
        if ($kpi) {
            return $this->renderText(json_encode(array('id' => $kpi->getId())));
        }

        $newKpi = new Kpi();
        $newKpi->setNombre($newValue);
        $newKpi->setTipo($tipo);
        $newKpi->save();

        return $this->renderText(json_encode(array('id' => $newKpi->getId())));
    }

    public function executeShow() {
        $this->lista_cuestionario = $this->getRoute()->getObject();
    }

    public function executeRefreshChoices(sfWebRequest $request) {
        if ($request->getParameter('isEmpresa') == 'true') {
            $tipo = 'empresa';
        } else {
            $tipo = 'producto';
        }
        $cuestionaris = Doctrine_Core::getTable('ListaCuestionario')->findByTipo($tipo);
        $options = array();
        foreach ($cuestionaris as $cuestionari) {
            $options[$cuestionari->getId()] = $cuestionari->getNombre();
        }
        ProjectUtility::decorateJsonResponse($this->getResponse());

        return $this->renderText(json_encode($options));
    }

    public function executeAprobar(sfWebRequest $request) {
        $cuestionario = Doctrine_Core::getTable('ListaCuestionarioUser')->find($request->getParameter('id'));
        $cuestionario->setAprobado(true);
        $cuestionario->getProducto()->addAuditoria($cuestionario);

        $cuestionario->save();
        if ($request->isXmlHttpRequest()) {
            return $this->renderText('ok');
        }

        return $this->redirect('producto', array('id' => $cuestionario->getEmpresaId()));
    }

    public function executeBorrarComentarioyAprobar(sfWebRequest $request) {
        $cuestionario = Doctrine_Core::getTable('ListaCuestionarioUser')->find($request->getParameter('id'));
        $cuestionario->deleteComentarios();
        $cuestionario->setAprobado(true);
        $cuestionario->getEmpresa()->addAuditoria($cuestionario);

        $cuestionario->save();
        if ($request->isXmlHttpRequest()) {
            return $this->renderText('ok');
        }

        return $this->redirect('empresa', array('id' => $cuestionario->getEmpresaId()));
    }

    /**
     * Borra el cuestionario.
     *
     * @param sfWebRequest $request
     */
    public function executeDeleteCuestionario(sfWebRequest $request) {

        if (!$request->isMethod('POST')) {
            return $this->renderText('Peticion no válida');
        }
        $cuestionario = Doctrine_Core::getTable('ListaCuestionarioUser')->find($request->getParameter('id'));
        $cuestionario->getProducto()->removeAuditoria($cuestionario);

        $lastCuestionario = Doctrine_Core::getTable('ListaCuestionarioUser')->getLastCuestionarioDisabled($cuestionario);
        if ($lastCuestionario && $cuestionario->getDisabled() == false) {
            $lastCuestionario->markAsEnabled();
            $lastCuestionario->getProducto()->addAuditoria($lastCuestionario);
        }
        $cuestionario->delete();

        sfGuardUserProfileTable::removePuntos($cuestionario->getUserId());
        // $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('audit_lista_blanca');
        $codingo = Doctrine_Core::getTable('ColaboradorPuntoDefinicion')->findOneBy('codigo', 'audit_lista_blanca');
        ColaboradorPuntosHistoricoTable::new_log($cuestionario->getUserId(), $codingo->getDescripcion(), '-25', '', $request->getParameter('id'));

        if ($request->isXmlHttpRequest()) {
            return $this->renderText('');
        }

        return $this->redirect('producto', array('id' => $cuestionario->getProductoId()));
    }

    public function executeDuplicar(sfWebRequest $request) {
        $this->cuestionario = $this->getRoute()->getObject();
        /** @var ListaCuestionario $nuevoCuestionario  */
        $nuevoCuestionario = $this->cuestionario->copy();
        $nuevoCuestionario->setListaCuestionarioPregunta(new Doctrine_Collection("ListaCuestionarioPregunta"));
        $nuevoCuestionario->save();
        foreach ($this->cuestionario->getListaCuestionarioPregunta() as $pregunta) {
            $pregunta = $pregunta->copy();
            $pregunta->lista_cuestionario_id = $nuevoCuestionario->getId();
            $pregunta->save();
        }
        //copiar relaciones...


        return $this->redirect('cuestionario_producto');
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->setTemplate('edit');

        $this->lista_cuestionario = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->lista_cuestionario);
        if ($request->isXmlHttpRequest()) {

            return $this->processForm($request, $this->form);
        } else {
            $this->processForm($request, $this->form);
        }
    }

    public function executeCreate(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->lista_cuestionario = $this->form->getObject();
        $this->setTemplate('new');

        if ($request->isXmlHttpRequest()) {
            return $this->processForm($request, $this->form);
        } else {
            $this->processForm($request, $this->form);
        }
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {


        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $lista_cuestionario = $form->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $lista_cuestionario)));

            if ($request->isXmlHttpRequest()) {
                return $this->renderText('ok');
            }


            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@cuestionario_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'cuestionario_producto'));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    

    public function executeNew(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->lista_cuestionario = $this->form->getObject();
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        //test if there a product with this cuestionario
        $cuestionario = $this->getRoute()->getObject();
        try {
            $cuestionario->delete();
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        } catch (Doctrine_Connection_Mysql_Exception $e) {
            $this->getUser()->setFlash('error', 'No se puede borrar este cuestionario porqué tiene un producto asociado.');
        }

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));


        $this->redirect('@cuestionario_producto');
    }

}
