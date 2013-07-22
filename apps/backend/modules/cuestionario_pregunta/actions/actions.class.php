<?php

require_once dirname(__FILE__) . '/../lib/cuestionario_preguntaGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/cuestionario_preguntaGeneratorHelper.class.php';

/**
 * cuestionario_pregunta actions.
 *
 * @package    symfony
 * @subpackage cuestionario_pregunta
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cuestionario_preguntaActions extends autoCuestionario_preguntaActions {

    public function executeShow(sfWebRequest $request) {
        $this->pregunta = $this->getRoute()->getObject();
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $cuestionario_pregunta = $form->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $cuestionario_pregunta)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@cuestionario_pregunta_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'cuestionario_pregunta'));
            }
        } else {
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

      $this->filters->setTableMethod($tableMethod);

      $query = $this->filters->buildQuery($this->getFilters());
      
      $this->addSortQuery($query);
      
      $request = sfContext::getInstance()->getRequest();

      if(! $request->hasParameter('sort') && ! $request->hasParameter('sort_type'))
      {
        $query->orderBy('created_at DESC');
      }
      

      $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
      $query = $event->getReturnValue();

      return $query;
    }

}
