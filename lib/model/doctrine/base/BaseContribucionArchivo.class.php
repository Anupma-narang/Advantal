<?php

/**
 * BaseContribucionArchivo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $contribucion_id
 * @property string $file
 * @property Contribucion $Contribucion
 * 
 * @method integer             getContribucionId()  Returns the current record's "contribucion_id" value
 * @method string              getFile()            Returns the current record's "file" value
 * @method Contribucion        getContribucion()    Returns the current record's "Contribucion" value
 * @method ContribucionArchivo setContribucionId()  Sets the current record's "contribucion_id" value
 * @method ContribucionArchivo setFile()            Sets the current record's "file" value
 * @method ContribucionArchivo setContribucion()    Sets the current record's "Contribucion" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseContribucionArchivo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('contribucion_archivo');
        $this->hasColumn('contribucion_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('file', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Contribucion', array(
             'local' => 'contribucion_id',
             'foreign' => 'id',
             'onDelete' => 'cascade',
             'onUpdate' => 'CASCADE'));
    }
}