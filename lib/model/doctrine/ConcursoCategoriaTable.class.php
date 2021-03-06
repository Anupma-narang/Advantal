<?php

/**
 * ConcursoCategoriaTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ConcursoCategoriaTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object ConcursoCategoriaTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('ConcursoCategoria');
    }

    public function getListTypeEmpresa() {
        return $query = $this->getInstance()->createQuery()->where("concurso_tipo_id=?", 1);
    }

    public function getListTypeProducto() {
        return $query = $this->getInstance()->createQuery()->where("concurso_tipo_id=?", 2);
    }

    public function selectTipoCategoria() {
        if (sfContext::getInstance()->getRequest()->getParameter("tipo") == "empresa") {
            $tipo = 1;
        } else if (sfContext::getInstance()->getRequest()->getParameter("tipo") == "producto") {
            $tipo = 2;
        } else {
            $tipo = 1;
        }

        return $query = Doctrine::getTable("ConcursoCategoria")->createQuery()->where("concurso_tipo_id=?", $tipo)->orderBy('orden', 'asc');
    }

    public function selectTipoCategoria_Producto() {
        return $query = Doctrine::getTable("ConcursoCategoria")->createQuery()->where("concurso_tipo_id=2");
    }

    public function selectTipoCategoria_Empresa() {
        return $query = Doctrine::getTable("ConcursoCategoria")->createQuery()->where("concurso_tipo_id=1");
    }

    public function selectCategoriaCp() {
        return $query = Doctrine::getTable("ConcursoCategoria")->createQuery()->where("concurso_tipo_id=?", 1);
    }

}