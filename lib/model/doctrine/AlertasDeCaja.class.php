<?php

/**
 * AlertasDeCaja
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class AlertasDeCaja extends BaseAlertasDeCaja
{

    /**
     * create alertas de caja record from given User Id and Money
     * @param String $user_id User Id
     * @param String $money  Money
     */
    public function create($user_id, $money){
        // set attributes
        $this->setUserId($user_id);
        $this->setAmount($money);
        $this->setCreatedAt(date('Y-m-d H:i:s'));
        // insert record into db
        $this->save();
    }
}