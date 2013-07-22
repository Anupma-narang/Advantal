<?php

require_once dirname(__FILE__).'/../lib/concursos_alarmasGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/concursos_alarmasGeneratorHelper.class.php';

/**
 * concursos_alarmas actions.
 *
 * @package    symfony
 * @subpackage concursos_alarmas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class concursos_alarmasActions extends autoConcursos_alarmasActions
{
	protected function buildQuery()
	{
		$query = parent::buildQuery();
	
		//Personalización de la Query
		$query->addWhere('type like "Nueva Empresa" or type like "Nuevo Producto"');
    
    $request = sfContext::getInstance()->getRequest();

    if(! $request->hasParameter('sort') && ! $request->hasParameter('sort_type'))
    {
      $query->orderBy('created_at DESC');
    }
    
		return $query;
	}	
}
