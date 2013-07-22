<?php

/**
 * metodo_banco actions.
 *
 * @package    symfony
 * @subpackage metodo_banco
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class metodo_bancoActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->metodo_bancos = Doctrine_Core::getTable('MetodoBanco')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->guardado = '';
        $this->form = new MetodoBancoForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->guardado = '';

        $this->form = new MetodoBancoForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        if ($metodo_banco = Doctrine_Core::getTable('MetodoBanco')->createQuery()->where('user_id=?', $request->getParameter('id'))->fetchOne()) {
            $this->form = new MetodoBancoForm($metodo_banco);
            $this->guardado = 'true';
        } else {
            $this->guardado = '';
            $this->form = new MetodoBancoForm();
        }
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($metodo_banco = Doctrine_Core::getTable('MetodoBanco')->find(array($request->getParameter('id'))), sprintf('Object metodo_banco does not exist (%s).', $request->getParameter('id')));
        $this->form = new MetodoBancoForm($metodo_banco);
        $this->processForm($request, $this->form);
        $this->guardado = 'true';

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($metodo_banco = Doctrine_Core::getTable('MetodoBanco')->find(array($request->getParameter('id'))), sprintf('Object metodo_banco does not exist (%s).', $request->getParameter('id')));
        $metodo_banco->delete();

        $this->redirect('metodo_banco/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {

        $this->guardado = '';
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $asValues = $request->getParameter($this->form->getName());
        if ($form->isValid()) {
            //$metodo_banco = $form->save();
            $values = $form->getValues();
            if (!$metodo = Doctrine_Core::getTable('MetodoBanco')->createQuery()->where('user_id=?', $this->getUser()->getGuardUser()->getId())->fetchOne())
                $metodo = new MetodoBanco();
            $metodo->fromArray($values);
            $metodo->setUserId($this->getUser()->getGuardUser()->getId());
            $metodo->save();
            $this->guardado = 'true';
            //$this->redirect('metodo_banco/edit?id='.$metodo->getId());
        }
    }

}
