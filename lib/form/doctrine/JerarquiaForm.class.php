<?php

/**
 * Jerarquia form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class JerarquiaForm extends BaseJerarquiaForm {

    public function configure() {
        parent::configure();
        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => '20', 'class' => 'tamano_20_c'));
        $this->widgetSchema['points'] = new sfWidgetFormInputText(array(), array('maxlength' => '10', 'class' => 'tamano_10_c'));

        $this->validatorSchema['name'] = new sfValidatorString(array('required' => true), array('required' => 'Necesitas incluir una Jerarquía.', 'invalid' => 'Ese número no es válido.'));
        $this->validatorSchema['points'] = new sfValidatorCaja(array('required' => true), array('required' => 'Necesitas asignar los puntos necesarios para alcanzar esta Jerarquía.', 'invalid' => 'Necesitas asignar los puntos necesarios para alcanzar esta Jerarquía.'));
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidate'))));
    }

    public function postValidate($validator, $values) {
        if ($values['name']) {
            $match_string = 'abcdefghijklmnopqrstuvwxyz0123456789 ';
            $spanish_string = '`´¨–‘áàäéèëíìïóòöúùüçñáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜâêîôûÂÊÎÔÛãõÃÕåÅÑÇ-';
            $search_array = str_split($values['name']);

            foreach ($search_array as $index => $char) {

                if (strpos($match_string, strtolower($char)) === FALSE && strpos($spanish_string, $char) === FALSE) {
                    $invalid = new sfValidatorError($validator, 'Esa Jerarquía no es válida.');
                    throw new sfValidatorErrorSchema($validator, array('name' => $invalid));
                }
            }
        }
        return $values;
    }

}
