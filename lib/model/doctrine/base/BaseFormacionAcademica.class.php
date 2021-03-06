<?php

/**
 * BaseFormacionAcademica
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $nombre
 * @property Doctrine_Collection $sfGuardUserProfile
 * 
 * @method string              getNombre()             Returns the current record's "nombre" value
 * @method Doctrine_Collection getSfGuardUserProfile() Returns the current record's "sfGuardUserProfile" collection
 * @method FormacionAcademica  setNombre()             Sets the current record's "nombre" value
 * @method FormacionAcademica  setSfGuardUserProfile() Sets the current record's "sfGuardUserProfile" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFormacionAcademica extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('formacion_academica');
        $this->hasColumn('nombre', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('sfGuardUserProfile', array(
             'local' => 'id',
             'foreign' => 'formacion_academica_id'));
    }
}