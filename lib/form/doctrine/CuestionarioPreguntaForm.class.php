<?php

/**
 * CuestionarioPregunta form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CuestionarioPreguntaForm extends BaseCuestionarioPreguntaForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $this->widgetSchema['label'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_40_c'));


        $this->validatorSchema['created_at'] = new sfValidatorDateTime(array('required' => false));
        $this->validatorSchema['updated_at'] = new sfValidatorDateTime(array('required' => false));
        $this->validatorSchema['label'] = new sfValidatorAnd(array(
                ), array(), array('required' => __('Necesitas incluir una pregunta.'), 'invalid' => __('Necesitas incluir una pregunta.')));
    }

}
