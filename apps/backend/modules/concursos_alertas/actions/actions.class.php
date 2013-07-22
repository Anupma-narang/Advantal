<?php

require_once dirname(__FILE__).'/../lib/concursos_alertasGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/concursos_alertasGeneratorHelper.class.php';

/**
 * alertas actions.
 *
 * @package    symfony
 * @subpackage alertas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class concursos_alertasActions extends autoConcursos_alertasActions
{
  protected function buildQuery()
	{
		$query = parent::buildQuery();
		
		$query->andWhere('entity=1');
		
		return $query;
	}
  
  public function executeShow(sfWebRequest $request)
	{
		$this->alerta = $this->getRoute()->getObject();
	}
}
