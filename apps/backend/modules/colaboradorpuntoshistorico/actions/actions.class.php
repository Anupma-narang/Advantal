<?php

require_once dirname(__FILE__) . '/../lib/colaboradorpuntoshistoricoGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/colaboradorpuntoshistoricoGeneratorHelper.class.php';

/**
 * colaboradorpuntoshistorico actions.
 *
 * @package    symfony
 * @subpackage colaboradorpuntoshistorico
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
  class colaboradorpuntoshistoricoActions extends autoColaboradorpuntoshistoricoActions {

    protected function buildQuery()
    {
      
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $tempFilters = $this->getFilters();

        // process for customize filter query
        if(isset($tempFilters['puntos']['text']) && trim($tempFilters['puntos']['text']) != "")
        {
          $puntosTemp = trim($tempFilters['puntos']['text']);
          $puntosTemp2 = str_replace('.', '', $puntosTemp);
          $puntosTemp2 = str_replace(',', '.', $puntosTemp2);
          
          $tempFilters['puntos']['text']= '';
        }
        
       
        if(isset($tempFilters['user_name']) && trim($tempFilters['user_name']) != "")
        {
          $filterUsername = $tempFilters['user_name'];
          $tempFilters['user_name']= '';
        }

        $query = $this->filters->buildQuery($tempFilters);        
        $filter_column = $this->getUser()->getAttribute('colaboradorpuntoshistorico.filters', null, 'admin_module');
        $this->filtershow = $filter_column;

        if(isset($puntosTemp))
        {
          $query->andWhere('puntos  LIKE \'%' . addslashes($puntosTemp) . '%\''.' OR puntos  LIKE \'%' . addslashes($puntosTemp2) . '%\'');
        }
        
        if(isset($filterUsername))
        {                   
          $tempUsers = Doctrine_Query::create()->select('id')->from('sfGuardUser')->where('username  LIKE \'%' . addslashes($filterUsername) . '%\'')->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
          
          if(count($tempUsers))
          {            
            $query->andWhereIn('user_id', $tempUsers);
          }          
        }

        $request = sfContext::getInstance()->getRequest();

        if(! $request->hasParameter('sort') && ! $request->hasParameter('sort_type'))
        {
          $query->orderBy('created_at DESC');
        }

        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();
        return $query;
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

        //si tenemos el arg user_id lo usamos para mostrar solo la info de ese user
        if ($user_id = $request->getParameter('user_id')) {
            $this->pager->setQuery($this->only_user($user_id));
        }


        $this->sort = $this->getSort();        
    }

    public function executeNew(sfWebRequest $request)
    {            
      $this->form = $this->configuration->getForm();
      $this->colaboradorpuntoshistorico = $this->form->getObject();      
      
    }

    protected function only_user($user_id) {
        $query = parent::buildQuery();

        //Query customization
        $query->addWhere('user_id=?', $user_id);

        return $query;
    }

    public function executeEdit(sfWebRequest $request) {
        $this->colaboradorpuntoshistorico = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->colaboradorpuntoshistorico);        
        $puntos = $this->getUser()->getMoneyInFormat($this->colaboradorpuntoshistorico->getPuntos());
        $this->form->setDefault('puntos', $puntos);
    }

    public function executeShow(sfWebRequest $request) {
        $this->historico = $this->getRoute()->getObject();
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $request_parameter = $request->getParameter($form->getName());
        
        $form->bind($request_parameter, $request->getFiles($form->getName()));        
        
        if ($form->isValid()) {            
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';						
						
            try {                
                $puntos = $request_parameter['puntos'];                
                $request_parameter['puntos'] = $puntos;
                $form->bind($request_parameter);
                if ($form->isValid()) {                    
                    $colaboradorpuntoshistorico = $form->save();
                } else {
                    $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
                }                
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $colaboradorpuntoshistorico)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@colaboradorpuntoshistorico_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'colaboradorpuntoshistorico'));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

}
