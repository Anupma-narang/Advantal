<?php

require_once dirname(__FILE__).'/../lib/producto_tipo_dosGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/producto_tipo_dosGeneratorHelper.class.php';

/**
 * producto_tipo_dos actions.
 *
 * @package    auditoscopia
 * @subpackage producto_tipo_dos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class producto_tipo_dosActions extends autoProducto_tipo_dosActions
{
  public function executeShow(sfWebRequest $request)
	{
		$this->producto = $this->getRoute()->getObject();
	}
        
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $producto_tipo_dos = $form->save();
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $producto_tipo_dos)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@producto_tipo_dos_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'producto_tipo_dos'));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  protected function buildQuery()
  {
    $tableMethod = $this->configuration->getTableMethod();
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }

    $filter_column = $this->getUser()->getAttribute('producto_tipo_dos.filters', null, 'admin_module');

    $this->filtershow = $filter_column;
    
    $this->filters->setTableMethod($tableMethod);

    $query = $this->filters->buildQuery($this->getFilters());

    $sort = $this->getSort();
    $sort_column = $this->getUser()->getAttribute('producto_tipo_dos.sort', null, 'admin_module');
    if ($sort_column[0] == 'producto_tipo_uno_id')
    {
      $query = Doctrine_Query::create()
        ->from('ProductoTipoDos esd')
      ->leftJoin('esd.ProductoTipoUno esu')
      ->orderBy('esu.name'. ' ' . $sort[1]);
    }
    else{
            if ($sort[0] != ""){
            $query->addOrderBy($sort[0]. ' ' . $sort[1]);
            }
            else{
                $this->addSortQuery($query);
            }
    }

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();

    return $query;
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

        $this->redirect('@producto_tipo_dos');
    }
    catch (Exception $e) {
        $this->redirect('@producto_tipo_dos?eid=1');
    }
  }
  
}
