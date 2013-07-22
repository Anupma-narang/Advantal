<?php

require_once dirname(__FILE__) . '/../lib/colaboradorpuntodefinicionGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/colaboradorpuntodefinicionGeneratorHelper.class.php';

/**
 * colaboradorpuntodefinicion actions.
 *
 * @package    symfony
 * @subpackage colaboradorpuntodefinicion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class colaboradorpuntodefinicionActions extends autoColaboradorpuntodefinicionActions {

  public function executeShow(sfWebRequest $request) {
    $this->punto = $this->getRoute()->getObject();
  }

  protected function processForm(sfWebRequest $request, sfForm $form) {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $ma_values = $request->getParameter($form->getName());
        $colaboradorpuntodefinicion = $form->save();

        $colaboradorpuntodefinicion->setPuntos((int) str_replace('.', '', trim($ma_values['puntos'])));
        $colaboradorpuntodefinicion->save();
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $colaboradorpuntodefinicion)));

      if ($request->hasParameter('_save_and_add')) {
        $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

        $this->redirect('@colaboradorpuntodefinicion_new');
      } else {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'colaboradorpuntodefinicion'));
      }
    } else {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

}
