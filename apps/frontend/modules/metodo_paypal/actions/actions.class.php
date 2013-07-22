<?php

/**
 * metodo_paypal actions.
 *
 * @package    symfony
 * @subpackage metodo_paypal
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class metodo_paypalActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->metodo_paypals = Doctrine_Core::getTable('MetodoPaypal')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->guardado = '';
        $this->form = new metodo_paypalForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->guardado = '';
        $this->form = new MetodoPaypalForm();
        $this->processForm($request, $this->form);
        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        if ($metodo_paypal = Doctrine_Core::getTable('MetodoPaypal')->createQuery()->where('user_id=?', $request->getParameter('id'))->fetchOne()) {
            $this->form = new MetodoPaypalForm($metodo_paypal);
            $this->guardado = 'true';
        } else {
            $this->guardado = '';
            $this->form = new MetodoPaypalForm();
        }
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $metodo_paypal = Doctrine_Core::getTable('MetodoPaypal')->find(array($request->getParameter('id')));
        $this->forward404Unless($metodo_paypal, 'Object metodo_paypal does not exist,');

        $this->form = new MetodoPaypalForm($metodo_paypal);
        $this->processForm($request, $this->form);
        $this->guardado = 'true';

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($metodo_paypal = Doctrine_Core::getTable('MetodoPaypal')->find(array($request->getParameter('id'))), sprintf('Object metodo_paypal does not exist (%s).', $request->getParameter('id')));
        $metodo_paypal->delete();

        $this->redirect('metodo_paypal/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            //$metodo_paypal = $form->save();
            $values = $form->getValues();
            if (!$metodo = Doctrine_Core::getTable('MetodoPaypal')->createQuery()->where('user_id=?', $this->getUser()->getGuardUser()->getId())->fetchOne())
                $metodo = new MetodoPaypal();
            $metodo->fromArray($values);
            $metodo->setUserId($this->getUser()->getGuardUser()->getId());
            $metodo->save();
            $this->guardado = 'true';
            //$this->redirect('metodo_paypal/edit?id='.$metodo_paypal->getId());
        }
    }

}
