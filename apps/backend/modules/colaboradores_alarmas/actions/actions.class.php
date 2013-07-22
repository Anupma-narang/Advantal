<?php

require_once dirname(__FILE__).'/../lib/colaboradores_alarmasGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/colaboradores_alarmasGeneratorHelper.class.php';

/**
 * colaboradores_alarmas actions.
 *
 * @package    symfony
 * @subpackage colaboradores_alarmas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class colaboradores_alarmasActions extends autoColaboradores_alarmasActions
{
	protected function buildQuery()
	{
		$query = parent::buildQuery();
	
		// Personalización de la Query
		$query->addWhere('type like "Colaboradores"');

    $query->orderBy('created_at DESC');

    // echo $query->getSqlQuery();exit;
	
		return $query;
	}	
}
