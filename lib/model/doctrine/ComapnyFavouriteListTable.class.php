<?php

/**
 * ComapnyFavouriteListTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ComapnyFavouriteListTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ComapnyFavouriteListTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ComapnyFavouriteList');
    }
    
    /**
     * fetch favourit company record
     * @param String $user_id User Id
     * @param String $compnay_id Company Id
     * @return Record
     */
    public function getRecordByUserAndId($user_id, $compnay_id){
      //create favourit query
      $favourit_query = Doctrine_Query::create()
                        ->from('ComapnyFavouriteList ccl')
                        ->where('ccl.user_id =?', $user_id)
                        ->andWhere('ccl.company_id =?', $compnay_id);
      //return favourit record
      return $favourit_query->fetchOne();
                
    }
}