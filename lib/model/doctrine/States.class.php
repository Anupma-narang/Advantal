<?php

/**
 * States
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class States extends BaseStates
{
  public function getWithTodas()
    {
    	$elements  = Doctrine_Core::getTable('States')->createQuery()->orderBy('name')->execute();
    	$kk=array();
      foreach ($elements as $el)
      {
        $kk[]=array('id'=>$el->getId(), 'value'=>$el->getName());
      }
    	return $kk;
    }
}
