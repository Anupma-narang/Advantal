<?php

/**
 * listas actions.
 *
 * @package    auditoscopia
 * @subpackage listas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class buenprofesionalActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeConfirm(sfWebRequest $request){
      
  }
  public function executeIndex(sfWebRequest $request){
         
  }
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PdForm();
  }
     
  public function executeCreate(sfWebRequest $request)
    {       
       $this->forward404Unless($request->isMethod('post'));

       $this->form = new PdForm();

       $this->processForm($request, $this->form);

       $this->setTemplate('new');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
       $form->bind($request->getParameter($form->getName()));
       if ($form->isValid()){
           $pd = $form->save();
           $this->redirect('listas/new?id='.$pd->id);
       }
    }
}