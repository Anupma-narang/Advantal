<?php

require_once dirname(__FILE__) . '/../lib/pizarraGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/pizarraGeneratorHelper.class.php';

/**
 * pizarra actions.
 *
 * @package    symfony
 * @subpackage pizarra
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pizarraActions extends autoPizarraActions {

    public function preExecute() {
        $this->configuration = new pizarraGeneratorConfiguration();

        if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName()))) {
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }

        $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

        $this->helper = new pizarraGeneratorHelper();

        parent::preExecute();
    }

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
    }

    public function executeList_ver(sfWebRequest $request) {
        $this->pizarra = $this->getRoute()->getObject();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->pizarra = $this->form->getObject();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->pizarra = $this->form->getObject();
        //process form


        $parameter = $request->getParameter($this->form->getName());

        $this->form->bind($parameter);

        if ($this->form->isValid()) {
            $parameter = $this->saveForm($request, $this->form);
            $this->form->save();

            $this->pizarra = $this->form->getObject();
            $this->pizarra->setDays($parameter['days']);
            $this->pizarra->setMonths($parameter['months']);
            $this->pizarra->setCreatedAt(date('Y-m-d H:i:s'));
            $this->pizarra->save();
            $this->setPizarrarSectionMapping($this->pizarra->getId(), $parameter['seccion']);
            $notice = $this->form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $pizarra)));
            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@pizarra_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect('@pizarra');
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
        $this->setTemplate('new');
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->pizarra = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->pizarra);


        $parameter = $request->getParameter($this->form->getName());
        $parameter['created_at'] = $this->pizarra->getCreatedAt();
        $this->form->bind($parameter);
        if ($this->form->isValid()) {
            $parameter = $this->saveForm($request, $this->form);

            $this->form->save();
            $this->pizarra = $this->form->getObject();
            $this->pizarra->setDays($parameter['days']);
            $this->pizarra->setMonths($parameter['months']);
            $this->pizarra->save();
            $this->setPizarrarSectionMapping($this->pizarra->getId(), $parameter['seccion']);
            $this->redirect('@pizarra');
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }

        $this->getPizarraSectionMapping($this->pizarra->getId());
        $this->getDefaultValues();
        $this->setTemplate('edit');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->pizarra = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->pizarra);
        $this->getDefaultValues();
        $this->getPizarraSectionMapping($this->pizarra->getId());
    }

    private function getDefaultValues() {
        //get days
        $days = $this->pizarra->getDays();
        //get days array
        $days_array = explode(",", $days);
        //set default value for days
        $this->form->setDefaultValues('days', $days_array);
        //get months
        $months = $this->pizarra->getMonths();
        //get months array
        $months_array = explode(",", $months);
        //set default value for months
        $this->form->setDefaultValues('months', $months_array);
    }

    private function saveForm($request, $form) {
        //get parameters
        $parameter = $request->getParameter($form->getName());

        //get days array
        if (isset($parameter['days'])) {
            $days = $parameter['days'];
            //set days in string
            $day_string = '';
            foreach ($days as $day) {
                $day_string .= ',' . $day;
            }
            $parameter['days'] = $day_string;
        }

        //get months array

        if (isset($parameter['months'])) {
            $months = $parameter['months'];
            //set months in string
            $month_string = '';
            foreach ($months as $month) {
                $month_string .= ',' . $month;
            }
            //set days,months parameter with string
            $parameter['months'] = $month_string;
        }



        return $parameter;
    }

    /**
     * create pizarra section mapping record
     * @param String $pizzara_id
     * @param String $section_list
     */
    private function setPizarrarSectionMapping($pizzara_id, $section_list) {

        //delete existing pizarra section records
        Doctrine::getTable('PizarraSectionMapping')->deleteRecordByPizarraId($pizzara_id);
        foreach ($section_list as $index => $section_id) {
            //create and save pizarra section mapping records
            $pizzara_section_mapping = new PizarraSectionMapping();
            $pizzara_section_mapping->create($pizzara_id, $section_id);
        }
    }

    private function getPizarraSectionMapping($pizzara_id) {
        //set default parameter for section

        $this->form->setDefaultValues('seccion', array_keys(Doctrine::getTable('PizarraSectionMapping')->getSectionList($pizzara_id)));
    }

    /* public function executeFilter(sfWebRequest $request) {
      $this->setPage(1);

      if ($request->hasParameter('_reset')) {
      $this->setFilters($this->configuration->getFilterDefaults());

      $this->redirect('@pizarra');
      }

      $this->filters = $this->configuration->getFilterForm($this->getFilters());

      $this->filters->bind($request->getParameter($this->filters->getName()));
      if ($this->filters->isValid()) {
      $this->setFilters($this->filters->getValues());

      $this->redirect('@pizarra');
      }

      $this->pager = $this->getPager();
      $this->sort = $this->getSort();

      $this->setTemplate('index');
      } */

    protected function buildQuery() {

        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $filter_values = $this->getFilters();

        $filter_column = $this->getUser()->getAttribute('pizarra.filters', null, 'admin_module');
        $this->filtershow = $filter_column;

//        echo "<pre>";print_r($filter_values);exit;
        
        $query = $this->filters->buildQuery($this->getFilters());
        
        if ($filter_values['visibilidad'] != "") {
          
          $hierarchyId = $filter_values['visibilidad'];
          
          $filterids = array();

          for($i=$hierarchyId;$i>=0;$i--)
          {
            array_push($filterids, $i);
          }

          $query->andWhereIn('visibilidad',  $filterids);
        }
        if (!empty($filter_values['seccion']['text'])) {
            $query->leftJoin($query->getRootAlias() . '.PizarraSectionMapping psm')
                    ->leftJoin('psm.PizarraSection ps')
                    ->where('ps.short_name =?', $filter_values['seccion']['text']);
        }
        if (!empty($filter_values['velocidad'])) {
            $query->andWhere('velocidad =?', $filter_values['velocidad']);
        }
        if (!empty($filter_values['days'])) {
            $query->andWhere('days LIKE "%' . $filter_values['days'] . '%"');
        }
        if (!empty($filter_values['months'])) {
            $query->andWhere('months LIKE "%' . $filter_values['months'] . '%"');
        }
        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();
        if (array(null, null) == ($sort = $this->getSort())) {
            $query->orderBy('created_at DESC');
        }



        return $query;
    }

}

