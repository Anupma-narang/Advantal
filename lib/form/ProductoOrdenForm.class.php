<?php
/**
 *
 * @package    symfony
 * @subpackage form
 */
class ProductoOrderForm extends BaseForm
{
    public function configure()
    {
        parent::configure();

        sfApplicationConfiguration::getActive()->loadHelpers(array('Url'));

        $order_choices = array('producto' => 'Tipo de producto', 'marca' => 'Marca', 'modelo' => 'Modelo');

        $this->widgetSchema['order'] = new sfWidgetFormChoice(array(
            'choices' => $order_choices
        ));

        $this->validatorSchema['order'] = new sfValidatorChoice(array(
            'choices' => array_keys($order_choices)
        ));

        $this->widgetSchema['marca'] = new audWidgetFormJQueryAutocompleterInField(array(
                'url' => url_for('@producto_autocomplete?field=marca')

            ), array(
                'placeholder' => 'Marca'
            )
        );
        $this->validatorSchema['marca'] = new sfValidatorString(array(
            'required' => false
        ));

        $this->widgetSchema['modelo'] = new audWidgetFormJQueryAutocompleterInField(array(
            'url' => url_for('@producto_autocomplete?field=modelo'),
        ), array(
            'placeholder' => 'Modelo'
        ));
        $this->validatorSchema['modelo'] = new sfValidatorString(array(
            'required' => false
        ));

        $this->widgetSchema['name'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['name'] = new sfValidatorString(array('required' => false));

        $this->disableLocalCSRFProtection();
        $this->widgetSchema->setNameFormat('orderForm[%s]');
    }
}