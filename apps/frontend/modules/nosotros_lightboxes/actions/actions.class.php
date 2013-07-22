<?php

/**
 * nosotros_lightboxes actions.
 *
 * @package    symfony
 * @subpackage nosotros_lightboxes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class nosotros_lightboxesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeAccesocuenta(sfWebRequest $request)
  {
        $this->texto = $request->getParameter("texto");
        if (!$this->texto ){
            $this->texto = 'Para entrar en tu cuenta <strong>necesitas ser colaborador</strong>';
        }else if($this->texto == 1){
            $this->texto = 'Para <strong>auditarnos</strong> necesitas ser colaborador';
        }else if($this->texto == 2){
          $this->texto = 'Para <strong>dar de alta un profesional</strong> necesitas ser colaborador';
        }else if($this->texto == 3){
          $this->texto = 'Para <strong>recomendar a un profesional</strong> necesitas ser colaborador';
        }else if($this->texto == 4){
          $this->texto = 'Para <strong>desaprobar a un profesional</strong> necesitas ser colaborador';
        }
  }
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeSerinformado(sfWebRequest $request)
  {
  }
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executePorquecrearcuenta(sfWebRequest $request)
  {
  }
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeConsejoscrearcuenta(sfWebRequest $request)
  {
  }
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeConsejoscontrasena(sfWebRequest $request)
  {
  }
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeFasesconcurso(sfWebRequest $request)
  {
  }
}
