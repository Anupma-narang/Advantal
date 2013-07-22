<?php

/**
 * PizarraSection form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PizarraSectionForm extends BasePizarraSectionForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $this->setWidgets(array(
            'name' => new sfWidgetFormInputText(array(), array('maxlength' => 40, 'class' => 'tamano_20_c')),
            'module' => new sfWidgetFormInputText(array(), array('maxlength' => 40, 'class' => 'tamano_20_c')),
            'action' => new sfWidgetFormInputText(array(), array('maxlength' => 40, 'class' => 'tamano_20_c')),
            'short_name' => new sfWidgetFormInputText(array(), array('maxlength' => 40, 'class' => 'tamano_20_c')),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'name' => new sfValidatorString(array('required' => true), array('required' => __('Este campo es obligatorio.'))),
            'module' => new sfValidatorString(array('required' => true), array('required' => __('Este campo es obligatorio.'))),
            'action' => new sfValidatorString(array('required' => true), array('required' => __('Este campo es obligatorio.'))),
            'short_name' => new sfValidatorString(array('required' => true), array('required' => __('Este campo es obligatorio.'))),
            'created_at' => new sfValidatorDateTime(array('required' => false)),
            'updated_at' => new sfValidatorDateTime(array('required' => false)),
        ));
        $this->widgetSchema->setNameFormat('pizarra_section[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();
    }

}
