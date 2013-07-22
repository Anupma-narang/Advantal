<?php

require_once dirname(__FILE__) . '/../lib/colaboradores_alertasGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/colaboradores_alertasGeneratorHelper.class.php';

/**
 * alertas actions.
 *
 * @package    symfony
 * @subpackage alertas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class colaboradores_alertasActions extends autoColaboradores_alertasActions {

    protected function buildQuery() {
        $query = parent::buildQuery();

        $query->andWhere('(entity=2 OR entity=500)');

        $request = sfContext::getInstance()->getRequest();

        if(! $request->hasParameter('sort') && ! $request->hasParameter('sort_type'))
        {
          $query->orderBy('created_at DESC');
        }

       // echo $query->getSqlQuery();exit;
        
        return $query;
    }

    public function executeShow(sfWebRequest $request) {
        $this->alerta = $this->getRoute()->getObject();
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $entity = '';
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if (!$form->getObject()->isNew()) {
            $entity = $form->getObject()->getEntity();
        } else {
            $entity = '2';
        }
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $alertas = $form->save();
                $alertas->setEntity($entity);
                $alertas->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $alertas)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@colaboradores_alertas_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'colaboradores_alertas'));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

}
