<?php

/**
 * Concurso filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ConcursosPendientesEmpresaFormFilter extends BaseConcursoFormFilter {

    public function configure() {
        $i18n = sfContext::getInstance()->getI18N();

        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'with_empty' => false, 'template' => $i18n->__('Desde %from_date%<br />Hasta %to_date%')));
        //$this->widgetSchema['concurso_categoria_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCategoria'), 'add_empty' => 'Selecciona categoría', 'label' => $i18n->__('Categoría')));
        $this->widgetSchema['concurso_estado_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoEstado'), 'add_empty' => 'Selecciona estado'));
        //$this->widgetSchema['empresa_id']             = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'), 'add_empty' => 'Selecciona empresa/entidad'));
        //$this->widgetSchema['producto_id']            = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => 'Selecciona producto'));

        $this->widgetSchema['empresa'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['producto'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        //unset ($this->widgetSchema['destacado']);
        //$this->setLabel('aaaa');
        //$this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_40_c'));
        $this->widgetSchema['names'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_40_c'));
        $q = Doctrine_Query::create()
                ->from('States a')
                ->orderBy('a.orden asc');
        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => $this->getRelatedModelName('States'), 'add_empty' => 'Selecciona provincia', 'order_by' => array('orden', 'asc')));
        $this->widgetSchema['user_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 25, 'style' => 'width:176px !important;'));

        $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'EmpresaSectorUno', 'add_empty' => 'Selecciona sector'));
        $this->widgetSchema['empresa_sector_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'EmpresaSectorDos', 'depends' => 'EmpresaSectorUno', 'add_empty' => 'Selecciona subsector'));
        $this->widgetSchema['empresa_sector_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'EmpresaSectorTres', 'depends' => 'EmpresaSectorDos', 'add_empty' => 'Selecciona actividad'));

        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ProductoTipoUno', 'add_empty' => 'Selecciona sector'));
        $this->widgetSchema['producto_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ProductoTipoDos', 'depends' => 'ProductoTipoUno', 'add_empty' => 'Selecciona subsector'));
        $this->widgetSchema['producto_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ProductoTipoTres', 'depends' => 'ProductoTipoDos', 'add_empty' => 'Selecciona tipo de producto'));

        $this->widgetSchema['marca'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['modelo'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 20, 'class' => 'tamano_20_c'));

        $this->validatorSchema['empresa_sector_uno_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['empresa_sector_dos_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['empresa_sector_tres_id'] = new sfValidatorPass(array('required' => false));

        $this->validatorSchema['producto_tipo_uno_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['producto_tipo_dos_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['producto_tipo_tres_id'] = new sfValidatorPass(array('required' => false));

        $this->validatorSchema['marca'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['modelo'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['empresa_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['producto_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['user_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['names'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['empresa'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['producto'] = new sfValidatorPass(array('required' => false));

        $newvar = $_SERVER["REQUEST_URI"];
        $pieces1 = explode("?", $newvar);
        $pieces = explode("/", $pieces1[0]);
        if ($pieces[2] == "concursos_pendientes_empresa") {
            $q = Doctrine_Query::create()
                    ->from('ConcursoCategoria')
                    ->where('concurso_tipo_id = 1');
            $this->widgetSchema['concursos_categoria_id'] = new sfWidgetFormDoctrineChoice(array('label' => 'Categoría', 'model' => $this->getRelatedModelName('ConcursoCategoria'), 'add_empty' => 'Selecciona categoría', 'order_by' => array('orden', 'asc'), 'query' => $q));
        } elseif ($pieces[2] == "concursos_pendientes_product") {
            $q = Doctrine_Query::create()
                    ->from('ConcursoCategoria')
                    ->where('concurso_tipo_id = 2');
            $this->widgetSchema['concursos_categoria_id'] = new sfWidgetFormDoctrineChoice(array('label' => 'Categoría', 'model' => $this->getRelatedModelName('ConcursoCategoria'), 'add_empty' => 'Selecciona categoría', 'order_by' => array('orden', 'asc'), 'query' => $q));
        } else {
            $this->widgetSchema['concurso_tipo_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => $this->getRelatedModelName('ConcursoTipo'), 'add_empty' => 'Selecciona tipo de concurso'));
            $q = Doctrine_Query::create()
                    ->from('ConcursoCategoria')
                    ->where('concurso_tipo_id IN (1,2)');
            $this->widgetSchema['concursos_categoria_id'] = new sfWidgetFormDoctrineChoice(array('label' => 'Categoría', 'model' => $this->getRelatedModelName('ConcursoCategoria'), 'add_empty' => 'Selecciona categoría', 'order_by' => array('orden', 'asc'), 'query' => $q));
            /* $this->widgetSchema['concurso_categoria_id'] = new sfWidgetFormDoctrineDependentSelect(array(
              'label' => 'Categoría',
              'model' => 'ConcursoCategoria',
              'depends' => 'ConcursoTipo',
              'add_empty' => 'Selecciona categoría',
              'order_by' => array('orden', 'asc'),
              )); */
        }


        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Localidad',
                    'model' => 'City',
                    'depends' => 'States',
                    'add_empty' => 'Selecciona localidad',
                ));

        $this->validatorSchema['concursos_categoria_id'] = new sfValidatorPass(array('required' => false));
        /*  $this->widgetSchema['marca'] = new sfWidgetFormDoctrineDependentSelect(array(
          'label' => 'Marca',
          'model' => 'Producto',
          'add_empty' => 'Selecciona marca',
          ));


          $this->setValidators(array(
          'marca'                   => new sfValidatorPass(array('required' => false)),
          'created_at'              => new sfValidatorPass(array('required' => false)),
          'name'                    => new sfValidatorPass(array('required' => false)),
          'concurso_tipo_id'        => new sfValidatorPass(array('required' => false)),
          'concurso_categoria_id'   => new sfValidatorPass(array('required' => false)),
          'empresa_id'   => new sfValidatorPass(array('required' => false)),
          'producto_id'   => new sfValidatorPass(array('required' => false)),
          'city_id'   => new sfValidatorPass(array('required' => false)),
          'user_id'   => new sfValidatorPass(array('required' => false)),
          'states_id'   => new sfValidatorPass(array('required' => false)),
          )); */
    }

    public function getFields() {
        $fields = parent::getFields();
        //the right 'virtual_column_name' is the method to filter
        $fields['empresa_sector_uno_id'] = 'empresa_sector_uno_id';
        $fields['empresa_sector_dos_id'] = 'empresa_sector_dos_id';
        $fields['empresa_sector_tres_id'] = 'empresa_sector_tres_id';
        $fields['producto_tipo_uno_id'] = 'producto_tipo_uno_id';
        $fields['producto_tipo_dos_id'] = 'producto_tipo_dos_id';
        $fields['producto_tipo_tres_id'] = 'producto_tipo_tres_id';
        $fields['marca'] = 'marca';
        $fields['modelo'] = 'modelo';

        //    $fields['empresa_id'] = 'empresa_id';
        //    $fields['producto_id'] = 'producto_id';

        return $fields;
    }

    public function addNamesColumnQuery($query, $field, $value) {
        /* if ($value['text']) {
          $rootAlias = $query->getRootAlias();
          $query->andWhere($rootAlias . '.name LIKE "%' . $value['text'] . '%"');
          return $query;
          } */

        $fieldName = "name";
        if (is_array($value) && isset($value['is_empty']) && $value['is_empty']) {
            $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'r', $fieldName), array(''));
        } else if (is_array($value) && isset($value['text']) && '' != $value['text']) {
            $query->addWhere(sprintf('%s.%s LIKE ?', 'r', $fieldName), '%' . $value['text'] . '%');
        }
        return $query;
    }

    public function addConcursosCategoriaIdColumnQuery($query, $field, $value) {
        if ($value) {
            $rootAlias = $query->getRootAlias();
            $query->andWhere($rootAlias . '.concurso_categoria_id=?', $value);
            return $query;
        }
    }

    public function addEmpresaSectorUnoIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query1 = Doctrine_Query::create()
                ->from('Empresa esd')
                ->where('esd.empresa_sector_uno_id=?', $value)
                ->execute();

        $newvar = array();
        foreach ($query1 as $i => $query1_val) {
            $newvar[$i] = $query1_val->id;
        }
        if ($newvar) {
            $comma_separated = implode(",", $newvar);
            $query->andWhere('empresa_id IN (' . $comma_separated . ')');
        } else {
            $comma_separated = '';
            $query->andWhere('empresa_id IN ?', $comma_separated);
        }
        return $query;
    }

    public function addEmpresaSectorDosIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query1 = Doctrine_Query::create()
                ->from('Empresa esd')
                ->where('esd.empresa_sector_dos_id=?', $value)
                ->execute();

        $newvar_2 = array();
        foreach ($query1 as $i => $query1_val) {
            $newvar_2[$i] = $query1_val->id;
        }
        if ($newvar_2) {
            $comma_separated_2 = implode(",", $newvar_2);
            $query->andWhere('empresa_id IN (' . $comma_separated_2 . ')');
        } else {
            $comma_separated_2 = '';
            $query->andWhere('empresa_id IN ?', $comma_separated_2);
        }

        return $query;
    }

    public function addEmpresaSectorTresIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query1 = Doctrine_Query::create()
                ->from('Empresa esd')
                ->where('esd.empresa_sector_tres_id=?', $value)
                ->execute();

        $newvar_3 = array();
        foreach ($query1 as $j => $query1_val) {
            $newvar_3[$j] = $query1_val->id;
        }
        if ($newvar_3) {
            $comma_separated_3 = implode(",", $newvar_3);
            $query->andWhere('empresa_id IN (' . $comma_separated_3 . ')');
        } else {
            $comma_separated_3 = '';
            $query->andWhere('empresa_id IN ?', $comma_separated_3);
        }
        return $query;
    }

    public function addProductoTipoUnoIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query1 = Doctrine_Query::create()
                ->from('Producto esd')
                ->where('esd.producto_tipo_uno_id=?', $value)
                ->execute();

        $prodvar = array();
        foreach ($query1 as $i => $query1_val) {
            $prodvar[$i] = $query1_val->id;
        }
        if ($prodvar) {
            $prod_separated = implode(",", $prodvar);
            $query->andWhere('producto_id IN (' . $prod_separated . ')');
        } else {
            $prod_separated = '';
            $query->andWhere('producto_id IN ?', $prod_separated);
        }

        return $query;
    }

    public function addProductoTipoDosIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query1 = Doctrine_Query::create()
                ->from('Producto esd')
                ->where('esd.producto_tipo_dos_id=?', $value)
                ->execute();

        $prodvar_2 = array();
        foreach ($query1 as $i => $query1_val) {
            $prodvar_2[$i] = $query1_val->id;
        }
        if ($prodvar_2) {
            $prod_separated_2 = implode(",", $prodvar_2);
            $query->andWhere('producto_id IN (' . $prod_separated_2 . ')');
        } else {
            $prod_separated_2 = '';
            $query->andWhere('producto_id IN ?', $prod_separated_2);
        }

        return $query;
    }

    public function addProductoTipoTresIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query1 = Doctrine_Query::create()
                ->from('Producto esd')
                ->where('esd.producto_tipo_tres_id=?', $value)
                ->execute();

        $prodvar_3 = array();
        foreach ($query1 as $i => $query1_val) {
            $prodvar_3[$i] = $query1_val->id;
        }
        if ($prodvar_3) {
            $prod_separated_3 = implode(",", $prodvar_3);
            $query->andWhere('producto_id IN (' . $prod_separated_3 . ')');
        } else {
            $prod_separated_3 = '';
            $query->andWhere('producto_id IN ?', $prod_separated_3);
        }
        return $query;
    }

    public function addMarcaColumnQuery($query, $field, $value) {
        if ($value['text']) {
            $rootAlias = $query->getRootAlias();

            $query->leftJoin("r.Producto bb");
            $query->andWhere("bb.marca LIKE '%$value[text]%'");

            return $query;
        }
    }

    public function addModeloColumnQuery($query, $field, $value) {
        if ($value['text']) {
            $rootAlias = $query->getRootAlias();

            $query->leftJoin("r.Producto dd");
            $query->andWhere("dd.modelo LIKE '%$value[text]%'");

            return $query;
        }
    }

    /*    public function addEmpresaColumnQuery($query, $field, $value) {
      if ($value['text']) {
      $rootAlias = $query->getRootAlias();

      $query->leftJoin("r.Empresa e");
      $query->andWhere('e.name LIKE "%' . $value['text'] . '%"');
      // $query->andWhere("e.name LIKE '%$value[text]%'");
      //echo $query;die;
      return $query;
      }
      } */

    public function addEmpresaColumnQuery($query, $field, $value) {
        $query->leftJoin("r.Empresa e");
        $fieldName = "name";
        if (is_array($value) && isset($value['is_empty']) && $value['is_empty']) {
            $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'e', $fieldName), array(''));
        } else if (is_array($value) && isset($value['text']) && '' != $value['text']) {
            $query->addWhere(sprintf('%s.%s LIKE ?', 'e', $fieldName), '%' . $value['text'] . '%');
        }
        return $query;
    }

    public function addProductoColumnQuery($query, $field, $value) {
        if ($value['text']) {
            $rootAlias = $query->getRootAlias();

            $query->leftJoin("r.Producto p");
            $query->andWhere('p.name LIKE "%' . $value['text'] . '%"');
            //echo $query;die;
            return $query;
        }
    }

    public function addUserIdColumnQuery($query, $field, $value) {
        /* if ($value['text']) {
          $query->leftJoin($query->getRootAlias() . '.User u');
          $query->Where('u.username LIKE "%' . $value['text'] . '%"');
          return $query;
          } */

        $query->leftJoin("r.User u");
        $fieldName = "username";
        if (is_array($value) && isset($value['is_empty']) && $value['is_empty']) {
            $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'u', $fieldName), array(''));
        } else if (is_array($value) && isset($value['text']) && '' != $value['text']) {
            $query->addWhere(sprintf('%s.%s LIKE ?', 'u', $fieldName), '%' . $value['text'] . '%');
        }
        return $query;
    }

}