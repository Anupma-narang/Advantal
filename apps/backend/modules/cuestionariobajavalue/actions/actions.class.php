<?php

require_once dirname(__FILE__) . '/../lib/cuestionariobajavalueGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/cuestionariobajavalueGeneratorHelper.class.php';

/**
 * cuestionariobajavalue actions.
 *
 * @package    symfony
 * @subpackage cuestionariobajavalue
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cuestionariobajavalueActions extends autoCuestionariobajavalueActions {

    public function executeShow(sfWebRequest $request) {
        //$this->forward404Unless($user_id = $request->getParameter('id'));
        /* $this->forward404Unless($this->cuestionario = Doctrine::getTable('CuestionarioBajaValue')
          ->createQuery()
          ->where('id=?', $request->getParameter('id'))
          ->execute()); */
        //$this->forward404Unless($this->cuestionario = Doctrine_Core::getTable('CuestionarioBajaValue')->find($request->getParameter('id')));
        $this->forward404Unless($user_id = $request->getParameter('id'));
        $this->forward404Unless($this->cuestionario = Doctrine::getTable('CuestionarioBajaValue')
                ->createQuery()
                ->where('user_id=?', $user_id)
                ->execute());
    }

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $filter_column = $this->getUser()->getAttribute('cuestionariobajavalue.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

        $query->addWhere('pregunta_id=1');

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

    public function executeEdit(sfWebRequest $request) {
        $this->forward404('Not allowed.');
        // $this->cuestionario_baja_value = $this->getRoute()->getObject();
        // $this->form = $this->configuration->getForm($this->cuestionario_baja_value);
    }

}
