<?php

/**
 * ProductoTipoDos form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductoTipoDosForm extends BaseProductoTipoDosForm {

    public function configure() {
        unset($this['slug'], $this['image']);
        $this->widgetSchema['orden'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'class' => 'tamano_3_c'));
        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'style' => 'width:495px'));

        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('ProductoTipoUno'),
            'add_empty' => 'Selecciona sector',
        ));

        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $this->validatorSchema['orden'] = new sfValidatorAnd(array(
                ), array(), array('required' => __('Necesitas incluir un orden.'), 'invalid' => __('Necesitas incluir un orden.')));

        $this->validatorSchema['producto_tipo_uno_id'] = new sfValidatorAnd(array(
                ), array(), array('required' => __('Necesitas seleccionar un sector.'), 'invalid' => __('Necesitas seleccionar un sector.')));

        $this->validatorSchema['name'] = new sfValidatorAnd(array(
                ), array(), array('required' => __('Necesitas incluir un subsector del producto.'), 'invalid' => __('Necesitas incluir un subsector del producto.')));
    }

}
