<?php

/**
 * ProfesionalLetterEstadoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ProfesionalLetterEstadoTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ProfesionalLetterEstadoTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ProfesionalLetterEstado');
    }

    public function getEstedioLetterName()
    {
        return Doctrine_Query::create()
                ->select('name')
                ->from('ProfesionalLetterEstado')
                ->Where('name = ?', 'Revista')
                ->orWhere('name = ?','Activa')
                ->orWhere('name = ?', 'Borrador')
                ->execute();
    }

    public function getEstedioLetterNameRechazado()
    {
        return Doctrine_Query::create()
                ->select('name')
                ->from('ProfesionalLetterEstado')
                ->Where('name = ?', 'Revista')
                ->orWhere('name = ?','Activa')
                ->orWhere('name = ?', 'Rechazado')
                ->execute();
    }
}