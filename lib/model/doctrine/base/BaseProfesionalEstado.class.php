<?php

/**
 * BaseProfesionalEstado
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $value
 * @property string $name
 * @property Doctrine_Collection $Profesional
 * 
 * @method string              getValue()       Returns the current record's "value" value
 * @method string              getName()        Returns the current record's "name" value
 * @method Doctrine_Collection getProfesional() Returns the current record's "Profesional" collection
 * @method ProfesionalEstado   setValue()       Sets the current record's "value" value
 * @method ProfesionalEstado   setName()        Sets the current record's "name" value
 * @method ProfesionalEstado   setProfesional() Sets the current record's "Profesional" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProfesionalEstado extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('profesional_estado');
        $this->hasColumn('value', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('name', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Profesional', array(
             'local' => 'id',
             'foreign' => 'profesional_estado_id'));
    }
}