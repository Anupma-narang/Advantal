<?php

/**
 * UserProductCaseStudy filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserProductCaseStudyFormFilter extends BaseUserProductCaseStudyFormFilter {

    public function configure() {
        //set status array
        $status_array = array('' => 'Selecciona estado', '1' => 'Revista ', '2' => 'Tramitado', '3' => 'Cerrado');

        $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['marca'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['modelo'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 20, 'style' => 'width: 141px;'));
        $this->widgetSchema['user_name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 25, 'class' => 'tamano_25_c'));
        $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => $status_array, 'label' => 'Estado'));
        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoUno',
                    'order_by' => array('orden', 'asc'),
                    'add_empty' => 'Selecciona sector',
                    'label' => 'Sector del producto'
                ));

        $this->widgetSchema['producto_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoDos',
                    'depends' => 'ProductoTipoUno',
                    'add_empty' => 'Selecciona subsector',
                    'label' => 'Subsector del producto'
                ));

        $this->widgetSchema['producto_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoTres',
                    'depends' => 'ProductoTipoDos',
                    'add_empty' => 'Selecciona tipo de producto',
                    'label' => 'Tipo de producto'
                ));

        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'template' => 'Desde %from_date%<br />Hasta %to_date%', 'with_empty' => false));

        $this->setValidators(array(
            'user_name' => new sfValidatorPass(array('required' => false)),
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
    }

    public function addStatusColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != 'null') {
            $query->addWhere($query->getRootAlias() . '.status = ?', $values);
        }
    }

}
