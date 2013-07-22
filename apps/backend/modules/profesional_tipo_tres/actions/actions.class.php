<?php

require_once dirname(__FILE__) . '/../lib/profesional_tipo_tresGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/profesional_tipo_tresGeneratorHelper.class.php';

/**
 * profesional_tipo_tres actions.
 *
 * @package    auditoscopia
 * @subpackage profesional_tipo_tres
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profesional_tipo_tresActions extends autoProfesional_tipo_tresActions {

    public function executeShow(sfWebRequest $request) {
        $this->profesional = $this->getRoute()->getObject();
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {

                $profesionalTipoTres = $form->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $profesionalTipoTres)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');
                $this->redirect('@profesional_tipo_tres_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);
                $this->redirect(array('sf_route' => 'profesional_tipo_tres'));
            }
        } else {
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
            case 'profesional_tipo_uno':
                $sort[0] = 'ptu.name';
                break;

            case 'profesional_tipo_dos':
                $sort[0] = 'ptd.name';
                break;
        }

        $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    }

    protected function isValidSortColumn($column) {
        $extraColumn = array('profesional_tipo_uno', 'profesional_tipo_dos');

        return Doctrine_Core::getTable('ProfesionalTipoDos')->hasColumn($column) || in_array($column, $extraColumn);
    }

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $filter_column = $this->getUser()->getAttribute('profesional_tipo_tres.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

}
