<?php

/**
 * User model.
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage model
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: PluginsfGuardUser.class.php 25605 2009-12-18 18:55:55Z Jonathan.Wage $
 */
abstract class PluginsfGuardUser extends BasesfGuardUser
{
  protected
    $_groups         = null,
    $_permissions    = null,
    $_allPermissions = null;

  /**
   * Returns the string representation of the object: "Full Name (username)"
   *
   * @return string
   */
  public function __toString()
  {
    return (string) $this->getUserName();
  }

  public function setDisabled($val)
  {
  	parent::setIsDisabled($val);
  	if($val)
  		parent::setIsActive(false);
  	else
  		parent::setIsActive(true);
  }

  public function getProfile()
  {
  	if(!Doctrine::getTable('sfGuardUserProfile')->findOneBy('user_id', $this->getId())){
  		$p = new sfGuardUserProfile();
  		$p->setUserId($this->getId());
  		$p->setStatesId(1);
  		$p->save();

  		return $p;
  	}
  	else
  		return Doctrine::getTable('sfGuardUserProfile')->findOneBy('user_id', $this->getId());
  }


  public function getName()
  {
  	return $this->getProfile()->getName();
  }

  public function getApellido1()
  {
  	return $this->getProfile()->getSurname1();
  }

  public function getRealPassword()
  {
  	return $this->getPassword();
  }

  /**
   * Sets the user password.
   *
   * @param string $password
   */
  public function setPassword($password)
  {
    if (!$password && 0 == strlen($password))
    {
      return;
    }

    if (!$salt = $this->getSalt())
    {
      $salt = md5(rand(100000, 999999).$this->getUsername());
      $this->setSalt($salt);
    }
    $modified = $this->getModified();
    if ((!$algorithm = $this->getAlgorithm()) || (isset($modified['algorithm']) && $modified['algorithm'] == $this->getTable()->getDefaultValueOf('algorithm')))
    {
      $algorithm = sfConfig::get('app_sf_guard_plugin_algorithm_callable', 'sha1');
    }
    $algorithmAsStr = is_array($algorithm) ? $algorithm[0].'::'.$algorithm[1] : $algorithm;
    if (!is_callable($algorithm))
    {
      throw new sfException(sprintf('The algorithm callable "%s" is not callable.', $algorithmAsStr));
    }
    $this->setAlgorithm($algorithmAsStr);

    $this->_set('password', call_user_func_array($algorithm, array($salt.$password)));
  }

  /**
   * Returns whether or not the given password is valid.
   *
   * @param string $password
   * @return boolean
   */
  public function checkPassword($password)
  {
    if ($callable = sfConfig::get('app_sf_guard_plugin_check_password_callable'))
    {
      return call_user_func_array($callable, array($this->getUsername(), $password, $this));
    }
    else
    {
      return $this->checkPasswordByGuard($password);
    }
  }

  /**
   * Returns whether or not the given password is valid.
   *
   * @param string $password
   * @return boolean
   * @throws sfException
   */
  public function checkPasswordByGuard($password)
  {
    $algorithm = $this->getAlgorithm();
    if (false !== $pos = strpos($algorithm, '::'))
    {
      $algorithm = array(substr($algorithm, 0, $pos), substr($algorithm, $pos + 2));
    }
    if (!is_callable($algorithm))
    {
      throw new sfException(sprintf('The algorithm callable "%s" is not callable.', $algorithm));
    }

    return $this->getPassword() == call_user_func_array($algorithm, array($this->getSalt().$password));
  }

  /**
   * Adds the user a new group from its name.
   *
   * @param string $name The group name
   * @param Doctrine_Connection $con A Doctrine_Connection object
   * @throws sfException
   */
  public function addGroupByName($name, $con = null)
  {
    $group = Doctrine_Core::getTable('sfGuardGroup')->findOneByName($name);
    if (!$group)
    {
      throw new sfException(sprintf('The group "%s" does not exist.', $name));
    }

    $ug = new sfGuardUserGroup();
    $ug->setUser($this);
    $ug->setGroup($group);

    $ug->save($con);
  }

  /**
   * Adds the user a permission from its name.
   *
   * @param string $name The permission name
   * @param Doctrine_Connection $con A Doctrine_Connection object
   * @throws sfException
   */
  public function addPermissionByName($name, $con = null)
  {
    $permission = Doctrine_Core::getTable('sfGuardPermission')->findOneByName($name);
    if (!$permission)
    {
      throw new sfException(sprintf('The permission "%s" does not exist.', $name));
    }

    $up = new sfGuardUserPermission();
    $up->setUser($this);
    $up->setPermission($permission);

    $up->save($con);
  }

  /**
   * Checks whether or not the user belongs to the given group.
   *
   * @param string $name The group name
   * @return boolean
   */
  public function hasGroup($name)
  {
    $this->loadGroupsAndPermissions();
    return isset($this->_groups[$name]);
  }

  /**
   * Returns all related groups names.
   *
   * @return array
   */
  public function getGroupNames()
  {
    $this->loadGroupsAndPermissions();
    return array_keys($this->_groups);
  }

  /**
   * Returns whether or not the user has the given permission.
   *
   * @return boolean
   */
  public function hasPermission($name)
  {
    $this->loadGroupsAndPermissions();
    return isset($this->_allPermissions[$name]);
  }

  /**
   * Returns an array of all user's permissions names.
   *
   * @return array
   */
  public function getPermissionNames()
  {
    $this->loadGroupsAndPermissions();
    return array_keys($this->_allPermissions);
  }

  /**
   * Returns an array containing all permissions, including groups permissions
   * and single permissions.
   *
   * @return array
   */
  public function getAllPermissions()
  {
    if (!$this->_allPermissions)
    {
      $this->_allPermissions = array();
      $permissions = $this->getPermissions();
      foreach ($permissions as $permission)
      {
        $this->_allPermissions[$permission->getName()] = $permission;
      }

      foreach ($this->getGroups() as $group)
      {
        foreach ($group->getPermissions() as $permission)
        {
          $this->_allPermissions[$permission->getName()] = $permission;
        }
      }
    }

    return $this->_allPermissions;
  }

  /**
   * Returns an array of all permission names.
   *
   * @return array
   */
  public function getAllPermissionNames()
  {
    return array_keys($this->getAllPermissions());
  }

  /**
   * Loads the user's groups and permissions.
   *
   */
  public function loadGroupsAndPermissions()
  {
    $this->getAllPermissions();

    if (!$this->_permissions)
    {
      $permissions = $this->getPermissions();
      foreach ($permissions as $permission)
      {
        $this->_permissions[$permission->getName()] = $permission;
      }
    }

    if (!$this->_groups)
    {
      $groups = $this->getGroups();
      foreach ($groups as $group)
      {
        $this->_groups[$group->getName()] = $group;
      }
    }
  }

  /**
   * Reloads the user's groups and permissions.
   */
  public function reloadGroupsAndPermissions()
  {
    $this->_groups         = null;
    $this->_permissions    = null;
    $this->_allPermissions = null;
  }

  /**
   * Sets the password hash.
   *
   * @param string $v
   */
  public function setPasswordHash($v)
  {
    if (!is_null($v) && !is_string($v))
    {
      $v = (string) $v;
    }

    if ($this->password !== $v)
    {
      $this->_set('password', $v);
    }
  }

  protected function getPartial($templateName, $vars = null)
  {
  	sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');

  	$vars = null !== $vars ? $vars : $this->varHolder->getAll();

  	return get_partial($templateName, $vars);
  }


  protected function mail($options)
  {
  	$required = array('subject', 'parameters', 'email', 'fullname', 'html', 'text');
  	foreach ($required as $option)
  	{
  		if (!isset($options[$option]))
  		{
  			throw new sfException("Required option $option not supplied to sfApply::mail");
  		}
  	}
  	//NOTE: Nuevo sistema de mailing
/*  	print_r($options['parameters']);*/

  	$message = Swift_Message::newInstance()
  	->setSubject($options['subject'])
  	->setFrom(array(sfConfig::get('app_default_mailfrom','noreply@localhost') => 'Auditoscopia'))
  	->setTo(array($options['email'] => $options['fullname']))
  	->setBody($this->getPartial($options['text'], $options['parameters']), 'text/plain')
  	->addPart($this->getPartial($options['html'], $options['parameters']), 'text/html');

        try {
            sfContext::getInstance()->getMailer()->send($message);
        } catch (Exception $e) {

        }
  }

  private function getNotificaciones()
  {
  	return Doctrine::getTable('UserNotification')->findOneBy('user_id', $this->getId());
  }

  /**
   * Envia una notificación al usuario, si está configurado así, informando que se crea una contribución en su concurso
   *
   * @param contribucion &$contribucion
   */
  public function sendNotification_NewContribucionConcurso(&$contribucion)
  {
  	if($notificaciones = $this->getNotificaciones())
  	{
  		if($notificaciones->getColaboradorContribuyeValue())
  		{
  			if($contribucion->getConcurso()->getConcursoTipoId()==1){			//empresa
  				$this->mail(array(
  					'subject' => 'Notificación de Auditoscopia',
  					'fullname' => $this->getProfile()->getFullname(),
  					'email' => $this->getEmailAddress(),
  					'parameters' => array(
  							'hash' => $notificaciones->getHash(),
								'alias' 			=> 	$this->getUserName(),
  							'created_at'		=>	$contribucion->Concurso->getCreatedAt(),
  							'concurso_titulo' 	=> 	$contribucion->Concurso->getName(),
  							'concurso_categoria'=>	$contribucion->Concurso->getConcursoCategoria()->getName(),
  							'nombre_empresa' 	=> 	$contribucion->Concurso->getEmpresa()->getName(),
  							'ciudadyprovincia'	=>  $contribucion->Concurso->getCityandState(),
  							'contribucion_id'	=>	$contribucion->getId(),
  							'concurso_id'		=>	$contribucion->Concurso->getId(),
								'empresa_slug'	=> $contribucion->Concurso->getEmpresa()->getSlug(),
								'slug' => $contribucion->Concurso->getSlug(),
								'date' => $contribucion->Concurso->getDateTimeObject('created_at')->format('d-m-Y'),
								'time' => $contribucion->Concurso->getDateTimeObject('created_at')->format('H:i'),
								'number' => 1
  					),
  					'text' => 'notifications/newcontribucionconcursoempresaText',
  					'html' => 'notifications/newcontribucionconcursoempresa'));
  			}
  			else if($contribucion->getConcurso()->getConcursoTipoId()==2){			//producto
  				$this->mail(array(
  						'subject' => 'Notificación de Auditoscopia',
  						'fullname' => $this->getProfile()->getFullname(),
  						'email' => $this->getEmailAddress(),
  						'parameters' => array(
  								'hash' => $notificaciones->getHash(),
									'alias' 			=> 	$this->getUserName(),
  								'created_at'		=>	$contribucion->Concurso->getCreatedAt(),
  								'concurso_titulo' 	=> 	$contribucion->Concurso->getName(),
  								'concurso_categoria'=>	$contribucion->Concurso->getConcursoCategoria()->getName(),
  								'nombre_producto' 	=> 	$contribucion->Concurso->getProducto()->getName(),
  								'marca_producto'	=>  $contribucion->Concurso->getProducto()->getMarca(),
  								'contribucion_id'	=>	$contribucion->getId(),
  								'concurso_id'		=>	$contribucion->Concurso->getId(),
									'producto_slug'	=> $contribucion->Concurso->getProducto()->getSlug(),
									'slug' => $contribucion->Concurso->getSlug(),
									'date' => $contribucion->Concurso->getDateTimeObject('created_at')->format('d-m-Y'),
									'time' => $contribucion->Concurso->getDateTimeObject('created_at')->format('H:i'),
									'number' => 1
  						),
  						'text' => 'notifications/newcontribucionconcursoproductoText',
  						'html' => 'notifications/newcontribucionconcursoproducto'));
  			}
  		}
  	}
  }


  /**
   * Envia una notificacion al usuario, sin checkear, que se crea un concurso de empresa según su conf.
   *
   * @param concurso $concurso
   */
  public function sendNotification_NewConcursoEmpresa(&$concurso)
  {
		if($notificaciones = $this->getNotificaciones())
  	{
			if($notificaciones->getConcursoEmpresaValue())
  		{
				$this->mail(array(
						'subject' 	=> 'Notificación de Auditoscopia',
						'fullname' 	=> $this->getProfile()->getFullname(),
						'email' 	=> $this->getEmailAddress(),
						'parameters' => array(
								'hash' => $notificaciones->getHash(),
								'alias' 			=> 	$this->getUserName(),
								'created_at'		=>	$concurso->getCreatedAt(),
								'concurso_titulo' 	=> 	$concurso->getName(),
								'concurso_categoria'=>	$concurso->getConcursoCategoria()->getName(),
								'nombre_empresa' 	=> 	$concurso->getEmpresa()->getName(),
								'ciudadyprovincia'	=>  $concurso->getCityandState(),
								/*'provincia'			=>  $concurso->getStates()->getName(),
								'ciudad'			=>	$concurso->getCity()->getName(),*/
						),
						'text' => 'notifications/newconcursoempresaText',
						'html' => 'notifications/newconcursoempresa'));
			}
		}
  }
  
  /**
   * Envia una notificacion al usuario, sin checkear, que se crea un concurso de producto según su conf.
   *
   * @param unknown_type $concurso
   */
  public function sendNotification_NewConcursoProducto(&$concurso)
  {
		if($notificaciones = $this->getNotificaciones())
  	{
			if($notificaciones->getConcursoProductoValue())
  		{
				$this->mail(array(
						'subject' => 'Notificación de Auditoscopia',
						'fullname' => $this->getProfile()->getFullname(),
						'email' => $this->getEmailAddress(),
						'parameters' => array(
								'hash' => $notificaciones->getHash(),
								'alias' 			=> 	$this->getUserName(),
								'created_at'		=>	$concurso->getCreatedAt(),
								'concurso_titulo' 	=> 	$concurso->getName(),
								'concurso_categoria'=>	$concurso->getConcursoCategoria()->getName(),
								'nombre_producto' 	=> 	$concurso->getProducto()->getName(),
								'marca_producto'	=>  $concurso->getProducto()->getMarca(),
						),
						'text' => 'notifications/newconcursoproductoText',
						'html' => 'notifications/newconcursoproducto'));
			}
		}
  }

  /**
   *
   * @param integer $cambio_a_estado  {1 = 3 días para pasar de activo a referédum}
   * @param concurso $concurso
   *
   *
   */
  public function sendNotification_ConcursoCambioEstado($cambio_a_estado, &$concurso)
  {
  	switch ($cambio_a_estado){
  		case 1:
  			if($concurso->getConcursoTipoId()==1)		//empresa
  				$this->mail(array(
  				'subject' => 'Notificación de Auditoscopia',
  				'fullname' => $this->getProfile()->getFullname(),
  				'email' => $this->getEmailAddress(),
  				'parameters' => array(
  				'alias' => $this->getUserName(),
  				'concurso_titulo' => $concurso->getName(),
  				'concurso_empresa_nombre' => $concurso->getEmpresa()->getName(),
  				/*'concurso_empresa_provincia' => $concurso->getStates()->getName(),
  				'concurso_empresa_ciudad' => $concurso->getCity()->getName(),*/
					'concurso_ciudadyprovincia'	=>  $concurso->getCityandState(),
  				'concurso_categoria' => $concurso->getConcursoCategoria()->getName()),
  				'text' => 'notifications/concursoEmpresaToReferendum3diasText',
  				'html' => 'notifications/concursoEmpresaToReferendum3dias'));
  			elseif($concurso->getConcursoTipoId()==2)  		//producto
  				$this->mail(array(
  					'subject' => 'Notificación de Auditoscopia',
  					'fullname' => $this->getProfile()->getFullname(),
  					'email' => $this->getEmailAddress(),
  					'parameters' => array(
  							'alias' => $this->getUserName(),
  							'concurso_titulo' => $concurso->getName(),
  							'concurso_producto_nombre' => $concurso->getProducto()->getName(),
  							'concurso_producto_marca' => $concurso->getProducto()->getMarca(),
  							'concurso_categoria' => $concurso->getConcursoCategoria()->getName()),
  					'text' => 'notifications/concursoProductoToReferendum3diasText',
  					'html' => 'notifications/concursoProductoToReferendum3dias'));
  			break;
  		case 2:
  			if($concurso->getConcursoTipoId()==1)		//empresa
  				$this->mail(array(
  				'subject' => 'Notificación de Auditoscopia',
  				'fullname' => $this->getProfile()->getFullname(),
  				'email' => $this->getEmailAddress(),
  				'parameters' => array(
  				'alias' => $this->getUserName(),
  				'concurso_titulo' => $concurso->getName(),
  				'concurso_empresa_nombre' => $concurso->getEmpresa()->getName(),
  				/*'concurso_empresa_provincia' => $concurso->getStates()->getName(),
  				'concurso_empresa_ciudad' => $concurso->getCity()->getName(),*/
					'concurso_ciudadyprovincia'	=>  $concurso->getCityandState(),
  				'concurso_categoria' => $concurso->getConcursoCategoria()->getName()),
  				'text' => 'notifications/concursoEmpresaToReferendum2diasText',
  				'html' => 'notifications/concursoEmpresaToReferendum2dias'));
  			elseif($concurso->getConcursoTipoId()==2)  		//producto
  				$this->mail(array(
  					'subject' => 'Notificación de Auditoscopia',
  					'fullname' => $this->getProfile()->getFullname(),
  					'email' => $this->getEmailAddress(),
  					'parameters' => array(
  							'alias' => $this->getUserName(),
  							'concurso_titulo' => $concurso->getName(),
  							'concurso_producto_nombre' => $concurso->getProducto()->getName(),
  							'concurso_producto_marca' => $concurso->getProducto()->getMarca(),
  							'concurso_categoria' => $concurso->getConcursoCategoria()->getName()),
  					'text' => 'notifications/concursoProductoToReferendum2diasText',
  					'html' => 'notifications/concursoProductoToReferendum2dias'));
  			break;
  	}

  }

  public function getPuntosganadosPorConcurso($puesto)
  {
  	switch($puesto){
  		case 1:
  			return ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('user_ganador_concurso');
  		case 2:
  			return ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('user_segu_concurso');
  		case 3:
  			return ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('user_terc_concurso');
  		default:
  			return 0;
  	}
  }
}
