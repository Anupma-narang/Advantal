<?php

/**
 * Recomienda form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));

class RecomiendaForm extends BaseRecomiendaForm {

    public function configure() {
        $usuario = $this->getOption('usuario');
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden(array('default' => ($usuario->isAuthenticated()) ? $usuario->getGuardUser()->getId() : ''), array('maxlength' => 70, 'class' => 'tamano_32_c ' . ($usuario->isAuthenticated() ? ' cgr1-color' : ''), 'readonly' => ($usuario->isAuthenticated() ? 'readonly' : '')));
        $this->widgetSchema['nombre'] = new sfWidgetFormInput(array('default' => ($usuario->isAuthenticated()) ? $usuario : ''), array('maxlength' => 70, 'class' => 'tamano_32_c' . ($usuario->isAuthenticated() ? ' cgr1-color' : ''), 'readonly' => ($usuario->isAuthenticated() ? 'readonly' : '')));
        $this->widgetSchema['apellido1'] = new sfWidgetFormInput(array('default' => ($usuario->isAuthenticated()) ? $usuario->getProfile()->getSurname1() : ''), array('maxlength' => 70, 'class' => 'tamano_32_c' . ($usuario->isAuthenticated() ? ' cgr1-color' : ''), 'readonly' => ($usuario->isAuthenticated() ? 'readonly' : '')));
        $this->widgetSchema['apellido2'] = new sfWidgetFormInput(array('default' => ($usuario->isAuthenticated()) ? $usuario->getProfile()->getSurname2() : ''), array('maxlength' => 70, 'class' => 'tamano_32_c' . ($usuario->isAuthenticated() ? ' cgr1-color' : ''), 'readonly' => ($usuario->isAuthenticated() ? 'readonly' : '')));
        $this->widgetSchema['email'] = new sfWidgetFormInput(array('default' => ($usuario->isAuthenticated()) ? $usuario->getGuardUser()->getEmailAddress() : ''), array('maxlength' => 70, 'class' => 'tamano_32_c' . ($usuario->isAuthenticated() ? ' cgr1-color' : ''), 'readonly' => ($usuario->isAuthenticated() ? 'readonly' : '')));
        $this->widgetSchema['created_at'] = new sfWidgetFormDateTime();
        $this->widgetSchema['message'] = new sfWidgetFormTextareaCKEditor(array('width'=>600, 'height' => 200, 'max_length' => 3000, 'err_id' => 'max_length_error'));

        //set friend's name & email input widget
        for ($count = 1; $count <= 10; $count++) {
            $this->widgetSchema['user_name_' . $count] = new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
            $this->widgetSchema['user_email_' . $count] = new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        }




        $this->validatorSchema['user_id'] = new sfValidatorInteger(array('required' => false));

        $this->validatorSchema['nombre'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'min_length' => 2, 'required' => true), array('required' => __('Necesitas incluir tu nombre.'), 'invalid' => __('Ese nombre no es válido.'))),
            new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array(), array('required' => __('Necesitas incluir tu nombre.'), 'invalid' => __('Ese nombre no es válido.')));

        $this->validatorSchema['apellido1'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'min_length' => 2), array('required' => 'Necesitas incluir tu primer apellido.', 'invalid' => 'Ese apellido no es válido.')),
            new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', "ñ", 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array(), array('required' => __('Necesitas incluir tu primer apellido.'), 'invalid' => __('Ese apellido no es válido.')));

        $this->validatorSchema['apellido2'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'min_length' => 2), array('required' => 'Necesitas incluir tu segundo apellido.', 'invalid' => 'Ese apellido no es válido.')),
            new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', "ñ", 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array(), array('required' => __('Necesitas incluir tu segundo apellido.'), 'invalid' => __('Ese apellido no es válido.')));

        $this->validatorSchema['email'] = new sfValidatorEmail(array('required' => true), array('required' => 'Necesitas incluir tu correo electrónico.',
            'invalid' => 'Ese correo electrónico no es válido.'));

        $this->validatorSchema['created_at'] = new sfValidatorDateTime(array('required' => false));

        $this->validatorSchema['message'] = new mySfValidatorString(array('required' => false), array('max_length' => __('Has superado el espacio permitido para tu mensaje.')));

        //set friend's name & email input validation
        for ($count = 1; $count <= 10; $count++) {
            $this->validatorSchema['user_name_' . $count] = new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 70, 'min_length' => 2, 'required' => false), array('required' => __('Necesitas incluir el nombre de tu amigo.'), 'invalid' => __('Ese nombre no es válido.'))),
                new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array('required' => false), array('required' => __('Necesitas incluir el nombre de tu amigo.'), 'invalid' => __('Ese nombre no es válido.')));

            $this->validatorSchema['user_email_' . $count] = new sfValidatorEmail(array('required' => false), array('invalid' => 'Ese correo electrónico no es válido.'));
        }

        $this->validatorSchema->setPreValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidate'))));

        $this->widgetSchema->setNameFormat('recomienda[%s]');
        //set labels
        $this->widgetSchema->setLabels(array(
            'nombre' => 'Tu nombre*',
            'apellido1' => 'Tu apellido 1*',
            'apellido2' => 'Tu apellido 2*',
            'email' => 'Tu correo electrónico*',
        ));
    }

    /**
     * Perform validation
     * @param type $validator
     * @param type $values
     * @return type
     * @throws sfValidatorErrorSchema
     */
    public function postValidate($validator, $values) {
        $result_count = 0;
        $error_count = 0;
        $error_array = array();

        for ($count = 1; $count <= 10; $count++) {
            if ($values['user_name_' . $count] == '' && $values['user_email_' . $count] != '') {
                $invalid = new sfValidatorError($validator, 'Necesitas incluir el nombre de tu amigo.');
                $error_array['user_name_' . $count] = $invalid;
                $error_count++;
            } elseif ($values['user_name_' . $count] != '' && $values['user_email_' . $count] == '') {
                $invalid = new sfValidatorError($validator, 'Necesitas incluir el correo electrónico de tu amigo.');
                $error_array['user_email_' . $count] = $invalid;
                $error_count++;
            }
            if ($values['user_name_' . $count] != '' && $values['user_email_' . $count] != '') {
                $result_count++;
            }

            if ($values['user_email_' . $count]) {
                //if user allready exist the throw error
                $user_record = Doctrine::getTable('sfGuardUser')->getUserByEmail($values['user_email_' . $count]);
                if (!empty($user_record)) {
                    $invalid = new sfValidatorError($validator, 'Ese correo electrónico lo está usando ya otro colaborador.');
                    $error_array['user_email_' . $count] = $invalid;
                    $error_count++;
                }
            }
        }

        //throw error message if exist
        if ($error_count) {
            throw new sfValidatorErrorSchema($validator, $error_array);
        }

        //if starting fields are empty then throw error messages
        if ($result_count == 0) {
            $invalid_name = new sfValidatorError($validator, 'Necesitas incluir el nombre de tu amigo.');
            $invalid_email = new sfValidatorError($validator, 'Necesitas incluir el correo electrónico de tu amigo.');
            throw new sfValidatorErrorSchema($validator, array('user_email_' . 1 => $invalid_email, 'user_name_' . 1 => $invalid_name));
        }
        return $values;
    }

}

