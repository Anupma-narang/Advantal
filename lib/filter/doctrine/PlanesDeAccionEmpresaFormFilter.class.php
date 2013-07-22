<?php

/**
 * PlanesDeAccionEmpresa filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PlanesDeAccionEmpresaFormFilter extends BaseContribucionFormFilter {

    public function configure() {
        $i18n = sfContext::getInstance()->getI18N();
        $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_40_c'));
        //$this->widgetSchema['concurso_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Concurso'), 'add_empty' => 'Selecciona Concurso'));
        $this->widgetSchema['concurso_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => $this->getRelatedModelName('Concurso'),
            'depends' => 'ConcursoTipo',
            'add_empty' => 'Selecciona concurso',
            'order_by' => array('name', 'asc'),
        ));
        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'with_empty' => false, 'template' => $i18n->__('Desde %from_date%<br />Hasta %to_date%')));
        $q = Doctrine_Query::create()
                ->from('ConcursoEstado')
                ->where('id != 1');
        $this->widgetSchema['concurso_estado'] = new sfWidgetFormDoctrineChoice(array('model' => 'ConcursoEstado', 'add_empty' => 'Selecciona estado', 'query' => $q));
        $this->widgetSchema['contribucion_estado'] = new sfWidgetFormDoctrineChoice(array('model' => 'ContribucionEstado', 'add_empty' => 'Selecciona estado'));
        //$this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => 'Selecciona Usuario'));
        $this->widgetSchema['user_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 25, 'style' => 'width: 176px;'));
        $this->validatorSchema['user_id'] = new sfValidatorPass(array('required' => false));

//$this->widgetSchema['concurso_categoria'] = new sfWidgetFormDoctrineChoice(array('model' => 'ConcursoCategoria', 'add_empty' => 'Selecciona Categoría'));
        $this->widgetSchema['concurso_empresa'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'style' => 'width:225px !important'));
        $this->widgetSchema['concurso_actividad'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_40_c'));

        $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'label' => 'Sector',
            'model' => 'EmpresaSectorUno',
            'order_by' => 'orden',
            'add_empty' => $i18n->__('Selecciona sector')));

        $this->widgetSchema['empresa_sector_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'label' => 'Subsector',
            'model' => 'EmpresaSectorDos',
            'order_by' => 'orden',
            'depends' => 'EmpresaSectorUno',
            'add_empty' => $i18n->__('Selecciona subsector')));

        $this->widgetSchema['empresa_sector_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'label' => 'Actividad',
            'model' => 'EmpresaSectorTres',
            'order_by' => 'orden',
            'depends' => 'EmpresaSectorDos',
            'add_empty' => $i18n->__('Selecciona actividad')));

        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'States',
            'add_empty' => $i18n->__('Selecciona provincia'),
            'label' => 'Provincia',
            'order_by' => array('orden', 'asc')
                ), array("style" => "width: 235px"));

        $this->widgetSchema['localidad_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'City',
            'depends' => 'States',
            'add_empty' => $i18n->__('Selecciona localidad'),
                ), array("style" => "width: 235px"));

        $this->widgetSchema['concurso_tipo_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ConcursoTipo', 'add_empty' => 'Selecciona tipo de concurso'));


        $newvar = $_SERVER["REQUEST_URI"];
        $pieces = explode("/", $newvar);
        /* if ($pieces[2] == "planes_de_accion_empresa") {
          $q = Doctrine_Query::create()
          ->from('Concurso')
          ->where('concurso_tipo_id = 1');
          $this->widgetSchema['concurso_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Concurso', 'add_empty' => 'Selecciona concurso', 'query' => $q));
          } elseif ($pieces[2] == "planes_de_accion_producto") {
          $q = Doctrine_Query::create()
          ->from('Concurso')
          ->where('concurso_tipo_id = 2');
          $this->widgetSchema['concurso_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Concurso', 'add_empty' => 'Selecciona concurso', 'query' => $q));
          } else {
          $this->widgetSchema['concurso_id'] = new sfWidgetFormDoctrineDependentSelect(array(
          'model' => $this->getRelatedModelName('Concurso'),
          'depends' => 'ConcursoTipo',
          'add_empty' => 'Selecciona concurso',
          'order_by' => array('name', 'asc'),
          ));
          } */

        $this->widgetSchema['concurso_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'style' => 'width:281px !important;'));
        $this->validatorSchema['concurso_id'] = new sfValidatorPass(array('required' => false));


        $newvar = $_SERVER["REQUEST_URI"];
        $pieces = explode("/", $newvar);
        if ($pieces[2] == "planes_de_accion_empresa") {
            $q = Doctrine_Query::create()
                    ->from('ConcursoCategoria')
                    ->where('concurso_tipo_id = 1');
            $this->widgetSchema['concurso_categoria'] = new sfWidgetFormDoctrineChoice(array('model' => 'ConcursoCategoria', 'add_empty' => 'Selecciona categoría', 'query' => $q));
        } elseif ($pieces[2] == "planes_de_accion_producto") {
            $q = Doctrine_Query::create()
                    ->from('ConcursoCategoria')
                    ->where('concurso_tipo_id = 2');
            $this->widgetSchema['concurso_categoria'] = new sfWidgetFormDoctrineChoice(array('model' => 'ConcursoCategoria', 'add_empty' => 'Selecciona categoría', 'query' => $q));
        } else {
            //$this->widgetSchema['concurso_categoria'] = new sfWidgetFormDoctrineChoice(array('model' => 'ConcursoCategoria', 'add_empty' => 'Selecciona Categoría'));
            $this->widgetSchema['concurso_categoria'] = new sfWidgetFormDoctrineDependentSelect(array(
                'model' => 'ConcursoCategoria',
                'depends' => 'ConcursoTipo',
                'add_empty' => 'Selecciona categoría',
                'order_by' => array('orden', 'asc'),
            ));
        }

        $this->validatorSchema['concurso_tipo_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['concurso_estado'] = new sfValidatorPass();
        $this->validatorSchema['contribucion_estado'] = new sfValidatorPass();
        $this->validatorSchema['concurso_categoria'] = new sfValidatorPass();
        $this->validatorSchema['concurso_empresa'] = new sfValidatorPass();
        $this->validatorSchema['concurso_actividad'] = new sfValidatorPass();
        $this->validatorSchema['empresa_sector_tres_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['empresa_sector_dos_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['empresa_sector_uno_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['states_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['localidad_id'] = new sfValidatorPass(array('required' => false));
    }

    public function getFields() {
        $fields = parent::getFields();

        //the right 'virtual_column_name' is the method to filter
        $fields['concurso_id'] = 'concurso_id';
        $fields['concurso_estado'] = 'concurso_estado';
        $fields['concurso_categoria'] = 'concurso_categoria';
        $fields['concurso_empresa'] = 'concurso_empresa';
        $fields['concurso_actividad'] = 'concurso_actividad';

        return $fields;
    }

    public function addConcursoIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->leftJoin($rootAlias . ".Concurso con");
        $query->andWhere("con.name LIKE '%$value[text]%'");
        return $query;
    }

    public function addConcursoEstadoColumnQuery($query, $field, $value) {
        if (!empty($value)) {
            $rootAlias = $query->getRootAlias();
            $query->andWhere("co.concurso_estado_id='$value'");
            //echo $query;die;
            return $query;
        }
    }

    public function addContribucionEstadoColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere("r.contribucion_estado_id='$value'");
        //echo $query;die;
        return $query;
    }

    public function addConcursoTipoIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere("co.concurso_tipo_id='$value'");
        //echo $query;die;
        return $query;
    }

    public function addConcursoCategoriaColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere("co.concurso_categoria_id='$value'");
        //echo $query;die;
        return $query;
    }

    public function addConcursoEmpresaColumnQuery($query, $field, $value) {
        if (!empty($value["text"])) {
            $rootAlias = $query->getRootAlias();
            $query->andWhere("e.name LIKE '%" . $value["text"] . "%'");
            //echo $query;die;
            return $query;
        }
    }

    public function addEmpresaSectorTresIdColumnQuery($query, $field, $value) {
        if (!empty($value) && $value != "Selecciona actividad") {
            $rootAlias = $query->getRootAlias();
            $query->leftJoin("r.Concurso ccs");

            $query->leftJoin("ccs.Empresa ets");

            $query->leftJoin("ets.EmpresaSectorTres esta");
            $query->addWhere('esta.id = ?', $value);
            //echo $query;die;
            return $query;
        }
    }

    public function addEmpresaSectorUnoIdColumnQuery($query, $field, $value) {
        if (!empty($value) && $value != "Selecciona sector") {
            $rootAlias = $query->getRootAlias();
            $query->leftJoin("r.Concurso cs");

            $query->leftJoin("cs.Empresa ete");

            $query->leftJoin("ete.EmpresaSectorUno est");
            $query->addWhere('est.id = ?', $value);
            //  echo $query;die;
            return $query;
        }
    }

    public function addEmpresaSectorDosIdColumnQuery($query, $field, $value) {
        if (!empty($value) && $value != "Selecciona subsector") {
            $rootAlias = $query->getRootAlias();
            $query->leftJoin("r.Concurso cc");

            $query->leftJoin("cc.Empresa eta");

            $query->leftJoin("eta.EmpresaSectorDos east");
            $query->addWhere('east.id = ?', $value);
            //echo $query;die;
            return $query;
        }
    }

    public function addStatesidColumnQuery($query, $field, $value) {
        if (!empty($value) && $value != "Selecciona provincia") {
            $rootAlias = $query->getRootAlias();
            $query->leftJoin("r.Concurso cse");

            //  $query->leftJoin("cse.Empresa es");

            $query->leftJoin("cse.States ests");
            $query->addWhere('ests.id = ?', $value);
            //  echo $query;die;
            return $query;
        }
    }

    public function addLocalidadidColumnQuery($query, $field, $value) {
        if (!empty($value) && $value != "Selecciona localidad") {
            $rootAlias = $query->getRootAlias();
            $query->leftJoin("r.Concurso cce");

            $query->leftJoin("cce.Empresa etas");

            $query->leftJoin("etas.Localidad easte");
            $query->addWhere('easte.id = ?', $value);
            //echo $query;die;
            return $query;
        }
    }

    public function addUserIdColumnQuery($query, $field, $value) {
        if (!empty($value)) {
            $rootAlias = $query->getRootAlias();
            $query->leftJoin($rootAlias . '.User gu');
            $fieldName = "username";
            if (is_array($value) && isset($value['is_empty']) && $value['is_empty']) {
                $query->addWhere(sprintf('(%s.%s IS NULL OR %1$s.%2$s = ?)', 'gu', $fieldName), array(''));
            } else if (is_array($value) && isset($value['text']) && '' != $value['text']) {
                $query->addWhere(sprintf('%s.%s LIKE ?', 'gu', $fieldName), '%' . $value['text'] . '%');
            }
            return $query;
        }
    }

}

