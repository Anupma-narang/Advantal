<?php

/**
 * BaseProfesionalLetterType
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $description
 * @property Doctrine_Collection $ProfesionalLetter
 * 
 * @method string                getName()              Returns the current record's "name" value
 * @method string                getDescription()       Returns the current record's "description" value
 * @method Doctrine_Collection   getProfesionalLetter() Returns the current record's "ProfesionalLetter" collection
 * @method ProfesionalLetterType setName()              Sets the current record's "name" value
 * @method ProfesionalLetterType setDescription()       Sets the current record's "description" value
 * @method ProfesionalLetterType setProfesionalLetter() Sets the current record's "ProfesionalLetter" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProfesionalLetterType extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('profesional_letter_type');
        $this->hasColumn('name', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('description', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('ProfesionalLetter', array(
             'local' => 'id',
             'foreign' => 'profesional_letter_type_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}