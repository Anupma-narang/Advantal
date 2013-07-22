<?php

/**
 * User table.
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage model
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: PluginsfGuardUserTable.class.php 25546 2009-12-17 23:27:55Z Jonathan.Wage $
 */
abstract class PluginsfGuardUserTable extends Doctrine_Table
{
  /**
   * Retrieves a sfGuardUser object by username and is_active flag.
   *
   * @param  string  $username The username
   * @param  boolean $isActive The user's status
   *
   * @return sfGuardUser
   */
  public function retrieveByUsername($username, $isActive = true)
  {
    $query = Doctrine_Core::getTable('sfGuardUser')->createQuery('u')
      ->where('u.username = ?', $username)
      ->addWhere('u.is_active = ?', $isActive)
    ;

    return $query->fetchOne();
  }
  
  public function findByUsername($name, $limit=10)
  {
  	return Doctrine_Core::getTable('sfGuardUser')
  	->createQuery('u')
  	->where("u.username LIKE '%{$name}%'")
  	->limit($limit)
  	->execute();
  }  

  /**
   * Retrieves a sfGuardUser object by username or email_address and is_active flag.
   *
   * @param  string  $username The username
   * @param  boolean $isActive The user's status
   *
   * @return sfGuardUser
   */
  public function retrieveByUsernameOrEmailAddress($username, $isActive = true)
  {
    $query = Doctrine_Core::getTable('sfGuardUser')->createQuery('u')
      ->where('u.username = ? OR u.email_address = ?', array($username, $username))
      ->addWhere('u.is_active = ?', $isActive)
    ;

    return $query->fetchOne();
  }
  
  public function retrieveByEmailAddress($username, $isActive = true)
  {
  	$query = Doctrine_Core::getTable('sfGuardUser')->createQuery('u')
  	->where('u.email_address = ?', array($username))
  	->addWhere('u.is_active = ?', $isActive)
  	;
  
  	return $query->fetchOne();
  }  
}
