<?php

/**
 * ProductoTipoTres form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductoTipoTresForm extends BaseProductoTipoTresForm {

    public function configure() {
        unset($this['slug'], $this['image']);
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => 'ProductoTipoUno',
            'order_by' => array('orden'),
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
            'add_empty' => 'Selecciona un producto'));

        $this->widgetSchema['orden'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'class' => 'tamano_3_c'));
        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'style' => 'width:495px'));

        $this->validatorSchema['orden'] = new sfValidatorAnd(array(
                ), array(), array('required' => __('Necesitas incluir un orden.'), 'invalid' => __('Necesitas incluir un orden.')));
        $this->validatorSchema['name'] = new sfValidatorAnd(array(
                ), array(), array('required' => __('Necesitas incluir un tipo de producto.'), 'invalid' => __('Necesitas incluir un tipo de producto.')));

        $this->validatorSchema['producto_tipo_uno_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoUno'), 'required' => true), array('required' => __('Necesitas seleccionar un sector.')));
        $this->validatorSchema['producto_tipo_dos_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoDos'), 'required' => true), array('required' => __('Necesitas seleccionar un subsector.')));
    }

}
