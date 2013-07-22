<?php

require_once dirname(__FILE__) . '/../lib/PizarraSectionGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/PizarraSectionGeneratorHelper.class.php';

/**
 * PizarraSection actions.
 *
 * @package    symfony
 * @subpackage PizarraSection
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pizarraSectionActions extends autoPizarraSectionActions {

  protected function processForm(sfWebRequest $request, sfForm $form) {
    $request_parameter = $request->getParameter($form->getName());
    if ($form->getObject()->isNew()) {
      $request_parameter['created_at'] = date('Y-m-d H:i:s');
    }

    
    $form->bind($request_parameter, $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $pizarra_section = $form->save();
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $pizarra_section)));

      if ($request->hasParameter('_save_and_add')) {
        $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

        $this->redirect('@pizarra_section_new');
      } else {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('@pizarra_section');
      }
    } else {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

}
