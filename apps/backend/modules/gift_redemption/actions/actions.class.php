<?php

require_once dirname(__FILE__) . '/../lib/gift_redemptionGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/gift_redemptionGeneratorHelper.class.php';

/**
 * gift_redemption actions.
 *
 * @package    symfony
 * @subpackage gift_redemption
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gift_redemptionActions extends autoGift_redemptionActions {

  protected function buildQuery()
  {
    $tableMethod = $this->configuration->getTableMethod();
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }

    $this->filters->setTableMethod($tableMethod);
    $this->filter_array = $this->getFilters();

    $tempFilters = $this->getFilters();

    if(isset($tempFilters['user']) && $tempFilters['user'] != '')
    {
      $tempUsername = $tempFilters['user'];
      $tempFilters['user'] = '';      
    }
    
    $query = $this->filters->buildQuery($tempFilters);    
    $filter_parameters = $tempFilters;

    
    $filter_column = $this->getUser()->getAttribute('gift_redemption.filters', null, 'admin_module');
    $this->filtershow = $filter_column;

   
    if(isset($filter_parameters['status']) && $filter_parameters['status'] != 0){
      $query->andWhere('status =?',$filter_parameters['status']);
    }
    
    if(isset($tempUsername))
    {
      $tempUsers = Doctrine_Query::create()->select('id')->from('sfGuardUser')->where('username  LIKE \'%' . addslashes($tempUsername) . '%\'')->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);

      if(count($tempUsers))
      {
        $query->andWhereIn('user', $tempUsers);
      }     
    }

    $this->addSortQuery($query);
    
    $request = sfContext::getInstance()->getRequest();
    if(! $request->hasParameter('sort') && ! $request->hasParameter('sort_type'))
    {

     $query->orderBy('created_at DESC');
    }

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();
//echo $query->getSqlQuery();die;
    return $query;
  }
  public function executeList_ver(sfWebRequest $request) {
    $this->gift_redemption = $this->getRoute()->getObject();
  }

  /**
   * change status to sent
   * @param sfWebRequest $request
   */
  public function executeSent(sfWebRequest $request) {

    $request_id = $request->getParameter('id');
    $this->forward404Unless($gift_redemption = Doctrine::getTable('GiftRedemption')->find($request_id));

    $gift_redemption->setStatus(2);
    $gift_redemption->save();

    $this->getUser()->setFlash('notice', 'Has enviado el regalo seleccionado.');
    $this->redirect('gift_redemption');
  }

  /**
   * change status to delivered
   * @param sfWebRequest $request
   */
  public function executeDelivered(sfWebRequest $request) {

    $request_id = $request->getParameter('id');
    $this->forward404Unless($gift_redemption = Doctrine::getTable('GiftRedemption')->find($request_id));

    $gift_redemption->setStatus(3);
    $gift_redemption->save();

    $this->getUser()->setFlash('notice', 'Ha entregado el regalo seleccionado.');
    $this->redirect('gift_redemption');
  }

  public function executeFilter(sfWebRequest $request)
  {

//    exit("filter action");
    
    $this->setPage(1);

    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->configuration->getFilterDefaults());

      $this->redirect('@gift_redemption');
    }
    
    $this->filters = $this->configuration->getFilterForm($this->getFilters());

    $tempFilters = $this->getFilters();
    
    if(isset($tempFilters['states_id']))
    {
      $this->filters->setDefault('states_id', $tempFilters['states_id']);
    }

    

    

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());
      if(isset($tempFilters['states_id']))
      {
        $this->filters->setDefault('states_id', $tempFilters['states_id']);
      }

      $this->redirect('@gift_redemption');
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }
  
  public function executeCreate(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->gift_redemption = $this->form->getObject();

    $this->processForm($request, $this->form, true);

    $this->setTemplate('new');
  }
  
   protected function processForm(sfWebRequest $request, sfForm $form, $create_flag = false)
  {
    $request_parameter = $request->getParameter($form->getName());
    if($create_flag == true){
      $request_parameter['created_at'] = date('d-m-Y H:i:s');
      
    }
    
    $form->bind($request_parameter, $request->getFiles($form->getName()));
    
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $gift_redemption = $form->save();
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $gift_redemption)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@gift_redemption_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'gift_redemption', 'sf_subject' => $gift_redemption));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  

}
