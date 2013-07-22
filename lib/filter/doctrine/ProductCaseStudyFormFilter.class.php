<?php

/**
 * ProductCaseStudy filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductCaseStudyFormFilter extends BaseProductCaseStudyFormFilter {

    public function configure() {
        //set status array
        $status_array = array('1' => 'Revista ',
            '2' => 'Tramitado',
            '3' => 'Cerrado');

        //get marca records
        $product_marca_array = Doctrine::getTable('Producto')->getMarcaRecords();
        //get modelo records
        $product_modelo_array = Doctrine::getTable('Producto')->getModeloRecords();
        $product_names_array = Doctrine::getTable('Producto')->getAllProductNames();

        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => $status_array, 'label' => 'Estado'));
        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoUno',
                    'order_by' => array('orden', 'asc'),
                    'add_empty' => 'Selecciona sector'));


        $this->widgetSchema['producto_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoDos',
                    'depends' => 'ProductoTipoUno',
                    'ajax' => true,
                    'add_empty' => 'Selecciona subsector'));

        $this->widgetSchema['producto_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoTres',
                    'depends' => 'ProductoTipoDos',
                    'ajax' => true,
                    'add_empty' => 'Selecciona tipo de producto'));


// @author Joan Teixidó Yo esto no lo pondría aquí pero alguien lo metió aquí o sea que aquí se queda.
        $choices = array(0 => 'Pendiente de revisar', 1 => 'Revisada');

        $this->widgetSchema['marca'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->widgetSchema['modelo'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_20_c', 'maxlength' => 20));

        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'template' => 'Desde %from_date%<br />Hasta %to_date%', 'with_empty' => false));

        $this->setValidators(array(
            'status' => new sfValidatorChoice(array('choices' => array(1, 2, 3), 'required' => false)),
            'name' => new sfValidatorPass(array('required' => false)),
            'marca' => new sfValidatorPass(array('required' => false)),
            'modelo' => new sfValidatorPass(array('required' => false)),
            'producto_tipo_uno_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProductoTipoUno'), 'column' => 'id')),
            'producto_tipo_dos_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProductoTipoDos'), 'column' => 'id')),
            'producto_tipo_tres_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProductoTipoTres'), 'column' => 'id')),
            'description' => new sfValidatorPass(array('required' => false)),
            'summary' => new sfValidatorPass(array('required' => false)),
            'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
        ));

        $this->widgetSchema->setLabels(array(
            'name' => 'Producto',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'producto_tipo_uno_id' => 'Sector del producto',
            'producto_tipo_dos_id' => 'Subsector',
            'producto_tipo_tres_id' => 'Tipo de producto',
        ));
    }

    public function addStatusColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != 'null') {
            $query->addWhere($query->getRootAlias() . '.status = ?', $values);
        }
    }

    public function addNameColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != 'null') {
            $query->addWhere($query->getRootAlias() . ".name LIKE '%$values%'");
        }
    }
    public function addMarcaColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != 'null') {
            $query->addWhere($query->getRootAlias() . ".marca LIKE '%$values%'");
        }
    }
    public function addModeloColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != 'null') {
            $query->addWhere($query->getRootAlias() . ".modelo LIKE '%$values%'");
        }
    }

}