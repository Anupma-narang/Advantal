<?php

/**
 * PlanesDeAccionProducto filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PlanesDeAccionProductoFormFilter extends BaseContribucionFormFilter {

    public function configure() {
        $i18n = sfContext::getInstance()->getI18N();
        $i18n = sfContext::getInstance()->getI18N();
        $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_40_c'));
        //$this->widgetSchema['concurso_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Concurso'), 'add_empty' => 'Selecciona Concurso'));
        $q = Doctrine_Query::create()
                ->from('Concurso')
                ->where('concurso_tipo_id = 2');

        //  $this->widgetSchema['concurso_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Concurso', 'add_empty' => 'Selecciona concurso', 'query' => $q));
        $this->widgetSchema['concurso_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'style' => 'width:281px !important;'));
        $this->validatorSchema['concurso_id'] = new sfValidatorPass(array('required' => false));

        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'with_empty' => false, 'template' => $i18n->__('Desde %from_date%<br />Hasta %to_date%')));
        $q = Doctrine_Query::create()
                ->from('ConcursoEstado')
                ->where('id != 1');
        $this->widgetSchema['concurso_estado'] = new sfWidgetFormDoctrineChoice(array('model' => 'ConcursoEstado', 'add_empty' => 'Selecciona estado', 'query' => $q));

        $this->widgetSchema['user_id'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 25, 'style' => 'width: 176px;'));
        $this->validatorSchema['user_id'] = new sfValidatorPass(array('required' => false));

        $q = Doctrine_Query::create()
                ->from('ConcursoCategoria')
                ->where('concurso_tipo_id = 2');
        $this->widgetSchema['concurso_categoria'] = new sfWidgetFormDoctrineChoice(array('model' => 'ConcursoCategoria', 'add_empty' => 'Selecciona categoría', 'query' => $q));
        $this->widgetSchema['concurso_producto'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'style' => 'width:225px !important'));
        $this->widgetSchema['concurso_producto_marca'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'style' => 'width:225px !important'));
        $this->widgetSchema['concurso_producto_modelo'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 20, 'style' => 'width:140px !important'));
        //  $this->widgetSchema['tipo_de_producto'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'style' => 'width:282px !important'));
        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoUno',
                    'order_by' => array('orden', 'asc'),
                    'label' => 'Sector del producto',
                    'add_empty' => 'Selecciona sector'));
        $this->widgetSchema['producto_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoDos',
                    'depends' => 'ProductoTipoUno',
                    'label' => 'Subsector del producto',
                    'add_empty' => 'Selecciona subsector'));

        $this->widgetSchema['producto_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoTres',
                    'depends' => 'ProductoTipoDos',
                    'label' => 'Tipo de producto',
                    'add_empty' => 'Selecciona tipo de producto'));

        /* $this->widgetSchema['concurso_producto'] = new sfWidgetFormDoctrineChoice(array('model' => 'Producto', 'add_empty' => 'Selecciona producto'));
          $this->widgetSchema['concurso_producto_marca'] = new sfWidgetFormInputText();
          $this->widgetSchema['concurso_producto_tipo'] = new sfWidgetFormInputText(); */


        $this->validatorSchema['concurso_estado'] = new sfValidatorPass();
        $this->validatorSchema['concurso_categoria'] = new sfValidatorPass();
        $this->validatorSchema['concurso_producto'] = new sfValidatorPass();
        $this->validatorSchema['concurso_producto_marca'] = new sfValidatorPass();
        $this->validatorSchema['concurso_producto_modelo'] = new sfValidatorPass();
        $this->validatorSchema['producto_tipo_uno_id'] = new sfValidatorPass();
        $this->validatorSchema['producto_tipo_dos_id'] = new sfValidatorPass();
        $this->validatorSchema['producto_tipo_tres_id'] = new sfValidatorPass();
        //$this->validatorSchema['concurso_producto'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Producto', 'column' => 'id'));
        //$this->validatorSchema['concurso_producto_marca'] = new sfValidatorString(array('required'=>false));
    }

    public function getFields() {
        $fields = parent::getFields();

        //the right 'virtual_column_name' is the method to filter
        $fields['concurso_id'] = 'concurso_id';
        $fields['concurso_estado'] = 'concurso_estado';
        $fields['concurso_categoria'] = 'concurso_categoria';
        $fields['concurso_producto'] = 'concurso_producto';
        $fields['concurso_producto_marca'] = 'concurso_producto_marca';
        $fields['concurso_producto_modelo'] = 'concurso_producto_modelo';
        $fields['tipo_de_producto'] = 'tipo_de_producto';

        return $fields;
    }

    public function addConcursoIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->leftJoin($rootAlias . ".Concurso con");
        $query->andWhere("con.name LIKE '%$value[text]%'");
        return $query;
    }

    public function addConcursoEstadoColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere("co.concurso_estado_id='$value'");
        //echo $query;die;
        return $query;
    }

    public function addConcursoCategoriaColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere("co.concurso_categoria_id='$value'");
        //echo $query;die;
        return $query;
    }

    public function addConcursoProductoColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere("p.name LIKE '%$value[text]%'");

        return $query;
    }

    public function addConcursoProductoMarcaColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere("p.marca LIKE '%$value[text]%'");
        //echo $query;die;
        return $query;
    }

    public function addConcursoProductoModeloColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->andWhere("p.modelo LIKE '%$value[text]%'");
        //echo $query;
        return $query;
    }

    /*  public function addTipoDeProductoColumnQuery($query, $field, $value) {
      $rootAlias = $query->getRootAlias();
      $query->leftJoin("r.Concurso cc");

      $query->leftJoin("cc.Producto pt");

      $query->leftJoin("pt.ProductoTipoTres ptt");
      $query->andWhere("ptt.name LIKE '%$value[text]%'");
      //echo $query;die;
      return $query;
      } */

    public function addProductoTipoUnoIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->leftJoin("r.Concurso ccs");

        $query->leftJoin("ccs.Producto ets");

        $query->leftJoin("ets.ProductoTipoUno esta");
        $query->addWhere('esta.id = ?', $value);
        //echo $query;die;
        return $query;
    }

    public function addProductoTipoDodIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->leftJoin("r.Concurso cs");

        $query->leftJoin("cs.Producto ete");

        $query->leftJoin("ete.ProductoTipoDos est");
        $query->addWhere('est.id = ?', $value);
        //  echo $query;die;
        return $query;
    }

    public function addProductoTipoTresIdColumnQuery($query, $field, $value) {
        $rootAlias = $query->getRootAlias();
        $query->leftJoin("r.Concurso cc");

        $query->leftJoin("cc.Producto eta");

        $query->leftJoin("eta.ProductoTipoTres east");
        $query->addWhere('east.id = ?', $value);
        //echo $query;die;
        return $query;
    }

    /* public function addConcursoProductoMarcaColumnQuery($query, $field, $value)
      {
      $rootAlias = $query->getRootAlias();
      $query->andWhere("p.marca='$value'");

      return $query;
      } */

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

}
