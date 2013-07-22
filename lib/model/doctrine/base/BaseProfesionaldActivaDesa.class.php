<?php

/**
 * BaseProfesionaldActivaDesa
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * 
 * @method string                 getName() Returns the current record's "name" value
 * @method ProfesionaldActivaDesa setName() Sets the current record's "name" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProfesionaldActivaDesa extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('profesional_activa_desa');
        $this->hasColumn('name', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}