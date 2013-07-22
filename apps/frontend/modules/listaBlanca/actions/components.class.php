<?php

/**
 * lista_blanca actions.
 *
 * @package    auditoscopia
 * @subpackage lista_blanca
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class listaBlancaComponents extends sfComponents
{
    /**
     * Devuelve una lista de las categorías de las empresas
     */
    public function executeCategoriaEmpresas()
    {
        $this->categoriasSectorUno = Doctrine::getTable('EmpresaSectorUno')->getEmpresasSectorUno();
        $this->sector1Activo = null;
        $this->sector2Activo = null;
        $this->sector3Activo = null;
        if ($this->getRequestParameter('sector1')) {
            $this->sector1Activo = $this->getRequestParameter('sector1');
        }
        if ($this->getRequestParameter('sector2')) {
            $this->sector2Activo = $this->getRequestParameter('sector2');
        }
        if ($this->getRequestParameter('sector3')) {
            $this->sector3Activo = $this->getRequestParameter('sector3');
        }


    }


}


