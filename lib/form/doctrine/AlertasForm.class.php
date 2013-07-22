<?php

/** AAA
 * Alertas form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AlertasForm extends BaseAlertasForm {

    public function configure() {
        //set widget
        $this->widgetSchema['type'] = new sfWidgetFormInputText(array(), array('maxlength' => 40, 'class' => 'tamano_20_c'));
        $this->widgetSchema['message'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'style' => 'width:284px'));

        //set validator
        $this->validatorSchema['type'] = new sfValidatorString(array('required' => true), array('required' => 'Necesitas incluir un tipo de alerta.'));
        $this->validatorSchema['message'] = new sfValidatorString(array('required' => true), array('required' => 'Necesitas incluir una descripción.'));
    }

}
