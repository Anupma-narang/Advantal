<?php

class sfGuardUserBackendForm extends BasesfGuardUserForm {

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
    static public $caracteres_no_validos_direccion = array(
        '@', '#', '+', '|', '£', '¥', '§', '©', '®', '±', '²', '³', 'µ', '¶', '{', '}', ';', ':', '_', '"',
        '¼', '½', '¾', 'Ø', 'Γ', 'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
        'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω', 'ϊ', 'ϋ', 'ύ', 'ώ', 'Б',
        'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п',
        'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю', 'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ',
        'Ѵ', 'ѵ', 'Ґ', 'ґ', 'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '·', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '№', '℮', '⅓', '⅔', '⅕', '⅖',
        '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', '←', '↑', '→', '↓', '↔', '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−',
        '√', '∞', '∫', '≈', '≠', '≤', '≥', '◊', '/', '\\', '^', '$', '€', '¿?', '?', '.', ',', '¡', '!', '%', '&', '(', ')', '=',
        '*', '[', ']', '>', '<', '¬', '·', '¿', '³', '¨', '•');
    static public $caracteres_no_validos_nombre = array(
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '@', '#', '+', '|', '£', '¥', '§', '©', '®', '±', '²', '³', 'µ', '¶',
        '¼', '½', '¾', 'Ø', 'Γ', 'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
        'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω', 'ϊ', 'ϋ', 'ύ', 'ώ', 'Б',
        'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п',
        'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю', 'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ',
        'Ѵ', 'ѵ', 'Ґ', 'ґ', 'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '•', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '№', '℮', '⅓', '⅔', '⅕', '⅖',
        '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', '←', '↑', '→', '↓', '↔', '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−',
        '√', '∞', '∫', '≈', '≠', '≤', '≥', '◊', '/', '\\', '^', '$', '€', '¿?', '?', '.', ',', '¡', '!', '%', '&', '(', ')', '=',
        '*', '[', ']', '{', '}', ';', ':', '_', 'ª', 'º', '"', '>', '<', '¬', '·', '¿');

    public function configure() {
        if ($this->isNew()) {
            $this->configureNewForm();
        } else {
            $this->configureEditForm();
        }
    }

    public function configureNewForm() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

        unset($this['last_login'], $this['created_at'], $this['updated_at'], $this['salt'], $this['algorithm']);

        $this->widgetSchema['id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['email_address'] = new sfWidgetFormInput(array(), array('style' => 'width: 225px', 'maxlength' => 70));
        $this->widgetSchema['email_address_again'] = new sfWidgetFormInput(array(), array('style' => 'width: 225px', 'maxlength' => 70));
        $this->widgetSchema['username'] = new sfWidgetFormInput(array(), array('class' => 'tamano_25_c', 'maxlength' => 25));
        $this->widgetSchema['password'] = new sfWidgetFormInputPassword(array(), array('maxlength' => 16, 'style' => 'width:130px'));
        $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword(array(), array('maxlength' => 16, 'style' => 'width:130px'));
        $this->widgetSchema['permissions_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => false, 'model' => 'sfGuardPermission'));

        $this->setValidator('id', new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)));
        $this->setValidator('email_address', new sfValidatorPass());
        $this->setValidator('email_address_again', new sfValidatorPass());
        $this->setValidator('password', new sfValidatorPass());
        $this->setValidator('password_again', new sfValidatorPass());
        $this->setValidator('username', new sfValidatorPass());
        $this->setValidator('permissions_list', new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'sfGuardPermission', 'required' => true)), array('id' => 'permission'));
        /* $this->setValidator('username', new sfValidatorAnd(array(
          new sfValidatorString(
          array('required' => true,'trim' => false,'min_length' => 2,'max_length' => 32),
          array('required' => __('No has incluido tu Usuario/Alias.'),'min_length' => __('Tu Usuario/Alias debe tener entre 2 y 32 caracteres, con espacios en blanco.'),'max_length' => __('Tu Usuario/Alias debe tener entre 2 y 32 caracteres, con espacios en blanco.'))
          ),
          new sfValidatorNombres(array('caracteres_no_validos' => sfGuardUserBackendForm::$caracteres_no_validos_username),array('invalid' => __('Ese Usuario/Alias no es válido.'))),
          new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('username')), array('invalid'=> __('Ese Usuario/Alias lo está usando ya otro colaborador.')))
          ), array(),array('required' => __('No has incluido tu Usuario/Alias.')))); */


        $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
            new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsUsername'))),
            new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsEmail'))),
            new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsPassword'))),
        )));

        $this->widgetSchema->setLabels(array(
            'email_address' => __('Correo electrónico'),
            'email_address_again' => __('Repite el correo electrónico'),
            'username' => __('Usuario/Alias'),
            'password' => __('Contraseña'),
            'password_again' => __('Repite la contraseña'),
            'is_active' => __('¿Activo?'),
            'is_disabled' => __('¿Deshabilitado?'),
            'is_super_admin' => __('¿Superadministrador?'),
            'groups_list' => __('Lista de grupos'),
            'permissions_list' => __('Perfil de Usuario')
        ));
    }

    public function configureEditForm() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

        unset($this['last_login'], $this['created_at'], $this['updated_at'], $this['salt'], $this['algorithm'], $this['user_id'], $this['active'], $this['validate'], $this['rank'], $this['change_points'], $this['money']);

        $this->widgetSchema['id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['email_address'] = new sfWidgetFormInput(array(), array('style' => 'width: 225px', 'maxlength' => 70));
        $this->widgetSchema['email_address_again'] = new sfWidgetFormInput(array(), array('style' => 'width: 225px', 'maxlength' => 70));
        $this->widgetSchema['username'] = new sfWidgetFormInput(array(), array('class' => 'tamano_25_c', 'maxlength' => 25));
        $this->widgetSchema['password'] = new sfWidgetFormInputPassword(array(), array('maxlength' => 16, 'style' => 'width:130px'));
        $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword(array(), array('maxlength' => 16, 'style' => 'width:130px'));
        $this->widgetSchema['permissions_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => false, 'model' => 'sfGuardPermission'));

        $this->setValidator('id', new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)));
        $this->setValidator('email_address', new sfValidatorPass());
        $this->setValidator('email_address_again', new sfValidatorPass());
        $this->setValidator('password', new sfValidatorPass());
        $this->setValidator('password_again', new sfValidatorPass());
        $this->setValidator('username', new sfValidatorPass());
        $this->setValidator('name', new sfValidatorPass());
        $this->setValidator('surname1', new sfValidatorPass());
        $this->setValidator('surname2', new sfValidatorPass());
        $this->setValidator('permissions_list', new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'sfGuardPermission', 'required' => true)), array('id' => 'permission'));
        /* $this->setValidator('username', new sfValidatorAnd(array(
          new sfValidatorString(
          array('required' => true,'trim' => false,'min_length' => 2,'max_length' => 32),
          array('required' => __('No has incluido tu Usuario/Alias.'),'min_length' => __('Tu Usuario/Alias debe tener entre 2 y 32 caracteres, con espacios en blanco.'),'max_length' => __('Tu Usuario/Alias debe tener entre 2 y 32 caracteres, con espacios en blanco.'))
          ),
          new sfValidatorNombres(array('caracteres_no_validos' => sfGuardUserBackendForm::$caracteres_no_validos_username),array('invalid' => __('Ese Usuario/Alias no es válido.'))),
          ), array(),array('required' => __('No has incluido tu Usuario/Alias.')))); */

        $sexs = array(null => __('Selecciona tu sexo'), 'hombre' => __('Hombre'), 'mujer' => __('Mujer'));
        $range = range(date('Y', strtotime('12 years ago')), '1900');
        $this->widgetSchema['sex'] = new sfWidgetFormChoice(array('choices' => $sexs));
        $this->validatorSchema['sex'] = new sfValidatorChoice(array('choices' => array_keys($sexs), 'required' => false), array('required' => __('No has seleccionado tu sexo.')));

        $this->widgetSchema['fecha_nac'] = new sfWidgetFormDate(array('format' => '%day% %month% %year%', 'years' => array_combine($range, $range)));

        $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
            'file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_users_dir')) . '/' . (!$this->getObject()->getProfile()->getImage() ? 'default.png' : $this->getObject()->getProfile()->getImage()),
            'is_image' => true,
            'edit_mode' => true,
            'with_delete' => false,
            'template' => '<table class="uploadfield"><tr><td>%input%</td><td>%file%</td></tr></table>'
        ));
        
        $this->validatorSchema['image'] = new sfValidatorFile(array('required' => false, 'mime_types' => array('image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/x-ms-bmp', 'image/x-png'),), array('mime_types' => 'Ese formato de imagen no es válido.'));

        $this->widgetSchema['name'] = new sfWidgetFormInput(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->widgetSchema['surname1'] = new sfWidgetFormInput(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->widgetSchema['surname2'] = new sfWidgetFormInput(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->widgetSchema['direccion'] = new sfWidgetFormInput(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->widgetSchema['numero'] = new sfWidgetFormInput(array(), array('class' => 'tamano_4_c', 'maxlength' => 6));
        $this->widgetSchema['piso'] = new sfWidgetFormInput(array(), array('class' => 'tamano_2_c', 'maxlength' => 3));
        $this->widgetSchema['puerta'] = new sfWidgetFormInput(array(), array('class' => 'tamano_4_c', 'maxlength' => 6));
        $this->widgetSchema['cp'] = new sfWidgetFormInput(array(), array('class' => 'tamano_5_c', 'maxlength' => 5));
        $this->widgetSchema['telefono'] = new sfWidgetFormInput(array(), array('style' => 'width:66px', 'maxlength' => 9));
        $this->validatorSchema['telefono'] = new sfValidatorRegex(array(
            'pattern' => '#^(\d{9})$#',
            'required' => false
                ), array('invalid' => 'Ese teléfono no es válido')
        );
        $this->validatorSchema['name'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'min_length' => 2, 'required' => true), array('required' => __('No has incluido tu nombre.'), 'invalid' => __('Ese nombre no es válido.'))),
            new sfValidatorNombres(array('caracteres_no_validos' => sfGuardUserProfileFormBackend::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('required' => __('No has incluido tu nombre.'), 'invalid' => __('Ese nombre no es válido.')));

        $this->validatorSchema['surname1'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'min_length' => 2), array('required' => 'No has incluido tu primer apellido.', 'invalid' => 'Ese apellido no es válido.')),
            new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', "ñ", 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('required' => __('No has incluido tu primer apellido.'), 'invalid' => __('Ese apellido no es válido.')));

        $this->validatorSchema['surname2'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'min_length' => 2), array('required' => 'No has incluido tu segundo apellido.', 'invalid' => 'Ese apellido no es válido.')),
            new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('required' => __('No has incluido tu segundo apellido.'), 'invalid' => __('Ese apellido no es válido.')));

        $this->validatorSchema['fecha_nac'] = new sfValidatorDate(array('required' => false, 'min' => '01-01-1900', 'max' => date('d-m-Y', strtotime('18 years ago'))), array('max' => __('Para crear una cuenta necesitas ser mayor de edad.')));
        $this->validatorSchema['road_type_id'] = new sfValidatorDoctrineChoice(array('model' => 'RoadType', 'required' => false));
        $this->validatorSchema['direccion'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'required' => false), array('invalid' => __('Esa dirección no es válida.'))),
            new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_direccion, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('invalid' => __('Esa dirección no es válida.'))
        );

        $caracteres_no_validos_numero = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_numero[array_search('/', $caracteres_no_validos_numero)]); // para número sí permitimos la barra
        $this->validatorSchema['numero'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 6, 'required' => false)),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_numero, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('invalid' => __('Ese Nº no es válido.'))
        );

        $caracteres_no_validos_piso_puerta = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_piso_puerta[array_search('.', $caracteres_no_validos_piso_puerta)]); // para piso y puerta sí permitimos el punto
        $this->validatorSchema['piso'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 6, 'required' => false)),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('invalid' => __('Ese Piso no es válido.'))
        );

        $caracteres_no_validos_piso_puerta = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_piso_puerta[array_search('.', $caracteres_no_validos_piso_puerta)]); // para piso y puerta sí permitimos el punto
        $this->validatorSchema['puerta'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 6, 'required' => false)),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('invalid' => __('Esa Puerta no es válida.'))
        );
        $this->validatorSchema['cp'] = new sfValidatorPass();

        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'States', 'add_empty' => __('Selecciona provincia'), 'order_by' => array('orden', 'asc')));
        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'City', 'depends' => 'States', 'ajax' => true, 'add_empty' => __('Selecciona tu localidad')), array());
        $this->validatorSchema['states_id'] = new sfValidatorDoctrineChoice(array('model' => 'States', 'required' => false), array('required' => __('No has seleccionado tu provincia.')));
        $this->validatorSchema['city_id'] = new sfValidatorDoctrineChoice(array('model' => 'City', 'required' => false), array('required' => __('No has seleccionado tu localidad.')));

        $this->widgetSchema['formacion_academica_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'FormacionAcademica', 'add_empty' => __('Selecciona tu formación')));
        $this->widgetSchema['colaborador_nivel_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ColaboradorNivelUno', 'add_empty' => __('Selecciona tu sector profesional')));
        $this->widgetSchema['colaborador_nivel_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ColaboradorNivelDos', 'depends' => 'ColaboradorNivelUno', 'add_empty' => __('Selecciona tu actividad profesional')));
        $this->validatorSchema['formacion_academica_id'] = new sfValidatorDoctrineChoice(array('model' => 'FormacionAcademica', 'required' => false));
        $this->validatorSchema['colaborador_nivel_uno_id'] = new sfValidatorDoctrineChoice(array('model' => 'ColaboradorNivelUno', 'required' => false), array('required' => __('No has seleccionado tu sector profesional.')));
        $this->validatorSchema['colaborador_nivel_dos_id'] = new sfValidatorDoctrineChoice(array('model' => 'ColaboradorNivelDos', 'required' => false), array('required' => __('No has seleccionado tu actividad profesional.')));
        //$this->validatorSchema['telefono'] = new sfValidatorPass();


        $this->validatorSchema->setPreValidator(new sfValidatorCallback(array('callback' => array($this, 'preValidate'))));
        $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
            new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => 'username')),
            new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsUsername'))),
            //new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsName'))),
            //new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsSurname1'))),
            //new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsSurname2'))),
            //new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsTelefono'))),
            new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsEmail'))),
            new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsPassword'))),
            new sfValidatorCallback(array('callback' => array($this, 'postValidate')))
        )));

        $this->widgetSchema->setLabels(array(
            'email_address' => __('Correo electrónico'),
            'email_address_again' => __('Repite el correo electrónico'),
            'username' => __('Usuario/Alias'),
            'password' => __('Contraseña'),
            'password_again' => __('Repite la contraseña'),
            'is_active' => __('¿Activo?'),
            'is_disabled' => __('¿Deshabilitado?'),
            'is_super_admin' => __('¿Superadministrador?'),
            'groups_list' => __('Lista de grupos'),
            'permissions_list' => __('Lista de privilegios'),
            'name' => __('Nombre'),
            'surname1' => __('Apellido 1'),
            'surname2' => __('Apellido 2'),
            'sex' => __('Sexo'),
            'fecha_nac' => __('Fecha de nacimiento'),
            'formacion_academica_id' => __('Formación académica'),
            'colaborador_nivel_uno_id' => __('Sector profesional'),
            'colaborador_nivel_dos_id' => __('Actividad profesional'),
            'road_type_id' => __('Tipo de vía'),
            'direccion' => __('Dirección'),
            'numero' => __('Nº'),
            'piso' => __('Piso'),
            'puerta' => __('Puerta'),
            'cp' => __('C.P.'),
            'states_id' => __('Provincia'),
            'city_id' => __('Localidad'),
            'image' => __('Imagen'),
            'telefono' => __('Teléfono')
        ));
    }

//    public function extraValidatorsTelefono($validator, $values)
//    {
//        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
//
//        if ($values['telefono']){
//            if (!is_numeric($values['telefono']))
//            {
//                $error = new sfValidatorError($validator, __('Ese teléfono no es válido.'));
//                throw new sfValidatorErrorSchema($validator, array('telefono' => $error));
//            }
//    }
//        return $values;
//    }

    /* public function extraValidatorsName($validator, $values)
      {
      sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

      if (is_numeric($values['name']))
      {
      //$password_validated=true;
      $error = new sfValidatorError($validator, __('Ese nombre no es válido.'));
      throw new sfValidatorErrorSchema($validator, array('name' => $error));
      }
      if(!preg_match('/^[a-z\áéíóúAÉÍÓÚÑñ]*$/', $values['name'])){
      $error = new sfValidatorError($validator, __('Ese nombre no es válido.'));
      throw new sfValidatorErrorSchema($validator, array('name' => $error));
      }
      return $values;
      } */

    /* public function extraValidatorsSurname1($validator, $values)
      {
      sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

      if (is_numeric($values['surname1']))
      {
      //$password_validated=true;
      $error = new sfValidatorError($validator, __('Ese apellido no es válido.'));
      throw new sfValidatorErrorSchema($validator, array('surname1' => $error));
      }
      if(!preg_match('/^[a-z\áéíóúAÉÍÓÚÑñ]*$/', $values['surname1'])){
      $error = new sfValidatorError($validator, __('Ese apellido no es válido.'));
      throw new sfValidatorErrorSchema($validator, array('surname1' => $error));
      }
      return $values;
      } */

    /* public function extraValidatorsSurname2($validator, $values)
      {
      sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

      if (is_numeric($values['surname2']))
      {
      //$password_validated=true;
      $error = new sfValidatorError($validator, __('Ese apellido no es válido.'));
      throw new sfValidatorErrorSchema($validator, array('surname2' => $error));
      }
      if(!preg_match('/^[a-z\áéíóúAÉÍÓÚÑñ]*$/', $values['surname2'])){
      $error = new sfValidatorError($validator, __('Ese apellido no es válido.'));
      throw new sfValidatorErrorSchema($validator, array('surname2' => $error));
      }
      return $values;
      } */

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
                if ($values['id']) {
                    $num_usuarios_mismo_nombre = Doctrine::getTable('sfGuardUser')->createQuery()
                            ->where('username=?', $values['username'])
                            ->addwhere('id!=?', $values['id'])
                            ->count();
                } else {
                    $num_usuarios_mismo_nombre = Doctrine::getTable('sfGuardUser')->createQuery()
                            ->where('username=?', $values['username'])
                            ->count();
                }

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

        if (!empty($values['password'])) {
            if (strlen($values['password']) > 16 || strlen($values['password']) < 2 || !preg_match('/^[^\s]+$/i', $values['password'])) {
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
        } elseif (strlen($values['email_address']) > 70) {
            $email_validated = true;
            $error = new sfValidatorError($validator, __('Ese correo electrónico no es válido.'));
            throw new sfValidatorErrorSchema($validator, array('email_address' => $error));
        } elseif (!preg_match(sfValidatorEmail::REGEX_EMAIL, $values['email_address'])) {
            $email_validated = true;
            $error = new sfValidatorError($validator, __('Ese correo electrónico no es válido.'));
            throw new sfValidatorErrorSchema($validator, array('email_address' => $error));
        } else {
            $num_usuarios_mismo_nombre = Doctrine::getTable('sfGuardUserProfile')->createQuery()
                    ->where('email=?', $values['email_address']);

            if ($this->getObject()->getEmailAddress()) {
                $num_usuarios_mismo_nombre->andWhere('email!=?', $this->getObject()->getEmailAddress());
            }
            if ($num_usuarios_mismo_nombre->count() > 0) {
                $email_validated = true;
                $error = new sfValidatorError($validator, __('Ese correo electrónico lo está usando otro colaborador.'));
                throw new sfValidatorErrorSchema($validator, array('email_address' => $error));
            }
        }

        if (($this->getObject()->isNew() && !$email_validated) || (!$this->getObject()->isNew() && $this->getObject()->getEmailAddress() != $values['email_address'])) {
            if (empty($values['email_address_again'])) {
                $error = new sfValidatorError($validator, __('No has confirmado tu correo electrónico.'));
                throw new sfValidatorErrorSchema($validator, array('email_address_again' => $error));
            } elseif (strlen($values['email_address_again']) > 70) {
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

    public function getDefaultValuesSfGuardUser() {
        //echo $this->getObject()->getProfile()->getStatesId();die;
        $this->setDefault('name', $this->getObject()->getProfile()->getName());
        $this->setDefault('surname1', $this->getObject()->getProfile()->getSurname1());
        $this->setDefault('surname2', $this->getObject()->getProfile()->getSurname2());
        $this->setDefault('sex', $this->getObject()->getProfile()->getSex());
        $this->setDefault('fecha_nac', $this->getObject()->getProfile()->getFechaNac());
        $this->setDefault('formacion_academica_id', $this->getObject()->getProfile()->getFormacionAcademicaId());
        $this->setDefault('colaborador_nivel_uno_id', $this->getObject()->getProfile()->getColaboradorNivelUnoId());
        $this->setDefault('colaborador_nivel_dos_id', $this->getObject()->getProfile()->getColaboradorNivelDosId());
        $this->setDefault('road_type_id', $this->getObject()->getProfile()->getRoadTypeId());
        $this->setDefault('direccion', $this->getObject()->getProfile()->getDireccion());
        $this->setDefault('numero', $this->getObject()->getProfile()->getNumero());
        $this->setDefault('piso', $this->getObject()->getProfile()->getPiso());
        $this->setDefault('puerta', $this->getObject()->getProfile()->getPuerta());
        $this->setDefault('cp', $this->getObject()->getProfile()->getCp());
        $this->setDefault('states_id', $this->getObject()->getProfile()->getStatesId());
        $this->setDefault('city_id', $this->getObject()->getProfile()->getCityId());
        $this->setDefault('image', $this->getObject()->getProfile()->getImage());
        $this->setDefault('telefono', $this->getObject()->getProfile()->getTelefono());
        $pemission = Doctrine::getTable('sfGuardUserPermission')->findOneBy('user_id', $this->getObject()->getId(), Doctrine::HYDRATE_ARRAY);

        $this->setDefault('permissions_list', $pemission['permission_id'] ? $pemission['permission_id'] : 5);
    }

    public function preValidate($validator, $values) {
        if ($values['states_id'] == 16 || $values['states_id'] == 35) {
            $this->getValidator('city_id')->setOption('required', false);
        }

        if (in_array($values['colaborador_nivel_uno_id'], array(22, 23, 24, 25))) {
            // Ama de casa, Desemplado, Estudiante y Otra respectivamente
            $this->getValidator('colaborador_nivel_dos_id')->setOption('required', false);
        }
    }

    public function postValidate($validator, $values) {
        if ((!empty($values['states_id'])) and (!empty($values['cp']))) {
            $name = Doctrine::getTable('States')->findOneById($values['states_id'])->getName();
            if (false == cp::checkCpByStateName($values['cp'], $name)) {
                $invalid = new sfValidatorError($validator, 'Ese C.P. no es válido.');
                throw new sfValidatorErrorSchema($validator, array('cp' => $invalid));
            }
        }

        return $values;
    }

    public function getArrValues() {
        $values = $this->getValues();
        $values['Profile'] = array(
            'name' => $values['name'],
            'surname1' => $values['surname1'],
            'surname2' => $values['surname2'],
            'sex' => $values['sex'],
            'fecha_nac' => $values['fecha_nac'],
            'formacion_academica_id' => $values['formacion_academica_id'],
            'colaborador_nivel_uno_id' => $values['colaborador_nivel_uno_id'],
            'colaborador_nivel_dos_id' => $values['colaborador_nivel_dos_id'],
            'road_type_id' => $values['road_type_id'],
            'direccion' => $values['direccion'],
            'numero' => $values['numero'],
            'piso' => $values['piso'],
            'puerta' => $values['puerta'],
            'cp' => $values['cp'],
            'states_id' => $values['states_id'],
            'city_id' => $values['city_id'],
            'image' => $values['image'],
            'telefono' => $values['telefono']
        );

        unset($values['name'], $values['surname1'], $values['surname2'], $values['sex'], $values['fecha_nac'], $values['formacion_academica_id'], $values['colaborador_nivel_uno_id'], $values['colaborador_nivel_dos_id'], $values['road_type_id'], $values['direccion'], $values['numero'], $values['piso'], $values['puerta'], $values['cp'], $values['states_id'], $values['city_id'], $values['image'], $values['telefono']);

        return $values;
    }

    public function save($con = null) {
        $this->saveGroupsList($con);
        $this->savePermissionsList($con);

        $isNew = $this->getObject()->isNew();


        if ($isNew) {
            parent::save($con);

            $profile = new sfGuardUserProfile();
            $profile->setUserId($this->getObject()->getId());
            // $profile->setStatesId(33); // Madrid

            $puntos = ColaboradorPuntoDefinicionTable::getPuntosbyCodigo('crear_cuenta');
            if ($puntos > 0) {
                $profile->setPuntos($puntos);
                $msg = ColaboradorPuntoDefinicionTable::getDescripcionbyCodigo('crear_cuenta');
                ColaboradorPuntosHistoricoTable::new_log($this->getObject()->getId(), $msg, $puntos);
            }
        } else {
            $values = $this->getArrValues();

            $this->getObject()->fromArray($values);
            $newvalue = $values['StatesId'];

            $this->getObject()->save();

            $profile = Doctrine_Core::getTable('sfGuardUserProfile')->find($this->getObject()->getProfile()->getId());
            $profile->fromArray($values['Profile']);
            /* if(!$values['Profile']['states_id']){
              $profile->setStatesId(33);
              } */
            //Inicio carga de imagenes
            $upload = $values['Profile']['image'];
            if ($upload) {
                $profile->setImage($upload);
            }
        }

        $profile->setEmail($this->getObject()->getEmailAddress());
        $profile->save();

        return $this->getObject()->getId();
    }

}
