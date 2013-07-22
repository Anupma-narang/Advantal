<?php

/**
 * AdministrationCaja form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AdministrationCajaForm extends BaseAdministrationCajaForm {

    public function configure() {
        parent::configure();
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $this->widgetSchema['expiry_date'] = new sfWidgetFormInputText(array(), array('maxlength' => 4, 'class' => 'tamano_4_c'));
        $this->widgetSchema['points_per_cent'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'class' => 'tamano_3_c'));
        $this->setValidators(array(
            'id' => new sfValidatorInteger(array('required' => false)),
            'expiry_date' => new sfValidatorInteger(array('required' => true), array('required' => __('Necesitas incluir una fecha de caducidad de caja.'),
                'invalid' => __('Sólo puedes introducir números.'))),
            'points_per_cent' => new sfValidatorInteger(array('required' => true), array('required' => __('Necesitas incluir la conversión de puntos por céntimo.'),
                'invalid' => __('Sólo puedes introducir números.'))),
        ));
        $this->widgetSchema->setNameFormat('admin_caja_form[%s]');
        $this->setDefaults(array('expiry_date' => 183, 'points_per_cent' => '1'));
    }

}
