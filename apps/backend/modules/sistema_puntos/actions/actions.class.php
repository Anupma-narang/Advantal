<?php

/**
 * sistema_puntos actions.
 *
 * @package    symfony
 * @subpackage sistema_puntos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sistema_puntosActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
	
	public function executeAsignar(sfWebRequest $request)
	{
		$this->forward404Unless($this->user_id = $request->getParameter('user_id'));		
		$this->forward404Unless($this->concurso_id = $request->getParameter('concurso_id'));
		
		if(Doctrine::getTable('LogPuntos')->createQuery()->where('user_id=?',$this->user_id)->andWhere('concurso_id=?',$this->concurso_id)->fetchOne()){
			$this->setTemplate('dopuntos');
			$this->msg = 'Información:';
		}
		
		$this->puntos = Doctrine::getTable('TablaPuntos')->createQuery()->where('is_automatico=false')->andWhere('is_positivo=true')->execute();
		$this->is_positivo=1;
	}
	
	public function executeSancionar(sfWebRequest $request)
	{
		$this->forward404Unless($this->user_id = $request->getParameter('user_id'));	
		$this->forward404Unless($this->concurso_id = $request->getParameter('concurso_id'));
		
		if(Doctrine::getTable('LogPuntos')->createQuery()->where('user_id=?',$this->user_id)->andWhere('concurso_id=?',$this->concurso_id)->fetchOne()){
			$this->setTemplate('dopuntos');
			$this->msg = 'Información:';
		}		
		
		$this->puntos = Doctrine::getTable('TablaPuntos')->createQuery()->where('is_automatico=false')->andWhere('is_positivo=false')->execute();
		$this->is_positivo=0;
		$this->setTemplate('asignar');
	}

	public function executeDopuntos(sfWebRequest $request)
	{
		$this->forward404Unless($user = Doctrine::getTable('sfGuardUser')->findOneBy('id', $request->getParameter('user_id')));
		$this->forward404Unless($concurso_id = $request->getParameter('concurso_id'));
		
		$argumentos = $request->getPostParameters();
		foreach($argumentos as $a){
			$puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo($a);
//			if($request->getParameter('is_positivo')==1){
				$user->getProfile()->setPuntos($puntos);
//				ColaboradorPuntosHistoricoTable::new_log($user->getId(),$a,$puntos,array('concurso_id' => $concurso_id));
//			}
//			else{
//				$user->getProfile()->setPuntos(-($puntos));
//				ColaboradorPuntosHistoricoTable::new_log($user->getId(),$a,-($puntos),array('concurso_id' => $concurso_id));
//			}
		}
		$this->msg = 'OK';		
	}
}
