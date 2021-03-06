<?php

/**
 * BaseConcursoHistorico
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $concurso_id
 * @property datetime $date
 * @property integer $estado_inicial
 * @property integer $estado_final
 * @property Concurso $Concurso
 * 
 * @method integer           getConcursoId()     Returns the current record's "concurso_id" value
 * @method datetime          getDate()           Returns the current record's "date" value
 * @method integer           getEstadoInicial()  Returns the current record's "estado_inicial" value
 * @method integer           getEstadoFinal()    Returns the current record's "estado_final" value
 * @method Concurso          getConcurso()       Returns the current record's "Concurso" value
 * @method ConcursoHistorico setConcursoId()     Sets the current record's "concurso_id" value
 * @method ConcursoHistorico setDate()           Sets the current record's "date" value
 * @method ConcursoHistorico setEstadoInicial()  Sets the current record's "estado_inicial" value
 * @method ConcursoHistorico setEstadoFinal()    Sets the current record's "estado_final" value
 * @method ConcursoHistorico setConcurso()       Sets the current record's "Concurso" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseConcursoHistorico extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('concurso_historico');
        $this->hasColumn('concurso_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('date', 'datetime', null, array(
             'type' => 'datetime',
             'notnull' => true,
             ));
        $this->hasColumn('estado_inicial', 'integer', 3, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 3,
             ));
        $this->hasColumn('estado_final', 'integer', 3, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 3,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Concurso', array(
             'local' => 'concurso_id',
             'foreign' => 'id',
             'onUpdate' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}