<?php

/**
 * ListaCuestionarioTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ListaCuestionarioTable extends Doctrine_Table {

    static $tipos = array(
        'empresa' => 'Empresa/Entidad',
        'producto' => 'Producto'
    );

    /**
     * doSelectJoin EmpresaSectorUno EmpresaSectorDos EmpresaSectorTres
     * @param type $query
     * @return type 
     */
    public static function doSelectJoin($query) {
        $rootAlias = $query->getRootAlias();
        $query = $query->select($rootAlias . '.*, esu.name')->leftJoin($rootAlias . '.EmpresaSectorUno esu');
        $query->select($rootAlias . '.*, esd.name')->leftJoin($rootAlias . '.EmpresaSectorDos esd');
        return $query->select($rootAlias . '.*, est.name')->leftJoin($rootAlias . '.EmpresaSectorTres est');
    }

    /**
     * Returns an instance of this class.
     *
     * @return object ListaCuestionarioTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('ListaCuestionario');
    }

    public function getCuestionariosForProducto($query = null) {
        if ($query) {
            $rootAlias = $query->getRootAlias();
            $query = $query->select($rootAlias . '.*, ptu.name')->leftJoin($rootAlias . '.ProductoTipoUno ptu');
            $query->select($rootAlias . '.*, ptd.name')->leftJoin($rootAlias . '.ProductoTipoDos ptd');
            $query->select($rootAlias . '.*, ptt.name')->leftJoin($rootAlias . '.ProductoTipoTres ptt');
            return $query->where($rootAlias . '.tipo = ?', 'producto');
        } else {
            return $this->createQuery('q')
                            ->where('q.tipo = ?', 'producto')
                            ->orderBy('nombre');
        }
    }

    public function getCuestionariosForEmpresa($query = null) {
        if ($query) {
            $rootAlias = $query->getRootAlias();
            $query = $query->select($rootAlias . '.*, esu.name')->leftJoin($rootAlias . '.EmpresaSectorUno esu');
            $query->select($rootAlias . '.*, esd.name')->leftJoin($rootAlias . '.EmpresaSectorDos esd');
            $query->select($rootAlias . '.*, est.name')->leftJoin($rootAlias . '.EmpresaSectorTres est');
            return $query->where($rootAlias . '.tipo = ?', 'empresa');
        } else {
            return $this->createQuery('q')
                            ->where('q.tipo = ?', 'empresa')
                            ->orderBy('nombre');
        }
    }

}