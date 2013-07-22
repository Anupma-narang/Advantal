<?php

/**
 * contribucion module configuration.
 *
 * @package    auditoscopia
 * @subpackage contribucion
 * @author     Your name here
 * @version    SVN: $Id: configuration.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contribucionGeneratorConfiguration extends BaseContribucionGeneratorConfiguration
{
	public function getFormClass()
	{
		return 'ContribucionBackendForm';
	}
}
