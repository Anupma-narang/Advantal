<?php

/**
 * ajax_get actions.
 *
 * @package    symfony
 * @subpackage ajax_get
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ajax_getActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeEmpresa_by_nombre(sfWebRequest $request) {
        $empresa = Doctrine::getTable('empresa')->createQuery()
                ->where('name like ?', $request->getParameter('nombre'))
                ->orderBy('name')
                ->fetchOne();

        if ($empresa) {
            $ret = array(
                'retorno' => 'true',
                'name' => $empresa->getName(),
                'sector_1' => $empresa->getEmpresaSectorUnoId(),
                'sector_2_id' => $empresa->getEmpresaSectorDosId(),
                'sector_2' => Doctrine::getTable('EmpresaSectorDos')->createQuery()
                        ->where('empresa_sector_uno_id=?', $empresa->getEmpresaSectorUnoId())
                        ->execute()
                        ->toKeyValueArray('id', 'name'),
                'sector_3_id' => $empresa->getEmpresaSectorTresId(),
                'sector_3' => Doctrine::getTable('EmpresaSectorTres')->createQuery()
                        ->where('empresa_sector_dos_id=?', $empresa->getEmpresaSectorDosId())
                        ->execute()
                        ->toKeyValueArray('id', 'name')
            );
        } else {
            $ret = array('retorno' => 'false');
        }

        return $this->renderText(json_encode($ret));
    }

    public function executeEmpresas_by_nombre(sfWebRequest $request) {
        $this->empresas = Doctrine::getTable('empresa')
                ->createQuery()->where('name LIKE ?', '%' . $request->getParameter('q') . '%')
                ->orderBy('name')
                ->limit(10)
                ->execute();
    }

    public function executeProducto_by_nombre(sfWebRequest $request) {
        $this->forward404Unless($nombre = $request->getParameter('nombre'));

        if ($producto = Doctrine::getTable('producto')->createQuery()->where('name=?', $nombre)->orderBy('name')->fetchOne()) {

            return $this->renderText(json_encode(array(
                        'retorno' => 'true',
                        //'marca' 	=> $producto->getMarca(),
                        //'modelo' 	=> $producto->getModelo(),
                        'tipo_1' => $producto->getProductoTipoUnoId(),
                        'tipo_2' => Doctrine::getTable('ProductoTipoDos')->createQuery()->where('producto_tipo_uno_id=?', $producto->getProductoTipoUnoId())->execute()->toKeyValueArray('id', 'name'), //$producto->getProductoTipoDos()->getName(),
                        'tipo_2_id' => $producto->getProductoTipoDosId(),
                        'tipo_3' => Doctrine::getTable('ProductoTipoTres')->createQuery()->where('producto_tipo_dos_id=?', $producto->getProductoTipoDosId())->execute()->toKeyValueArray('id', 'name'), //$producto->getProductoTipoTres()->getName(),
                        'tipo_3_id' => $producto->getProductoTipoTresId()
            )));
        } else {
            return $this->renderText(json_encode(array('retorno' => 'false')));
        }
    }

    /* public function executeProducto_by_marca_and_nombre(sfWebRequest $request)
      {
      $marca = $request->getParameter('marca');
      $nombre = $request->getParameter('nombre');

      if (!$producto = Doctrine::getTable('producto')->createQuery()->where('Name like ?',$nombre)->orderBy('Name')->fetchOne())
      {
      if (!$producto = Doctrine::getTable('producto')->createQuery()->where('Marca like ?',$marca)->orderBy('Marca')->fetchOne())
      {
      return $this->renderText(json_encode(array('retorno' => 'false')));
      }
      }

      return $this->renderText(json_encode(array(
      'retorno' 	=> 'true',
      'nombre' 	=> $producto->getName(),
      'marca' 	=> $producto->getMarca(),
      'modelo' 	=> $producto->getModelo(),
      'tipo_1' 	=> $producto->getProductoTipoUnoId(),
      'tipo_2' 	=> Doctrine::getTable('ProductoTipoDos')->createQuery()->where('producto_tipo_uno_id=?',$producto->getProductoTipoUnoId())->execute()->toKeyValueArray('id', 'name'),//$producto->getProductoTipoDos()->getName(),
      'tipo_2_id' => $producto->getProductoTipoDosId(),
      'tipo_3' 	=> Doctrine::getTable('ProductoTipoTres')->createQuery()->where('producto_tipo_dos_id=?',$producto->getProductoTipoDosId())->execute()->toKeyValueArray('id', 'name'),//$producto->getProductoTipoTres()->getName(),
      'tipo_3_id' => $producto->getProductoTipoTresId()
      )));
      } */

    public function executeProducto_modelo_by_marca(sfWebRequest $request) {
        $marca = $request->getParameter('marca');

        if (!$producto = Doctrine::getTable('producto')->createQuery()->where('Marca LIKE ?',  $marca )->orderBy('created_at DESC')->fetchOne()) {
            return $this->renderText(json_encode(array('retorno' => 'false')));
        }

        return $this->renderText(json_encode(array(
                    'retorno' => 'true',
                    'modelo' => $producto->getModelo()
        )));
    }

    public function executeSfguarduser_by_nombre(sfWebRequest $request) {
        $this->users = Doctrine_Core::getTable('sfGuardUser')
                ->createQuery()->where('username LIKE ?', '%' . $request->getParameter('q') . '%')
                ->orderBy('username')
                ->limit(10)
                ->execute();
    }

    public function executeProductos_by_nombre(sfWebRequest $request) {
        $this->productos = Doctrine::getTable('producto')
                ->createQuery()
                ->where('name LIKE ?', '%' . $request->getParameter('q') . '%')
                ->orderBy('name')
                ->execute();
    }

    public function executeProductos_by_marca(sfWebRequest $request) {
        $this->productos = Doctrine::getTable('producto')
                ->createQuery()
                ->where('Marca LIKE ?', '%' . $request->getParameter('q') . '%')
                ->orderBy('name')
                ->execute();
    }

    public function executeProductos_by_modelo(sfWebRequest $request) {
        $this->productos = Doctrine::getTable('producto')
                ->createQuery()
                ->where('modelo LIKE ?', '%' . $request->getParameter('q') . '%')
                ->orderBy('name')
                ->execute();
    }

    public function executeIds_ordenados_concurso_empresa_sector_uno(sfWebRequest $request) {
        $q = Doctrine_Core::getTable('EmpresaSectorUno')->createQuery()
                ->orderBy('orden')
                ->execute();

        $arr = array();
        foreach ($q as $item) {
            $arr[] = $item->getId();
        }

        return $this->renderText(json_encode($arr));
    }

    public function executeIds_ordenados_concurso_empresa_sector_dos(sfWebRequest $request) {
        $q = Doctrine_Core::getTable('EmpresaSectorDos')->createQuery()
                ->where('empresa_sector_uno_id=?', $request->getParameter('empresa_sector_uno_id'))
                ->orderBy('orden')
                ->execute();

        $arr = array();
        foreach ($q as $item) {
            $arr[] = $item->getId();
        }

        return $this->renderText(json_encode($arr));
    }

    public function executeIds_ordenados_concurso_empresa_sector_tres(sfWebRequest $request) {
        $q = Doctrine_Core::getTable('EmpresaSectorTres')->createQuery()
                ->where('empresa_sector_dos_id=?', $request->getParameter('empresa_sector_dos_id'))
                ->orderBy('orden')
                ->execute();

        $arr = array();
        foreach ($q as $item) {
            $arr[] = $item->getId();
        }

        return $this->renderText(json_encode($arr));
    }

    //
    public function executeIds_ordenados_concurso_profesional_tipo_uno(sfWebRequest $request) {
        $q = Doctrine_Core::getTable('ProfesionalTipoUno')->createQuery()
                ->orderBy('orden')
                ->execute();

        $arr = array();
        foreach ($q as $item) {
            $arr[] = $item->getId();
        }

        return $this->renderText(json_encode($arr));
    }

    public function executeIds_ordenados_concurso_profesional_tipo_dos(sfWebRequest $request) {
        $q = Doctrine_Core::getTable('ProfesionalTipoDos')->createQuery()
                ->where('profesional_tipo_uno_id=?', $request->getParameter('profesional_tipo_uno_id'))
                ->orderBy('orden')
                ->execute();

        $arr = array();
        foreach ($q as $item) {
            $arr[] = $item->getId();
        }

        return $this->renderText(json_encode($arr));
    }

    public function executeIds_ordenados_concurso_profesional_tipo_tres(sfWebRequest $request) {
        $q = Doctrine_Core::getTable('ProfesionalTipoTres')->createQuery()
                ->where('profesional_tipo_dos_id=?', $request->getParameter('profesional_tipo_dos_id'))
                ->orderBy('orden')
                ->execute();

        $arr = array();
        foreach ($q as $item) {
            $arr[] = $item->getId();
        }

        return $this->renderText(json_encode($arr));
    }

    //

    public function executeIds_ordenados_concurso_producto_tipo_uno(sfWebRequest $request) {
        $q = Doctrine_Core::getTable('ProductoTipoUno')->createQuery()
                ->orderBy('orden')
                ->execute();

        $arr = array();
        foreach ($q as $item) {
            $arr[] = $item->getId();
        }

        return $this->renderText(json_encode($arr));
    }

    public function executeIds_ordenados_concurso_producto_tipo_dos(sfWebRequest $request) {
        $q = Doctrine_Core::getTable('ProductoTipoDos')->createQuery()
                ->where('producto_tipo_uno_id=?', $request->getParameter('producto_tipo_uno_id'))
                ->orderBy('orden')
                ->execute();

        $arr = array();
        foreach ($q as $item) {
            $arr[] = $item->getId();
        }

        return $this->renderText(json_encode($arr));
    }

    public function executeIds_ordenados_concurso_producto_tipo_tres(sfWebRequest $request) {
        $q = Doctrine_Core::getTable('ProductoTipoTres')->createQuery()
                ->where('producto_tipo_dos_id=?', $request->getParameter('producto_tipo_dos_id'))
                ->orderBy('orden')
                ->execute();

        $arr = array();
        foreach ($q as $item) {
            $arr[] = $item->getId();
        }

        return $this->renderText(json_encode($arr));
    }

    // Alpesh : added new function for profesional register
    public function executeIds_ordenados_profesional_profesional_tipo_uno(sfWebRequest $request) {
        $q = Doctrine_Core::getTable('ProfesionalTipoUno')->createQuery()
                ->orderBy('orden')
                ->execute();

        $arr = array();
        foreach ($q as $item) {
            $arr[] = $item->getId();
        }

        return $this->renderText(json_encode($arr));
    }

    public function executeIds_ordenados_profesional_profesional_tipo_dos(sfWebRequest $request) {
        $q = Doctrine_Core::getTable('ProfesionalTipoDos')->createQuery()
                ->where('profesional_tipo_uno_id=?', $request->getParameter('profesional_tipo_uno_id'))
                ->orderBy('orden')
                ->execute();

        $arr = array();
        foreach ($q as $item) {
            $arr[] = $item->getId();
        }

        return $this->renderText(json_encode($arr));
    }

    public function executeIds_ordenados_profesional_profesional_tipo_tres(sfWebRequest $request) {
        $q = Doctrine_Core::getTable('ProfesionalTipoTres')->createQuery()
                ->where('profesional_tipo_dos_id=?', $request->getParameter('profesional_tipo_dos_id'))
                ->orderBy('orden')
                ->execute();

        $arr = array();
        foreach ($q as $item) {
            $arr[] = $item->getId();
        }

        return $this->renderText(json_encode($arr));
    }

    public function executeGetStates(sfWebRequest $request){
        $q = Doctrine_Core::getTable('States')->createQuery()
                ->orderBy('orden')
                ->execute();

        $states = "<option value=''>Selecciona provincia</option>";
        foreach ($q as $item) {
            $sel = ($request->getParameter("val")==$item->getId()) ? "selected" : "";
            $states .= '<option value="'.$item->getId().'" '.$sel.'>'.$item->getName().'</option>';
        }

        return $this->renderText($states);
    }
}
