<?php

require_once dirname(__FILE__).'/../lib/producto_tipo_tresGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/producto_tipo_tresGeneratorHelper.class.php';

/**
 * producto_tipo_tres actions.
 *
 * @package    auditoscopia
 * @subpackage producto_tipo_tres
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class producto_tipo_tresActions extends autoProducto_tipo_tresActions
{
  public function executeIndex(sfWebRequest $request)
	{
		// sorting
		if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
		{
			$this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
		}
			
		// pager
		if ($request->getParameter('page'))
		{
			$this->setPage($request->getParameter('page'));
		}
	
		$this->pager = $this->getPager();
				
		//si tenemos el arg user_id lo usamos para mostrar solo la info de ese user
		if($user_id = $request->getParameter('user_id')){
			$this->pager->setQuery($this->only_user($user_id));
		}
		
		
		$this->sort = $this->getSort();
	}
  
  public function executeShow(sfWebRequest $request)
	{
		$this->producto = $this->getRoute()->getObject();
	}
  protected function buildQuery()
  {
    $tableMethod = $this->configuration->getTableMethod();
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }
    $filter_column = $this->getUser()->getAttribute('producto_tipo_tres.filters', null, 'admin_module');

    $this->filtershow = $filter_column;
    
    $this->filters->setTableMethod($tableMethod);

    $query = $this->filters->buildQuery($this->getFilters());

    $this->addSortQuery($query);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();

    return $query;
  }
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $producto_tipo_tres = $form->save();
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $producto_tipo_tres)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@producto_tipo_tres_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'producto_tipo_tres'));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    try{
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        if ($this->getRoute()->getObject()->delete())
        {
        $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect('@producto_tipo_tres');
    }
    catch (Exception $e) {
        $this->redirect('@producto_tipo_tres?eid=1');
    }
  }
  
}
