<?php

/**
 * BaseContribucionEstado
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property Doctrine_Collection $Contribucion
 * @property Doctrine_Collection $ContribucionCp
 * 
 * @method string              getName()           Returns the current record's "name" value
 * @method Doctrine_Collection getContribucion()   Returns the current record's "Contribucion" collection
 * @method Doctrine_Collection getContribucionCp() Returns the current record's "ContribucionCp" collection
 * @method ContribucionEstado  setName()           Sets the current record's "name" value
 * @method ContribucionEstado  setContribucion()   Sets the current record's "Contribucion" collection
 * @method ContribucionEstado  setContribucionCp() Sets the current record's "ContribucionCp" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseContribucionEstado extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('contribucion_estado');
        $this->hasColumn('name', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Contribucion', array(
             'local' => 'id',
             'foreign' => 'contribucion_estado_id'));

        $this->hasMany('ContribucionCp', array(
             'local' => 'id',
             'foreign' => 'contribucion_estado_id'));
    }
}