<?php

/**
 * Producto form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductoAdminForm extends ProductoForm {

    public function configure() {
        unset(
                $this['slug']
        );

        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => 'ProductoTipoUno',
            'order_by' => array('orden', 'asc'),
            'add_empty' => 'Selecciona un producto'));
        $this->widgetSchema['telefono']->setAttribute('maxlength', 9);
        $this->validatorSchema['telefono'] = new sfValidatorRegex(array(
            'pattern' => '#^(\d{9})$#',
            'required' => false
                ), array('invalid' => 'Ese teléfono no es válido.')
        );
        $this->widgetSchema['producto_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProductoTipoDos',
            'depends' => 'ProductoTipoUno',
            'ajax' => true,
            'add_empty' => 'Selecciona un producto'));

        $this->widgetSchema['producto_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProductoTipoTres',
            'depends' => 'ProductoTipoDos',
            'ajax' => true,
            'add_empty' => 'Selecciona tipo de producto'));

        $this->widgetSchema->setLabels(
                array(
                    'name' => 'Producto',
                    'producto_tipo_uno_id' => 'Sector del producto',
                    'producto_tipo_dos_id' => 'Subsector del producto',
                    'producto_tipo_tres_id' => 'Tipo de producto'
        ));
    }

}
