<?php

/**
 * Contribucion filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContribucionFormFilter extends BaseContribucionFormFilter {

    public function configure() {
        $i18n = sfContext::getInstance()->getI18N();

        $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'style' => 'width: 281px;'));
        $this->widgetSchema['contribucion_estado_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContribucionEstado'), 'add_empty' => 'Selecciona estado'));

        $newvar = $_SERVER["REQUEST_URI"];
        $pieces = explode("/", $newvar);
        /* if ($pieces[2] == "contribucion_empresa") {
          $q = Doctrine_Query::create()
          ->from('Concurso')
          ->where('concurso_tipo_id = 1');
          $this->widgetSchema['concurso_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Concurso'), 'add_empty' => 'Selecciona concurso', 'query' => $q));
          } elseif ($pieces[2] == "contribucion_product") {
          $q = Doctrine_Query::create()
          ->from('Concurso')
          ->where('concurso_tipo_id = 2');
          $this->widgetSchema['concurso_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Concurso'), 'add_empty' => 'Selecciona concurso', 'query' => $q));
          } else {
          $this->widgetSchema['concurso_id'] = new sfWidgetFormDoctrineDependentSelect(array('label' => 'Concurso', 'model' => $this->getRelatedModelName('Concurso'), 'depends' => 'ConcursoTipo', 'add_empty' => 'Selecciona concurso'));
          } */

        $this->widgetSchema['concurso_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'style' => 'width: 281px;'));
        $this->validatorSchema['concurso_id'] = new sfValidatorPass(array('required' => false));

        //$this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => 'Selecciona Usuario'));
        $this->widgetSchema['user_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 25, 'style' => 'width:176px !important;'));
        $this->validatorSchema['user_id'] = new sfValidatorPass(array('required' => false));

        $this->widgetSchema['destacado'] = new sfWidgetFormChoice(array('choices' => array('' => 'si o no', 1 => 'si', 0 => 'no')));
        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'with_empty' => false, 'template' => $i18n->__('Desde %from_date%<br />Hasta %to_date%')));
        $this->widgetSchema['concurso_tipo_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ConcursoTipo', 'add_empty' => 'Selecciona tipo de concurso'));

        $this->widgetSchema['empresa_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_40_c', 'style' => 'width: 225px !important;'));
        $this->validatorSchema['empresa_id'] = new sfValidatorPass(array('required' => false));

        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'States',
                    'add_empty' => $i18n->__('Selecciona provincia'),
                    'label' => 'Provincia',
                    'order_by' => array('orden', 'asc')
                        ),
                        array("style" => "width: 235px"));

        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'City',
                    'depends' => 'States',
                    'add_empty' => $i18n->__('Selecciona localidad'),
                        ),
                        array("style" => "width: 235px"));



        /* $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'States', 'add_empty' => 'Selecciona provincia'));
          //$this->widgetSchema['city_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'City', 'add_empty' => 'Selecciona localidad'));
          $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
          'label' => 'Localidad',
          'model' => 'City',
          'depends' => 'States',
          'add_empty' => 'Selecciona localidad',
          //'ajax' => true,
          ));
         */
        $this->widgetSchema['producto_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'style' => 'width: 225px !important;'));
        $this->validatorSchema['producto_id'] = new sfValidatorPass(array('required' => false));

        $this->widgetSchema['marca'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_40_c', 'style' => 'width: 225px !important;'));
        $this->widgetSchema['modelo'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 20, 'class' => 'tamano_40_c', 'style' => 'width: 142px !important;'));


        $this->validatorSchema['states_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['city_id'] = new sfValidatorPass(array('required' => false));

        $this->validatorSchema['marca'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['modelo'] = new sfValidatorPass();
        $this->validatorSchema['concurso_tipo_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'ConcursoTipo', 'column' => 'id'));
    }

    public function getFields() {
        $fields = parent::getFields();
        //the right 'virtual_column_name' is the method to filter
        $fields['concurso_tipo_id'] = 'concurso_tipo_id';
        $fields['empresa_id'] = 'empresa_id';
        $fields['states_id'] = 'states_id';
        $fields['city_id'] = 'city_id';
        $fields['producto_id'] = 'producto_id';
        $fields['marca'] = 'marca';
        $fields['modelo'] = 'modelo';
        return $fields;
    }

    public function addConcursoTipoIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere("co.concurso_tipo_id='$value'");
        return $query;
    }

    public function addUserIdColumnQuery($query, $field, $value) {
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

    public function addStatesIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere("co.states_id='$value'");
        return $query;
    }

    public function addCityIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere("co.city_id='$value'");

        return $query;
    }

    public function addMarcaColumnQuery($query, $field, $value) {
        //$rootAlias = $query->getRootAlias();
        $query->leftJoin("r.Concurso aa");
        $query->leftJoin("aa.Producto bb");
        $query->leftJoin("aa.Empresa em");
        $query->andWhere("bb.marca LIKE '%$value[text]%'");
        return $query;
    }

    public function addProductoIdColumnQuery($query, $field, $value) {
        $query->andWhere("bb.name LIKE '%$value[text]%'");
        return $query;
    }

    public function addEmpresaIdColumnQuery($query, $field, $value) {
        $query->leftJoin($query->getRootAlias() . ".Concurso aa");
        $query->leftJoin("aa.Empresa em");
        $query->andWhere("em.name LIKE '%$value[text]%'");
        return $query;
    }

    public function addConcursoIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->leftJoin($rootAlias . ".Concurso con");
        $query->andWhere("con.name LIKE '%$value[text]%'");
        return $query;
    }

    public function addModeloColumnQuery($query, $field, $value) {
        //$rootAlias = $query->getRootAlias();

        $query->leftJoin("r.Concurso cc");
        $query->leftJoin("cc.Producto dd");
        $query->andWhere("dd.modelo LIKE '%$value[text]%'");

        //echo $query;die;
        return $query;
    }

}
