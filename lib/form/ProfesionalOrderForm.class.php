<?php

/**
 *
 * @package    symfony
 * @subpackage form
 */
class ProfesionalOrderForm extends BaseForm {

    public function configure() {
        parent::configure();

        $order_choices = array('profesional' => 'Profesional', 'provincia' => 'Provincia', 'localidad' => 'Localidad');

        $this->widgetSchema['order'] = new sfWidgetFormChoice(array(
                    'choices' => $order_choices
                ));

        $this->validatorSchema['order'] = new sfValidatorChoice(array(
                    'choices' => array_keys($order_choices)
                ));


        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'States',
                    'order_by' => array('orden', 'asc'),
                    'add_empty' => 'Selecciona provincia')
        );

        $this->validatorSchema['states_id'] = new sfValidatorDoctrineChoice(array('model' => 'States', 'required' => false));

        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'City',
                    'depends' => 'States',
                    'add_empty' => 'Selecciona localidad',
                    'ajax' => true), array(
                ));
        $this->widgetSchema['name'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['name'] = new sfValidatorString(array('required' => false));

        $this->widgetSchema['last_name_one'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['last_name_one'] = new sfValidatorString(array('required' => false));

        $this->widgetSchema['last_name_two'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['last_name_two'] = new sfValidatorString(array('required' => false));

        $this->validatorSchema['city_id'] = new sfValidatorDoctrineChoice(array('model' => 'City', 'required' => false));

        $this->disableLocalCSRFProtection();

        $this->validatorSchema['localidad_id'] = new sfValidatorPass(array('required' => false));
        $this->widgetSchema->setNameFormat('orderForm[%s]');
    }

}
