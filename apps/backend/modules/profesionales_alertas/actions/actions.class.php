<?php

require_once dirname(__FILE__).'/../lib/profesionales_alertasGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/profesionales_alertasGeneratorHelper.class.php';

/**
 * profesionales_alertas actions.
 *
 * @package    symfony
 * @subpackage profesionales_alertas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profesionales_alertasActions extends autoProfesionales_alertasActions
{
    protected function buildQuery()
	{
		$query = parent::buildQuery();
		
		$query->andWhere('entity = 3 OR entity = 5 OR entity = 6');
    $request = sfContext::getInstance()->getRequest();

    if(! $request->hasParameter('sort') && ! $request->hasParameter('sort_type'))
    {
      $query->orderBy('created_at DESC');
    }
    
		
		return $query;
	}
  
    public function executeShow(sfWebRequest $request)
	{
		$this->alerta = $this->getRoute()->getObject();
	}
}
