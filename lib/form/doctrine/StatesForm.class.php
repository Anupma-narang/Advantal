<?php

/**
 * States form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class StatesForm extends BaseStatesForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $this->getWidgetSchema()->moveField('orden', sfWidgetFormSchema::BEFORE, 'name');

        $this->widgetSchema['orden'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'class' => 'tamano_3_c'));
        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 40, 'class' => 'tamano_20_c'));

        $this->validatorSchema['orden'] = new sfValidatorAnd(array(
                ), array(), array('required' => __('Necesitas incluir un orden.')));
        $this->validatorSchema['name'] = new sfValidatorAnd(array(
                ), array(), array('required' => __('Necesitas incluir una provincia.')));
    }

}
