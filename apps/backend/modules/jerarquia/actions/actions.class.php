<?php

require_once dirname(__FILE__) . '/../lib/jerarquiaGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/jerarquiaGeneratorHelper.class.php';

/**
 * jerarquia actions.
 *
 * @package    symfony
 * @subpackage jerarquia
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class jerarquiaActions extends autoJerarquiaActions {

  protected function processForm(sfWebRequest $request, sfForm $form) {
    $heirarchy_parameters = $request->getParameter($form->getName());
    $form->bind($heirarchy_parameters, $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $points = $heirarchy_parameters['points'];
        $points = str_replace('.', '', $points);
        $points = str_replace(',', '.', $points);
        $this->form->setValidator('points', new sfValidatorString(array()));
        $heirarchy_parameters['points'] = $points;
        $this->form->bind($heirarchy_parameters);
        if ($form->isValid()) {
          $jerarquia = $form->save();
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $jerarquia)));

      if ($request->hasParameter('_save_and_add')) {
        $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

        $this->redirect('@jerarquia_new');
      } else {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'jerarquia', 'sf_subject' => $jerarquia));
      }
    } else {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  public function executeEdit(sfWebRequest $request) {
    $this->jerarquia = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->jerarquia);
    $points = $this->getUser()->getMoneyInFormat($this->jerarquia->getPoints());
    $this->form->setDefault('points', $points);
  }

}
