<?php

/**
 * comunidadprivadacomenta actions.
 *
 * @package    auditoscopia
 * @subpackage comunidadprivadacomenta
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class comunidadprivadacomentaActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  }
  
  public function executeNew(sfWebRequest $request)
    {
       $this->form = new ContribucionCpForm();
 
    }

    public function executeCreate(sfWebRequest $request)
    {   
       $this->concursocpid=$request->getParameter("concurso_cp_id");
    
       $this->forward404Unless($request->isMethod('post'));

       $this->form = new ContribucionCpForm();

       $this->processForm($request, $this->form);

       $this->setTemplate('new');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
       $form->bind($request->getParameter($form->getName()));
       if ($form->isValid()){
           $idcomunidad = $form->save();
           $this->redirect('comunidadprivadacomenta/confirm?id='.$idcomunidad->id);
       }
    }
     public function executeConfirm(sfWebRequest $request)
    {
         
    }
}
