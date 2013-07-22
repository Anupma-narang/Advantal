<?php

/**
 * contribucion module configuration.
 *
 * @package    auditoscopia
 * @subpackage contribucion
 * @author     Your name here
 * @version    SVN: $Id: configuration.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contribuciones_destacadasGeneratorConfiguration extends BaseContribuciones_destacadasGeneratorConfiguration
{
	public function getFormClass()
	{
		return 'ContribucionBackendForm';
	}
}
