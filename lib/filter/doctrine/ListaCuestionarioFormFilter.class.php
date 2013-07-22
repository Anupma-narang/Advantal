<?php

/**
 * ListaCuestionario filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ListaCuestionarioFormFilter extends BaseListaCuestionarioFormFilter {

    public function configure() {
        sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));
        if (sfContext::getInstance()->getModuleName() == 'cuestionarioProducto') {
            $width = 'width:351px !important;';
        } else {
            $width = 'width:225px !important;';
        }
        $this->widgetSchema['nombre']->setAttributes(array('maxlength' => 70, 'style' => $width));

        $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate
                        (array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false, 'template' => 'Desde %from_date%<br />Hasta %to_date%'));

        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoUno',
                    'order_by' => array('orden', 'asc'),
                    'add_empty' => 'Selecciona sector',
                    'label' => 'Sector'));

        $this->widgetSchema['producto_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoDos',
                    'depends' => 'ProductoTipoUno',
                    'add_empty' => 'Selecciona subsector',
                    'label' => 'Subsector'));

        $this->widgetSchema['producto_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoTres',
                    'depends' => 'ProductoTipoDos',
                    'add_empty' => 'Selecciona tipo de producto',
                    'label' => 'Tipo'));

        $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Sector',
                    'model' => 'EmpresaSectorUno',
                    'order_by' => 'orden',
                    'add_empty' => __('Selecciona sector')));

        $this->widgetSchema['empresa_sector_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Subsector',
                    'model' => 'EmpresaSectorDos',
                    'order_by' => 'orden',
                    'depends' => 'EmpresaSectorUno',
                    'add_empty' => __('Selecciona subsector')));

        $this->widgetSchema['empresa_sector_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Actividad',
                    'model' => 'EmpresaSectorTres',
                    'order_by' => 'orden',
                    'depends' => 'EmpresaSectorDos',
                    'add_empty' => __('Selecciona actividad')));
    }

    public function addNombreColumnQuery(Doctrine_Query $query, $field, $values) {
        if ($values != 'null')
            $query->andWhere($query->getRootAlias() . '.nombre LIKE  ?', '%' . $values['text'] . '%');
    }

}