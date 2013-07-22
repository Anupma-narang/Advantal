<?php

/**
 * comofunciona actions.
 *
 * @package    auditoscopia
 * @subpackage comofunciona
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contactoForm extends sfForm{
    protected static $elegir = array("Elige 1","Elige 2","Elige 3");
    public function configure() {
       $this->setWidgets(array(
           "elige" => new sfWidgetFormSelect(array("choices" => self::$elegir  )),
       ));
        }   
}
class comofuncionaActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
      $this -> formulario = new contactoForm();
  }
   public function executeDirectorio(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }
   public function executeMesaredonda(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }
   public function executeReferendumconcurso(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }
   public function executeReferendummesaredonda(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }
  
}
