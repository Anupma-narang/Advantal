<?php

/**
 * ColaboradorPuntoDefinicion form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ColaboradorPuntoDefinicionForm extends BaseColaboradorPuntoDefinicionForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

        $this->widgetSchema['codigo'] = new sfWidgetFormInputText(array(), array('maxlength' => 40, 'class' => 'tamano_20_c'));
        $this->widgetSchema['descripcion'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_40_c'));
        $this->widgetSchema['puntos'] = new sfWidgetFormInputText(array(), array('maxlength' => 10, 'class' => 'tamano_10_c'));

        $this->validatorSchema['puntos'] = new sfValidatorNumber(array('required' => true), array('required' => 'Necesitas incluir el número de puntos.', 'invalid' => 'Necesitas introducir un número.'));
        $this->validatorSchema['descripcion'] = new sfValidatorAnd(array(
                ), array(), array('required' => __('Necesitas incluir una descripción.'), 'invalid' => __('Necesitas incluir una descripción.')));
        $this->validatorSchema['codigo'] = new sfValidatorAnd(array(
                ), array(), array('required' => __('Necesitas incluir un código.'), 'invalid' => __('Necesitas incluir un código.')));

        /* $this->validatorSchema['codigo'] = new sfValidatorAnd(array(
          new sfValidatorString(array('required' => true), array('required' => __('Necesitas incluir un código.'), 'invalid' => __('Necesitas incluir un código.'))),
          new sfValidatorDoctrineUnique(array(
          'model' => 'ColaboradorPuntoDefinicion',
          'column' => 'codigo'
          ), array('invalid' => 'Ese código ya está en uso.')))
          ); */

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'ColaboradorPuntoDefinicion', 'column' => array('codigo')), array('invalid' => 'Ese código ya está en uso.'))
        );
    }

}
