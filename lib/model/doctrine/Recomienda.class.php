<?php

/**
 * Recomienda
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Recomienda extends BaseRecomienda
{

  /**
   * insert the recomended record into db with given email and user id
   * @param String $email Email
   * @param string $user_id User Id
   */
  public function create($email, $user_id){
    //set attributes
    $this->setEmail($email);
    $this->setUserId($user_id);
    $this->setCreatedAt(date('Y-m-d H:i:s'));
    //insert into db
    $this->save();
  }
}