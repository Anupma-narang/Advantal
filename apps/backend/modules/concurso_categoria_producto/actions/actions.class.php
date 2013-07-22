<?php

require_once dirname(__FILE__).'/../lib/concurso_categoria_productoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/concurso_categoria_productoGeneratorHelper.class.php';

/**
 * concurso_categoria_producto actions.
 *
 * @package    symfony
 * @subpackage concurso_categoria_producto
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class concurso_categoria_productoActions extends autoConcurso_categoria_productoActions
{
  protected function buildQuery()
	{
		$query = parent::buildQuery();
		
		$query->andWhere('concurso_tipo_id=2');
		
		return $query;
	}
  
  public function executeShow(sfWebRequest $request)
	{
		$this->categoria = $this->getRoute()->getObject();
	}
        
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $concurso_categoria = $form->save();
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $concurso_categoria)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@concurso_categoria_producto_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'concurso_categoria_producto'));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
