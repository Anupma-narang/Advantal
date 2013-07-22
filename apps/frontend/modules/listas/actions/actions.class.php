<?php

/**
 * listas actions.
 *
 * @package    auditoscopia
 * @subpackage listas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class listasActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeVerpd(sfWebRequest $request) {
        $this->pdvar = Doctrine::getTable("Pd")->findOneById($request->getParameter("pd_id"));
  }
  public function executeConfirm(sfWebRequest $request){
      
  }
    public function executeIndex(sfWebRequest $request){
         
  }
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PdCartaForm();
  }
     
  public function executeCreate(sfWebRequest $request)
    {       
       $this->forward404Unless($request->isMethod('post'));

       $this->form = new PdCartaForm();

       $this->processForm($request, $this->form);

       $this->setTemplate('new');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
       $form->bind($request->getParameter($form->getName()));
       if ($form->isValid()){
           $pd = $form->save();
           $this->redirect('listas/confirm?id='.$pd->id);
       }
    }
}