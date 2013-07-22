<?php

/**
 * EmpresaSectorUnoTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class EmpresaSectorUnoTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object EmpresaSectorUnoTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('EmpresaSectorUno');
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

    public function getQueryEmpresasSectorUno()
    {
        $q = $this->createQuery('a')
            ->leftJoin('a.EmpresaSectorDos e2')
            ->leftJoin('e2.EmpresaSectorTres');

        return $q;
    }

    public function getEmpresasSectorUno()
    {
        return $this->getQueryEmpresasSectorUno()->execute();
    }
    
    public function getSectoresUnoOrderByOrden()
    {
      $elements  = $this->createQuery()->orderBy('orden')->execute();
      
      $arr=array();
      foreach ($elements as $v) {
        $arr[]=array('id'=>$v->getId(), 'value'=>$v->getName());
      }
      
      return $arr;
    }


}