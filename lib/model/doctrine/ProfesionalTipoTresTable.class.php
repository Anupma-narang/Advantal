<?php

/**
 * ProfesionalTipoTresTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ProfesionalTipoTresTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ProfesionalTipoTresTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ProfesionalTipoTres');
    }
    
    /**
     * Devuelve el nombre legible del
     * @static
     * @param $slug
     */
    public static function getName($slug)
    {
        $q = self::getInstance()->createQuery('q')
            ->select('q.name')
            ->where('q.slug = ?', $slug);
        return $q->fetchOne();
    }
    
    public function getSectoresTresOrderByOrden()
    {
        $elements  = $this->createQuery()->orderBy('orden')->execute();
    
        return $elements;
    }

    /**
     * Function for ordering in listitng page of 'Actividade profesionals'
     * @static
     * @param $query
     */
    public static function doSelectJoinSectorSubSector($query)
    {
      return $query->select('r.*, ptu.name, ptd.name')
        ->leftJoin('r.ProfesionalTipoUno ptu')
        ->leftJoin('r.ProfesionalTipoDos ptd');
    }
}
