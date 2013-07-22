<?php

require_once dirname(__FILE__).'/../lib/recomended_registrationGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/recomended_registrationGeneratorHelper.class.php';

/**
 * recomended_registration actions.
 *
 * @package    symfony
 * @subpackage recomended_registration
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class recomended_registrationActions extends autoRecomended_registrationActions
{
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $recomended_registration = $form->save();
        if ($form->getObject()->isNew()) {
          $recomended_registration->setCreatedAt(date('Y-m-d H:i:s'));
        } else {
          $recomended_registration->setCreatedAt(date('Y-m-d H:i:s'));
        }
        $recomended_registration->save();
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $recomended_registration)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@recomended_registration_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'recomended_registration_edit', 'sf_subject' => $recomended_registration));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  /*protected function buildQuery()
  {
    $tableMethod = $this->configuration->getTableMethod();
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
      
    }
print_r($this->getFilters());die;
    $this->filters->setTableMethod($tableMethod);
    
    $query = $this->filters->buildQuery($this->getFilters());

    $this->addSortQuery($query);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();

    return $query;
  }*/
}
