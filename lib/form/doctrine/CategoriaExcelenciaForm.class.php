<?php

/**
 * CategoriaExcelencia form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CategoriaExcelenciaForm extends BaseCategoriaExcelenciaForm {

    public function configure() {

        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $this->widgetSchema['nombre']->setAttributes(array('maxlength' => 40, 'size' => 18));
        $this->widgetSchema['valor_min']->setAttributes(array('maxlength' => 10, 'class' => 'tamano_9_c_1'));
        $this->widgetSchema['valor_max']->setAttributes(array('maxlength' => 10, 'class' => 'tamano_9_c_1'));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'nombre' => new sfValidatorString(array('max_length' => 100, 'required' => true), array('required' => __('Necesitas incluir una medalla.'))),
            'valor_min' => new sfValidatorInteger(array('required' => true), array('required' => __('Necesitas incluir un valor mínimo.'), 'invalid' => __('Necesitas incluir un valor mínimo.'))),
            'valor_max' => new sfValidatorInteger(array('required' => true), array('required' => __('Necesitas incluir un valor máximo.'), 'invalid' => __('Necesitas incluir un valor máximo.'))),
        ));
    }

}