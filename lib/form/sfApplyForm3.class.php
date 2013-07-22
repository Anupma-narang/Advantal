<?php

class sfApplyForm3 extends UserNotificationForm {

    public function configure() {
        parent::configure();

        $this->widgetSchema->setNameFormat(get_class($this).'[%s]');

        $this->widgetSchema['acept_conditions'] = new sfWidgetFormInputCheckbox();
        $this->widgetSchema->setLabel('acept_conditions', __('He leído y acepto los términos y condiciones de servicio de auditoscopia*'));
        $this->validatorSchema['acept_conditions'] = new sfValidatorBoolean(array('required' => true),array('required' => __('Necesitas aceptar nuestros términos y condiciones de servicio.')));
        $this->disableLocalCSRFProtection();
    }
    public function resetErrorSchema()
    {
    }
}
