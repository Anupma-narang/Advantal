<?php

/**
 * BaseConcursoCategoria
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property integer $concurso_tipo_id
 * @property string $image
 * @property integer $orden
 * @property ConcursoTipo $ConcursoTipo
 * @property Doctrine_Collection $Concurso
 * @property Doctrine_Collection $ConcursoCp
 * 
 * @method string              getName()             Returns the current record's "name" value
 * @method integer             getConcursoTipoId()   Returns the current record's "concurso_tipo_id" value
 * @method string              getImage()            Returns the current record's "image" value
 * @method integer             getOrden()            Returns the current record's "orden" value
 * @method ConcursoTipo        getConcursoTipo()     Returns the current record's "ConcursoTipo" value
 * @method Doctrine_Collection getConcurso()         Returns the current record's "Concurso" collection
 * @method Doctrine_Collection getConcursoCp()       Returns the current record's "ConcursoCp" collection
 * @method ConcursoCategoria   setName()             Sets the current record's "name" value
 * @method ConcursoCategoria   setConcursoTipoId()   Sets the current record's "concurso_tipo_id" value
 * @method ConcursoCategoria   setImage()            Sets the current record's "image" value
 * @method ConcursoCategoria   setOrden()            Sets the current record's "orden" value
 * @method ConcursoCategoria   setConcursoTipo()     Sets the current record's "ConcursoTipo" value
 * @method ConcursoCategoria   setConcurso()         Sets the current record's "Concurso" collection
 * @method ConcursoCategoria   setConcursoCp()       Sets the current record's "ConcursoCp" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseConcursoCategoria extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('concurso_categoria');
        $this->hasColumn('name', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('concurso_tipo_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('image', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('orden', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('ConcursoTipo', array(
             'local' => 'concurso_tipo_id',
             'foreign' => 'id',
             'onUpdate' => 'CASCADE'));

        $this->hasMany('Concurso', array(
             'local' => 'id',
             'foreign' => 'concurso_categoria_id'));

        $this->hasMany('ConcursoCp', array(
             'local' => 'id',
             'foreign' => 'concurso_categoria_id'));
    }
}