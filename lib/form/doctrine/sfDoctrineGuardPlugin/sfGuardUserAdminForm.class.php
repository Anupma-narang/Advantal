<?php

class sfGuardUserAdminForm extends BasesfGuardUserAdminForm {

    static private $caracteres_no_validos_username = array(
        'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
        'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω',
        'ϊ', 'ϋ', 'ύ', 'ώ', 'Б', 'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы',
        'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п', 'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю',
        'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ', 'Ѵ', 'ѵ', 'Ґ', 'ґ',
        'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '•', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '←', '↑', '→', '↓', '↔',
        '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−', '√', '∞', '∫', '≈', '◊', '⅓',
        '⅔', '⅕', '⅖', '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', 'Ø', '©', '¶', '℮', '¼', '½', '¾', 'µ'
    );

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

        $this->widgetSchema['email_address'] = new sfWidgetFormInput(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->widgetSchema['email_address_again'] = new sfWidgetFormInput(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->widgetSchema['username'] = new sfWidgetFormInput(array(), array('class' => 'tamano_32_c', 'maxlength' => 32));
        $this->widgetSchema['password'] = new sfWidgetFormInputPassword(array(), array('maxlength' => 16, 'class' => 'tamano_16_c'));
        $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword(array(), array('maxlength' => 16, 'class' => 'tamano_16_c'));

        $this->widgetSchema['permissions_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => false, 'model' => 'sfGuardPermission', 'add_empty' => 'Selecciona perfil'));
        //$this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'Las dos contraseñas deben ser iguales.')));
        //$this->validatorSchema['email_address']->setMessages(array('invalid' => 'Ese Email lo está usando ya otro colaborador.'));

        /* $this->setValidator('email_address', new sfValidatorAnd(array(
          new sfValidatorEmail(array('required' => true, 'trim' => true), array('invalid'=> __('Ese correo electrónico no es válido.'))),
          new sfValidatorString(array('max_length' => 32), array('max_length'=>__('Ese correo electrónico no es válido.')))
          ), array(),array('required'=> __('No has incluido tu correo electrónico')))); */

        $this->setValidator('email_address', new sfValidatorPass());
        $this->setValidator('email_address_again', new sfValidatorPass());
        $this->setValidator('password', new sfValidatorPass());
        $this->setValidator('password_again', new sfValidatorPass());
        $this->setValidator('username', new sfValidatorPass());
        $this->setValidator('permissions_list', new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'sfGuardPermission', 'required' => false)));
        /* $this->setValidator('username', new sfValidatorAnd(array(
          new sfValidatorString(
          array('required' => true,'trim' => false,'min_length' => 2,'max_length' => 32),
          array('required' => __('No has incluido tu Usuario /Alias.'),'min_length' => __('Tu Usuario/Alias debe tener entre 2 y 32 caracteres, con espacios en blanco.'),'max_length' => __('Tu Usuario/Alias debe tener entre 2 y 32 caracteres, con espacios en blanco.'))
          ),
          new sfValidatorNombres(array('caracteres_no_validos' => sfGuardUserAdminForm::$caracteres_no_validos_username),array('invalid' => __('Ese Usuario/Alias no es válido.'))),
          new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('username')), array('invalid'=> __('Ese Usuario/Alias lo está usando ya otro colaborador.')))
          ), array(),array('required' => __('No has incluido tu Usuario/Alias.')))); */
        /* $this->setValidator('password', new sfValidatorAnd(array(
          new sfValidatorString(array('required' => true, 'trim' => false, 'min_length' => 2, 'max_length' => 16), array('min_length' => __('Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.'),'required' => 'No has incluido tu contraseña.')),
          new sfValidatorRegex(array('pattern' => '/^[^\s]+$/i'), array('invalid' => __('Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.')))
          ), array(),array('required'=> __('No has incluido tu contraseña'))));
          $this->setValidator('password_again', new sfValidatorAnd(array(
          new sfValidatorString(array('required' => true, 'trim' => false, 'min_length' => 2, 'max_length' => 16), array('min_length' => __('Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.'),'required' => 'No has incluido tu contraseña.')),
          new sfValidatorRegex(array('pattern' => '/^[^\s]+$/i'), array('invalid' => __('Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.')))
          ), array(),array('required'=> __('No has confirmado tu contraseña.')))); */


        $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
            new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsUsername'))),
            new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsEmail'))),
            new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsPassword'))),
                //new sfValidatorCallback(array('callback' => array($this, 'comparePassword'))),
        )));

        /* $this->validatorSchema->setPostValidator(
          new sfValidatorAnd(array(
          new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('email_address')), array('invalid' => 'Ese Email lo está usando ya otro colaborador.')),
          new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('username')), array('invalid' => 'Ese Usuario/Alias lo está usando ya otro colaborador.')),
          ))
          ); */



        if (!$this->isNew()) {
            $this->embedRelation('Profile as Perfil', 'sfGuardUserProfileFormBackend');
        }
    }

    public function extraValidatorsUsername($validator, $values) {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

        if (empty($values['username'])) {
            //$password_validated=true;
            $error = new sfValidatorError($validator, __('No has incluido tu Usuario/Alias.'));
            throw new sfValidatorErrorSchema($validator, array('username' => $error));
        } elseif (strlen($values['username']) > 32 || strlen($values['username']) < 2 || !preg_match('/[a-z0-9]/', $values['username'])) {
            //$password_validated=true;
            $error = new sfValidatorError($validator, __('Tu Usuario/Alias debe tener entre 2 y 32 caracteres, con espacios en blanco.'));
            throw new sfValidatorErrorSchema($validator, array('username' => $error));
        } else {
            $found = false;
            foreach (sfApplyForm1::$caracteres_no_validos_username as $s) {
                if (stripos($values['username'], $s) !== FALSE) {
                    $found = true;
                    $error = new sfValidatorError($validator, __('Ese Usuario/Alias no es válido.'));
                    throw new sfValidatorErrorSchema($validator, array('username' => $error));
                }
            }

            if (!$found) {
                $num_usuarios_mismo_nombre = Doctrine::getTable('sfGuardUser')->createQuery()
                        ->where('username=?', $values['username'])
                        ->count();
                if ($num_usuarios_mismo_nombre > 0) {
                    //$email_validated=true;
                    $error = new sfValidatorError($validator, __('Ese Usuario/Alias lo está usando ya otro colaborador.'));
                    throw new sfValidatorErrorSchema($validator, array('username' => $error));
                }
            }
        }

        return $values;
    }

    public function extraValidatorsPassword($validator, $values) {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $password_validated = false;

        if (empty($values['password'])) {
            $password_validated = true;
            $error = new sfValidatorError($validator, __('No has incluido tu contraseña.'));
            throw new sfValidatorErrorSchema($validator, array('password' => $error));
        } elseif (strlen($values['password']) > 16 || strlen($values['password']) < 2 || !preg_match('/^[^\s]+$/i', $values['password'])) {
            $password_validated = true;
            $error = new sfValidatorError($validator, __('Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.'));
            throw new sfValidatorErrorSchema($validator, array('password' => $error));
        }

        if (!$password_validated) {
            if (empty($values['password_again'])) {
                $error = new sfValidatorError($validator, __('No has confirmado tu contraseña.'));
                throw new sfValidatorErrorSchema($validator, array('password_again' => $error));
            } elseif (strlen($values['password_again']) > 16 || strlen($values['password_again']) < 2 || !preg_match('/^[^\s]+$/i', $values['password_again'])) {
                $error = new sfValidatorError($validator, __('Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.'));
                throw new sfValidatorErrorSchema($validator, array('password_again' => $error));
            } elseif ($values['password'] != $values['password_again']) {
                $error = new sfValidatorError($validator, __('Las contraseñas que has introducido no coinciden.'));
                throw new sfValidatorErrorSchema($validator, array('password_again' => $error));
            }
        }

        return $values;
    }

    public function extraValidatorsEmail($validator, $values) {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $email_validated = false;

        if (empty($values['email_address'])) {
            $email_validated = true;
            $error = new sfValidatorError($validator, __('No has incluido tu correo electrónico.'));
            throw new sfValidatorErrorSchema($validator, array('email_address' => $error));
        } elseif (strlen($values['email_address']) > 32) {
            $email_validated = true;
            $error = new sfValidatorError($validator, __('Ese correo electrónico no es válido.'));
            throw new sfValidatorErrorSchema($validator, array('email_address' => $error));
        } elseif (!preg_match(sfValidatorEmail::REGEX_EMAIL, $values['email_address'])) {
            $email_validated = true;
            $error = new sfValidatorError($validator, __('Ese correo electrónico no es válido.'));
            throw new sfValidatorErrorSchema($validator, array('email_address' => $error));
        } else {
            $num_usuarios_mismo_nombre = Doctrine::getTable('sfGuardUserProfile')->createQuery()
                    ->where('email=?', $values['email_address'])
                    ->count();
            if ($num_usuarios_mismo_nombre > 0) {
                $email_validated = true;
                $error = new sfValidatorError($validator, __('Ese correo electrónico lo está usando ya otro colaborador.'));
                throw new sfValidatorErrorSchema($validator, array('email_address' => $error));
            }
        }

        if (!$email_validated) {
            if (empty($values['email_address_again'])) {
                $error = new sfValidatorError($validator, __('No has confirmado tu correo electrónico.'));
                throw new sfValidatorErrorSchema($validator, array('email_address_again' => $error));
            } elseif (strlen($values['email_address_again']) > 32) {
                $error = new sfValidatorError($validator, __('Ese correo electrónico no es válido.'));
                throw new sfValidatorErrorSchema($validator, array('email_address_again' => $error));
            } elseif (!preg_match(sfValidatorEmail::REGEX_EMAIL, $values['email_address_again'])) {
                $error = new sfValidatorError($validator, __('Ese correo electrónico no es válido.'));
                throw new sfValidatorErrorSchema($validator, array('email_address_again' => $error));
            } elseif ($values['email_address'] != $values['email_address_again']) {
                $error = new sfValidatorError($validator, __('Los correos electrónicos que has introducido no coinciden.'));
                throw new sfValidatorErrorSchema($validator, array('email_address_again' => $error));
            }
        }

        return $values;
    }

    protected function doSave($con = null) {
        $this->saveGroupsList($con);
        $this->savePermissionsList($con);

        $isNew = $this->getObject()->isNew();

        parent::doSave($con);

        if ($isNew) {
            $profile = new sfGuardUserProfile();
            $profile->setUserId($this->getObject()->getId());
            $profile->setStatesId(33); // Madrid

            $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('crear_cuenta');
            if ($puntos > 0) {
                $profile->setPuntos($puntos);
                $msg = ColaboradorPuntoDefinicionTable::getDescripcionbyCodigo('crear_cuenta');
                ColaboradorPuntosHistoricoTable::new_log($this->getObject()->getId(), $msg, $puntos);
            }
        } else {
            $profile = Doctrine_Core::getTable('sfGuardUserProfile')->find($this->getObject()->getProfile()->getId());
        }

        $profile->setEmail($this->getObject()->getEmailAddress());
        $profile->save();
    }

}
