<?php

/**
 * BaseConcursosDestacadosTemporales
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $concurso_id
 * @property integer $tipo_tiempo_id
 * @property Concurso $Concurso
 * @property TipoTiempo $TipoTiempo
 * 
 * @method integer                       getConcursoId()     Returns the current record's "concurso_id" value
 * @method integer                       getTipoTiempoId()   Returns the current record's "tipo_tiempo_id" value
 * @method Concurso                      getConcurso()       Returns the current record's "Concurso" value
 * @method TipoTiempo                    getTipoTiempo()     Returns the current record's "TipoTiempo" value
 * @method ConcursosDestacadosTemporales setConcursoId()     Sets the current record's "concurso_id" value
 * @method ConcursosDestacadosTemporales setTipoTiempoId()   Sets the current record's "tipo_tiempo_id" value
 * @method ConcursosDestacadosTemporales setConcurso()       Sets the current record's "Concurso" value
 * @method ConcursosDestacadosTemporales setTipoTiempo()     Sets the current record's "TipoTiempo" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseConcursosDestacadosTemporales extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('concursos_destacados_temporales');
        $this->hasColumn('concurso_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('tipo_tiempo_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Concurso', array(
             'local' => 'concurso_id',
             'foreign' => 'id',
             'onUpdate' => 'CASCADE'));

        $this->hasOne('TipoTiempo', array(
             'local' => 'tipo_tiempo_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}