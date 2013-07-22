<?php

class sfApplyForm1 extends sfGuardUserProfileForm {

    static public $caracteres_no_validos_username = array(
        'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
        'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω',
        'ϊ', 'ϋ', 'ύ', 'ώ', 'Б', 'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы',
        'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п', 'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю',
        'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ', 'Ѵ', 'ѵ', 'Ґ', 'ґ',
        'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '•', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '←', '↑', '→', '↓', '↔',
        '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−', '√', '∞', '∫', '≈', '◊', '⅓',
        '⅔', '⅕', '⅖', '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', 'Ø', '©','¶','℮','¼', '½', '¾', 'µ'
    );

    public function configure() {
        parent::configure();
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

        $this->widgetSchema->setNameFormat(get_class($this).'[%s]');
        $this->widgetSchema['email'] = new sfWidgetFormInput(array(),array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->widgetSchema['email2'] = new sfWidgetFormInput(array(),array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->widgetSchema['username'] = new sfWidgetFormInput(array(),array('class' => 'tamano_32_c', 'maxlength' => 25));
        $this->widgetSchema['password'] = new sfWidgetFormInputPassword(array(), array('maxlength' => 16, 'class' => 'tamano_16_c'));
        $this->widgetSchema['password2'] = new sfWidgetFormInputPassword(array(), array('maxlength' => 16, 'class' => 'tamano_16_c'));
       /* $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
            'file_src'  => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_users_dir')) . '/' .(!$this->getObject()->getImage()?'default.png':$this->getObject()->getImage()),
            'is_image'  => true,
            'edit_mode' => true,
            'with_delete' => false,
            'template'  => '<table class="uploadfield"><tr><td>%input%</td><td>%file%</td></tr></table>'
        )); */
        $this->widgetSchema['image'] = new pkWidgetFormInputFilePersistentimage(array(
            'file_src'  => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_users_dir')) . '/' .(!$this->getObject()->getImage()?'default.png':$this->getObject()->getImage()),
            'is_image'  => true,
            'edit_mode' => true,
            'with_delete' => false,
            'template'  => '<table class="uploadfield"><tr><td>%input%</td><td>%file%</td></tr></table>'
        ));

        $this->widgetSchema['captcha'] = new sfWidgetFormReCaptcha(array('public_key' => sfConfig::get('app_recaptcha_public_key')));
        $this->widgetSchema->setLabels(array(
            'email'            => __('Tu correo electrónico*'),
            'email2'           => __('Repite tu correo electrónico*'),
            'username'         => __('Tu Usuario/Alias*'),
            'password'         => __('Tu contraseña*'),
            'password2'        => __('Repite tu contraseña*'),
            'image'            => __('Tu imagen'),
        ));

        /*$this->setValidator('email', new sfValidatorAnd(array(
            new sfValidatorEmail(array('required' => true, 'trim' => true), array('invalid'=> __('Ese correo electrónico no es válido.'))),
            new sfValidatorString(array('max_length' => 32), array('max_length'=>__('Ese correo electrónico no es válido.')))
        ), array(),array('required'=> __('No has incluido tu correo electrónico'))));*/
        $this->setValidator('email', new sfValidatorPass());
        $this->setValidator('email2', new sfValidatorPass());
        $this->setValidator('username', new sfValidatorPass());
        $this->setValidator('password', new sfValidatorPass());
        $this->setValidator('password2', new sfValidatorPass());
        /*$this->setValidator('email2', new sfValidatorAnd(array(
            new sfValidatorEmail(array('required' => true, 'trim' => true), array('invalid'=> __('Ese correo electrónico no es válido.'))),
            new sfValidatorString(array('max_length' => 32), array('max_length'=>__('Ese correo electrónico no es válido.')))
        ), array(),array('required'=> __('No has confirmado tu correo electrónico'))));*/

        /*$this->setValidator('username', new sfValidatorAnd(array(
            new sfValidatorString(
                array('required' => true,'trim' => false,'min_length' => 2,'max_length' => 32),
                array('required' => __('No has incluido tu Usuario /Alias.'),'min_length' => __('Tu Usuario/Alias debe tener entre 2 y 32 caracteres, con espacios en blanco.'),'max_length' => __('Tu Usuario/Alias debe tener entre 2 y 32 caracteres, con espacios en blanco.'))
            ),
            new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm1::$caracteres_no_validos_username),array('invalid' => __('Ese Usuario/Alias no es válido.'))),
            new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('username')), array('invalid'=> __('Ese Usuario/Alias lo está usando ya otro colaborador.')))
        ), array(),array('required' => __('No has incluido tu Usuario/Alias.'))));*/

        /*$this->setValidator('password', new sfValidatorAnd(array(
            new sfValidatorString(array('required' => true, 'trim' => false, 'min_length' => 2, 'max_length' => 16), array('min_length' => __('Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.'),'required' => 'No has incluido tu contraseña.')),
            new sfValidatorRegex(array('pattern' => '/^[^\s]+$/i'), array('invalid' => __('Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.')))
        ), array(),array('required'=> __('No has incluido tu contraseña'))));
        $this->setValidator('password2', new sfValidatorAnd(array(
            new sfValidatorString(array('required' => true, 'trim' => false, 'min_length' => 2, 'max_length' => 16), array('min_length' => __('Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.'),'required' => 'No has incluido tu contraseña.')),
            new sfValidatorRegex(array('pattern' => '/^[^\s]+$/i'), array('invalid' => __('Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.')))
        ), array(),array('required'=> __('No has confirmado tu contraseña.'))));*/
        //$this->validatorSchema['image'] = new sfValidatorFile(array('required' => false, 'mime_types' => array('image/jpeg', 'image/png', 'image/gif','image/bmp','image/x-ms-bmp', 'image/x-png'),),array('mime_types' => 'Ese formato de imagen no es válido.'));
        $this->validatorSchema['image'] = new pkValidatorFilePersistent(array('required' => false,'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/', 'mime_types' => array('image/jpeg', 'image/png', 'image/gif','image/bmp','image/x-ms-bmp', 'image/x-png'),),array('mime_types' => 'Ese formato de imagen no es válido.'));
        $this->validatorSchema['captcha'] = new sfValidatorReCaptcha(array('private_key' => sfConfig::get('app_recaptcha_private_key')),array('captcha' => __('Necesitas copiar literalmente el texto del cuadro.'), 'required' => __('Necesitas introducir el texto del cuadro.')));
        $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
            new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsEmail'))),
            new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsPassword'))),
            new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsUsername'))),
        )));

        $this->widgetSchema->setNameFormat('sfApplyForm1[%s]');
        $this->disableLocalCSRFProtection();
        $this->useFields(array('email', 'email2', 'username', 'password', 'password2','captcha','image'));
    }

    public function extraValidatorsUsername($validator, $values)
    {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

        if (empty($values['username']))
        {
            //$password_validated=true;
            $error = new sfValidatorError($validator, __('Necesitas incluir un Usuario/Alias.'));
            throw new sfValidatorErrorSchema($validator, array('username' => $error));
        }
        elseif (strlen($values['username'])>32 || strlen($values['username'])<2 || !preg_match('/[a-z0-9]/', $values['username']))
        {
            //$password_validated=true;
            $error = new sfValidatorError($validator, __('Tu Usuario/Alias debe tener entre 2 y 32 caracteres, con espacios en blanco.'));
            throw new sfValidatorErrorSchema($validator, array('username' => $error));
        }
        else
        {
            $found=false;
            foreach (sfApplyForm1::$caracteres_no_validos_username as $s) {
                if (stripos($values['username'], $s) !== FALSE) {
                    $found=true;
                    $error = new sfValidatorError($validator, __('Ese Usuario/Alias no es válido.'));
                    throw new sfValidatorErrorSchema($validator, array('username' => $error));
                }
            }

            if (!$found)
            {
                $num_usuarios_mismo_nombre=Doctrine::getTable('sfGuardUser')->createQuery()
                    ->where('username=?',$values['username'])
                    ->count();
                if ($num_usuarios_mismo_nombre>0)
                {
                    //$email_validated=true;
                    $error = new sfValidatorError($validator, __('Ese Usuario/Alias lo está usando ya otro colaborador.'));
                    throw new sfValidatorErrorSchema($validator, array('username' => $error));
                }
            }
        }

        return $values;
    }

    public function extraValidatorsPassword($validator, $values)
    {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $password_validated=false;

        if (empty($values['password']))
        {
            $password_validated=true;
            $error = new sfValidatorError($validator, __('Necesitas incluir una contraseña.'));
            throw new sfValidatorErrorSchema($validator, array('password' => $error));
        }
        elseif (strlen($values['password'])>16 || strlen($values['password'])<2 || !preg_match('/^[^\s]+$/i', $values['password']))
        {
            $password_validated=true;
            $error = new sfValidatorError($validator, __('Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.'));
            throw new sfValidatorErrorSchema($validator, array('password' => $error));
        }

        if (!$password_validated)
        {
            if (empty($values['password2']))
            {
                $error = new sfValidatorError($validator, __('Necesitas repetir tu contraseña.'));
                throw new sfValidatorErrorSchema($validator, array('password2' => $error));
            }
            elseif ($values['password']!=$values['password2'])
            {
                $error = new sfValidatorError($validator, __('Las contraseñas que has introducido no coinciden.'));
                throw new sfValidatorErrorSchema($validator, array('password2' => $error));
            }
            elseif (strlen($values['password2'])>16 || strlen($values['password2'])<2 || !preg_match('/^[^\s]+$/i', $values['password2']))
            {
                $error = new sfValidatorError($validator, __('Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.'));
                throw new sfValidatorErrorSchema($validator, array('password2' => $error));
            }
        }

        return $values;
    }

    public function extraValidatorsEmail($validator, $values)
    {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $email_validated=false;

        if (empty($values['email']))
        {
            $email_validated=true;
            $error = new sfValidatorError($validator, __('Necesitas incluir tu correo electrónico.'));
            throw new sfValidatorErrorSchema($validator, array('email' => $error));
        }
        elseif (strlen($values['email'])>72)
        {
            $email_validated=true;
            $error = new sfValidatorError($validator, __('Ese correo electrónico no es válido.'));
            throw new sfValidatorErrorSchema($validator, array('email' => $error));
        }
        elseif (!preg_match(sfValidatorEmail::REGEX_EMAIL, $values['email']))
        {
            $email_validated=true;
            $error = new sfValidatorError($validator, __('Ese correo electrónico no es válido.'));
            throw new sfValidatorErrorSchema($validator, array('email' => $error));
        }
        else
        {
            $num_usuarios_mismo_nombre=Doctrine::getTable('sfGuardUserProfile')->createQuery()
                ->where('email=?',$values['email'])
                ->count();
            if ($num_usuarios_mismo_nombre>0)
            {
                $email_validated=true;
                $error = new sfValidatorError($validator, __('Ese correo electrónico lo está usando ya otro colaborador.'));
                throw new sfValidatorErrorSchema($validator, array('email' => $error));
            }
        }

        if (!$email_validated)
        {
            if (empty($values['email2']))
            {
                $error = new sfValidatorError($validator, __('Necesitas repetir tu correo electrónico.'));
                throw new sfValidatorErrorSchema($validator, array('email2' => $error));
            }
            elseif (strlen($values['email2'])>72)
            {
                $error = new sfValidatorError($validator, __('Ese correo electrónico no es válido.'));
                throw new sfValidatorErrorSchema($validator, array('email2' => $error));
            }
            elseif (!preg_match(sfValidatorEmail::REGEX_EMAIL, $values['email2']))
            {
                $error = new sfValidatorError($validator, __('Ese correo electrónico no es válido.'));
                throw new sfValidatorErrorSchema($validator, array('email2' => $error));
            }
            elseif ($values['email']!=$values['email2'])
            {
                $error = new sfValidatorError($validator, __('Los correos electrónicos que has introducido no coinciden.'));
                throw new sfValidatorErrorSchema($validator, array('email2' => $error));
            }
        }

        return $values;
    }

    public function resetErrorSchema()
    {
        $this->errorSchema = null;
    }
}