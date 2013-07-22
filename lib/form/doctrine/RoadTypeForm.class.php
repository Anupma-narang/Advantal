<?php

/**
 * RoadType form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RoadTypeForm extends BaseRoadTypeForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        unset($this["value"], $this["created_at"], $this["updated_at"]);

        $this->widgetSchema['orden'] = new sfWidgetFormInputText(array(), array('size' => 3, 'maxlength' => 3, 'class' => 'tamano_3_c'));

        $this->widgetSchema->setLabels(array(
            'name' => 'Tipo de vía'
        ));

        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 40, 'class' => 'tamano_20_c'));

        $this->validatorSchema['orden'] = new sfValidatorAnd(array(
                ), array(), array('required' => __('Necesitas incluir un orden.')));
        $this->validatorSchema['name'] = new sfValidatorAnd(array(
                ), array(), array('required' => __('Necesitas incluir un tipo de vía.')));
    }

}

