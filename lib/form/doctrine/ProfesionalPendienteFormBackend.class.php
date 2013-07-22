<?php

class ProfesionalPendienteFormBackend extends BaseProfesionalForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));  //para las traduciones del formulario
        unset(
                $this["created_at"], $this["updated_at"], $this['destacado']
        );

        $this->widgetSchema["user_id"] = new sfWidgetFormInputHidden();
        $this->setDefault("user_id", sfContext::getInstance()->getUser()->getGuardUser()->getId());

        $this->widgetSchema['road_type_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => 'RoadType',
            'order_by' => array('orden'),
            'add_empty' => __('Selecciona vía')), array('class' => 'select_pequeño'));

        $this->widgetSchema['address'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));

        $caracteres_no_validos_direccion = array(
            '@', '#', '+', '|', '£', '¥', '§', '©', '®', '±', '²', '³', 'µ', '¶', '{', '}', ';', ':', '_', '"',
            '¼', '½', '¾', 'Ø', 'Γ', 'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
            'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω', 'ϊ', 'ϋ', 'ύ', 'ώ', 'Б',
            'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п',
            'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю', 'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ',
            'Ѵ', 'ѵ', 'Ґ', 'ґ', 'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '·', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '№', '℮', '⅓', '⅔', '⅕', '⅖',
            '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', '←', '↑', '→', '↓', '↔', '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−',
            '√', '∞', '∫', '≈', '≠', '≤', '≥', '◊', '/', '\\', '^', '$', '€', '¿?', '?', '.', ',', '¡', '!', '%', '&', '(', ')', '=',
            '*', '[', ']', '>', '<', '¬', '·', '¿', '`', '³', '´', '¨'
        );

        $this->validatorSchema['address'] = new sfValidatorAnd(
                array(
            new sfValidatorString(
                    array(
                'max_length' => 70,
                'required' => true), array(
                'invalid' => __('Esa dirección no es válida.')
                    )
            ),
            new sfValidatorNombres(
                    array(
                'caracteres_no_validos' => $caracteres_no_validos_direccion,
                'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/",
                'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')
                    )
            )
                ), array('required' => true), array('required' => __('No has incluido una dirección.'), 'invalid' => __('Esa dirección no es válida.'))
        );

        $this->widgetSchema['numero'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
        $this->validatorSchema['numero'] = new sfValidatorAnd(
                array(
            new sfValidatorString(array('max_length' => 6, 'required' => false)),
            new sfValidatorNombres(
                    array(
                'caracteres_no_validos' => $caracteres_no_validos_direccion,
                'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/",
                'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')
                    )
            )
                ), array('required' => true), array('required' => __('No has incluido un Nº.'), 'invalid' => __('Ese Nº no es válido.'))
        );

        $this->widgetSchema['piso'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'class' => 'tamano_2_c'));
        $this->validatorSchema['piso'] = new sfValidatorAnd(
                array(
            new sfValidatorString(array('max_length' => 6, 'required' => false)),
            new sfValidatorNombres(
                    array(
                'caracteres_no_validos' => $caracteres_no_validos_direccion,
                'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/",
                'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')
                    )
            )
                ), array('required' => false), array('invalid' => __('Ese Piso no es válido.'))
        );

        $this->widgetSchema['puerta'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
        $this->validatorSchema['puerta'] = new sfValidatorAnd(
                array(
            new sfValidatorString(array('max_length' => 6, 'required' => false)),
            new sfValidatorNombres(
                    array(
                'caracteres_no_validos' => $caracteres_no_validos_direccion,
                'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/",
                'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')
                    )
            )
                ), array('required' => false), array('invalid' => __('Esa Puerta no es válida.'))
        );

        $this->validatorSchema['road_type_id']->setOption("required", true);
        $this->validatorSchema['road_type_id']->setMessage('required', 'No has seleccionado un tipo de vía.');
        $this->validatorSchema['states_id']->setMessage('required', 'No has seleccionado una provincia.');
        $this->validatorSchema["city_id"]->setOption("required", true);
        $this->validatorSchema["city_id"]->setMessage("required", 'No has seleccionado una localidad.');

        $this->widgetSchema['last_name_one'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_60_c'));
        $this->validatorSchema['last_name_one']->setMessage("required", 'No has incluido un título de la incidencia.');

        $this->widgetSchema['last_name_two'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_60_c'));
        $this->validatorSchema['last_name_two']->setMessage("required", 'No has incluido un título de la incidencia.');

        $this->widgetSchema['first_name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_60_c'));
        $this->validatorSchema['first_name']->setMessage("required", 'No has incluido un título de la incidencia.');

        $this->widgetSchema->setLabels(array(
            'address' => __('Dirección'),
            'profesional_tipo_uno_id' => __('Sector del profesional'),
            'profesional_tipo_dos_id' => __('Subsector del profesional'),
            'profesional_tipo_tres_id' => __('Tipo de profesional'),
            'last_name_one' => __('Título de la incidencia'),
            'last_name_two' => __('Título de la incidencia'),
            'first_name' => __('Título de la incidencia'),
            'road_type_id' => __('Tipo de vía'),
            'states_id' => __('Provincia'),
            'city_id' => __('Localidad'),
            'slug' => __('Url-alias')
        ));
    }

}
