<?php

class sfApplyForm2 extends sfGuardUserProfileForm {

    static public $caracteres_no_validos_direccion = array(
        '@', '#', '+', '|', '£', '¥', '§', '©', '®', '±', '²', '³', 'µ', '¶','{', '}', ';', ':', '_', '"',
        '¼', '½', '¾', 'Ø', 'Γ', 'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
        'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω', 'ϊ', 'ϋ', 'ύ', 'ώ', 'Б',
        'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п',
        'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю', 'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ',
        'Ѵ', 'ѵ', 'Ґ', 'ґ', 'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '·', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '№', '℮', '⅓', '⅔', '⅕', '⅖',
        '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', '←', '↑', '→', '↓', '↔', '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−',
        '√', '∞', '∫', '≈', '≠', '≤', '≥', '◊', '/', '\\', '^', '$', '€', '¿?','?', '.', ',', '¡', '!', '%', '&', '(', ')', '=',
        '*', '[', ']','>','<','¬','·','¿','³','¨','•');

    static public $caracteres_no_validos_nombre = array(
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '@', '#', '+', '|', '£', '¥', '§', '©', '®', '±', '²', '³', 'µ', '¶',
        '¼', '½', '¾', 'Ø', 'Γ', 'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
        'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω', 'ϊ', 'ϋ', 'ύ', 'ώ', 'Б',
        'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п',
        'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю', 'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ',
        'Ѵ', 'ѵ', 'Ґ', 'ґ', 'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '•', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '№', '℮', '⅓', '⅔', '⅕', '⅖',
        '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', '←', '↑', '→', '↓', '↔', '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−',
        '√', '∞', '∫', '≈', '≠', '≤', '≥', '◊', '/', '\\', '^', '$', '€', '¿?','?', '.', ',',  '¡', '!', '%', '&', '(', ')', '=',
        '*', '[', ']','{', '}', ';', ':', '_', 'ª', 'º','"','>','<','¬','·','¿');

    public function configure() {
        parent::configure();

        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

        $sexs = array(null => __('Selecciona tu sexo'), 'hombre' => __('Hombre'), 'mujer' => __('Mujer'));
        $range = range(date('Y',strtotime('12 years ago')), '1900');
        $this->widgetSchema->setNameFormat(get_class($this).'[%s]');
        $this->widgetSchema['name'] = new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['surname1'] = new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['surname2'] = new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['sex'] = new sfWidgetFormChoice(array('choices' => $sexs));
        $this->widgetSchema['fecha_nac'] = new sfWidgetFormDate(array('format' => '%day% %month% %year%', 'years' => array_combine($range, $range)));
        $this->widgetSchema['formacion_academica_id'] = new sfWidgetFormDoctrineChoice(array('model'   => 'FormacionAcademica','add_empty' => __('Selecciona tu formación')));
        $this->widgetSchema['colaborador_nivel_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ColaboradorNivelUno','add_empty' => __('Selecciona tu sector profesional')));
        $this->widgetSchema['colaborador_nivel_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ColaboradorNivelDos','depends' => 'ColaboradorNivelUno','add_empty' => __('Selecciona tu actividad profesional')));
        $this->widgetSchema['road_type_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'RoadType', 'order_by'=>array('orden','asc'), 'add_empty' => __('Selecciona tu vía')), array('class' => 'select_pequeño'));
        $this->widgetSchema['direccion'] = new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['numero'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
        $this->widgetSchema['piso'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'class' => 'tamano_2_c'));
        $this->widgetSchema['puerta'] = new sfWidgetFormInputText(array(), array('maxlength' =>6, 'class' => 'tamano_4_c'));
        $this->widgetSchema['cp'] = new sfWidgetFormInput(array(), array('maxlength' => 5, 'class' => 'tamano_6_c'));
        //$this->widgetSchema['states_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'States','add_empty' => __('Selecciona tu provincia')));
        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => $this->getRelatedModelName('States'), 'table_method' => 'getWithoutTodas', 'add_empty' => __('Selecciona tu provincia'), 'order_by' => array('orden', 'asc')));
        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'City','depends' => 'States','ajax' => true,'add_empty' => __('Selecciona tu localidad')), array());
        $this->widgetSchema->setLabels(array(
            'name'                      => __('Tu nombre*'),
            'surname1'                  => __('Tu apellido 1*'),
            'surname2'                  => __('Tu apellido 2*'),
            'sex'                       => __('Eres*'),
            'fecha_nac'                 => __('Tu fecha de nacimiento'),
            'formacion_academica_id'    => __('Tu formación académica'),
            'colaborador_nivel_uno_id'  => __('Tu sector profesional*'),
            'colaborador_nivel_dos_id'  => __('Tu actividad profesional*'),
            'road_type_id'              => __('Tu tipo de vía'),
            'direccion'                 => __('Tu dirección'),
            'numero'                    => __('Nº'),
            'piso'                      => __('Piso'),
            'puerta'                    => __('Puerta'),
            'cp'                        => __('Tu C.P.'),
            'states_id'                 => __('Tu provincia*'),
            'city_id'                   => __('Tu localidad*'),
        ));

        $this->validatorSchema['name'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70,'min_length' => 2,'required' => true),array('required' => __('No has incluido tu nombre.'),'invalid' => __('Ese nombre no es válido.'))),
            new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/",'repeticiones_no_validas'=> array('a','b','c','d','e','f','h','g','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z')))
        ), array(),array('required'=> __('Necesitas incluir tu nombre.'), 'invalid'=> __('Ese nombre no es válido.')));
        $this->validatorSchema['surname1'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70,'min_length' => 2),array('required' => 'No has incluido tu primer apellido.','invalid' => 'Ese apellido no es válido.')),
            new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/",'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', "ñ", 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
        ), array(),array('required'=> __('Necesitas incluir tu primer apellido.'), 'invalid'=> __('Ese apellido no es válido.')));
        $this->validatorSchema['surname2'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70,'min_length' => 2),array('required' => 'No has incluido tu segundo apellido.','invalid' => 'Ese apellido no es válido.')),
            new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/",'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
        ), array(),array('required'=> __('Necesitas incluir tu segundo apellido.'), 'invalid'=> __('Ese apellido no es válido.')));
        $this->validatorSchema['sex'] = new sfValidatorChoice(array('choices' =>  array_keys($sexs), 'required' => true),array('required' => __('Necesitas seleccionar tu sexo.')));
        $this->validatorSchema['fecha_nac'] = new sfValidatorDate (array('required'=>false, 'min' => '01-01-1900', 'max' => date('d-m-Y',strtotime('18 years ago'))), array('invalid' => __('Esa fecha de nacimiento no es válida.'), 'max' => __('Para crear una cuenta necesitas ser mayor de edad.')));
        $this->validatorSchema['colaborador_nivel_uno_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ColaboradorNivelUno'), 'required' => true),array('required' => __('Necesitas seleccionar tu sector profesional.')));
        $this->validatorSchema['colaborador_nivel_dos_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ColaboradorNivelDos'), 'required' => true),array('required' => __('Necesitas seleccionar tu actividad profesional.')));
        $this->validatorSchema['road_type_id'] = new sfValidatorDoctrineChoice(array('model' => 'RoadType', 'required' => false));
        $this->validatorSchema['direccion'] = new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 70,'required' => false),array('invalid' => __('Esa dirección no es válida.'))),
                new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_direccion,'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/",'repeticiones_no_validas'=> array('a','b','c','d','e','f','h','g','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z')))
            ),
            array('required' => false),
            array('invalid' => __('Esa dirección no es válida.'))
        );

        $caracteres_no_validos_numero = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_numero[array_search('/',$caracteres_no_validos_numero)]);	// para número sí permitimos la barra
        $this->validatorSchema['numero'] = new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 6, 'required' => false)),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_numero,'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/",'repeticiones_no_validas'=> array('a','b','c','d','e','f','h','g','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z')))
            ),
            array('required' => false),
            array('invalid' => __('Ese Nº no es válido.'))
        );

        $caracteres_no_validos_piso_puerta = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_piso_puerta[array_search('.',$caracteres_no_validos_piso_puerta)]);	// para piso y puerta sí permitimos el punto
        $this->validatorSchema['piso'] = new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 6, 'required' => false)),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta ,'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/",'repeticiones_no_validas'=> array('a','b','c','d','e','f','h','g','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z')))
            ),
            array('required' => false),
            array('invalid' => __('Ese Piso no es válido.'))
        );

        $caracteres_no_validos_piso_puerta = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_piso_puerta[array_search('.',$caracteres_no_validos_piso_puerta)]);	// para piso y puerta sí permitimos el punto
        $this->validatorSchema['puerta'] = new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 6, 'required' => false)),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta ,'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/",'repeticiones_no_validas'=> array('a','b','c','d','e','f','h','g','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z')))
            ),
            array('required' => false),
            array('invalid' => __('Esa Puerta no es válida.'))
        );
        $this->validatorSchema['cp'] = new sfValidatorPass();
        $this->validatorSchema['states_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('States')),array('required' => __('Necesitas seleccionar tu provincia.')));
        $this->validatorSchema['city_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'required' => true),array('required' => __('Necesitas seleccionar tu localidad.')));
        $this->validatorSchema->setPreValidator(new sfValidatorCallback(array('callback' => array($this, 'preValidate'))));
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidate'))));

        $this->disableLocalCSRFProtection();
        $this->useFields(array('name', 'surname1', 'surname2', 'sex', 'fecha_nac',
            'formacion_academica_id','colaborador_nivel_uno_id', 'colaborador_nivel_dos_id',
            'road_type_id', 'direccion', 'numero', 'piso', 'puerta', 'cp', 'states_id', 'city_id'));
    }

    public function preValidate($validator, $values) {
        if (($values['states_id'] == 16) || ($values['states_id'] == 35))
        {
            $this->getValidator('city_id')->setOption('required', false);
        }
        if (in_array($values['colaborador_nivel_uno_id'], array(22,23,24,25)))
        {
            // Ama de casa, Desemplado, Estudiante y Otra respectivamente
            $this->getValidator('colaborador_nivel_dos_id')->setOption('required', false);
        }
    }

    public function postValidate($validator, $values) {
        if ((!empty($values['states_id'])) and (!empty($values['cp']))) {
            $name = Doctrine::getTable('States')->findOneById($values['states_id'])->getName();
            if (false == cp::checkCpByStateName($values['cp'], $name))
            {
                $invalid = new sfValidatorError($validator, 'Ese C.P. no es válido.');
                throw new sfValidatorErrorSchema($validator, array('cp' => $invalid));
            }
        }

        return $values;
    }

    public function resetErrorSchema()
    {
    }
}
