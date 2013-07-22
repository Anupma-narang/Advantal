<?php

/**
 * RecomendedRegistration form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RecomendedRegistrationForm extends BaseRecomendedRegistrationForm {

    public function configure() {
        $this->widgetSchema['registered_user_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('registeredGaurdUser'), 'add_empty' => 'Selecciona Usuario'));
        $this->widgetSchema['recomended_user'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('recomendedGaurdUser'), 'add_empty' => 'Selecciona Usuario'));

        $this->validatorSchema['registered_user_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('registeredGaurdUser'), 'required' => true), array('required' => 'Necesitas seleccionar un Usuario.'));
        $this->validatorSchema['recomended_user'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('recomendedGaurdUser'), 'required' => true), array('required' => 'Necesitas seleccionar un Usuario.'));
        unset($this['created_at'], $this['updated_at']);
    }

}
