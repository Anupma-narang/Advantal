<?php

/**
 * comunidadprivadareferendum actions.
 *
 * @package    auditoscopia
 * @subpackage comunidadprivadareferendum
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class comunidadprivadareferendumActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }
  
      public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod('post'));
        $this->form = new ConcursoReferendumCpForm(array(),array('contribucion'=>$request->getParameter("contribucioncp")));
        $this->processForm($request, $this->form);
        $this->setTemplate('new');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()));
        if ($form->isValid()) {
            $votos = $form->save();
            $this->redirect('comunidadprivada/index?id=' . $votos->id);
        }
    }
}
