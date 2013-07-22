<?php

class CartaPendienteOtherFormBackend extends BaseProfesionalForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $caracteres_no_validos_direccion = array(
            '@', '#', '+', '|', '£', '¥', '§', '©', '®', '±', '²', '³', 'µ', '¶', '{', '}', ';', ':', '_', '"',
            '¼', '½', '¾', 'Ø', 'Γ', 'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
            'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω', 'ϊ', 'ϋ', 'ύ', 'ώ', 'Б',
            'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п',
            'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю', 'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ',
            'Ѵ', 'ѵ', 'Ґ', 'ґ', 'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '·', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '№', '℮', '⅓', '⅔', '⅕', '⅖',
            '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', '←', '↑', '→', '↓', '↔', '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−',
            '√', '∞', '∫', '≈', '≠', '≤', '≥', '◊', '/', '\\', '^', '$', '€', '¿?', '?', '.', ',', '¡', '!', '%', '&', '(', ')', '=',
            '*', '[', ']', '>', '<', '¬', '·', '¿', '³', '¨', '•');

        $caracteres_no_validos_nombre = array(
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '@', '#', '+', '|', '£', '¥', '§', '©', '®', '±', '²', '³', 'µ', '¶',
            '¼', '½', '¾', 'Ø', 'Γ', 'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
            'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω', 'ϊ', 'ϋ', 'ύ', 'ώ', 'Б',
            'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п',
            'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю', 'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ',
            'Ѵ', 'ѵ', 'Ґ', 'ґ', 'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '•', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '№', '℮', '⅓', '⅔', '⅕', '⅖',
            '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', '←', '↑', '→', '↓', '↔', '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−',
            '√', '∞', '∫', '≈', '≠', '≤', '≥', '◊', '/', '\\', '^', '$', '€', '¿?', '?', '.', ',', '¡', '!', '%', '&', '(', ')', '=',
            '*', '[', ']', '{', '}', ';', ':', '_', 'ª', 'º', '"', '>', '<', '¬', '·', '¿');


        sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));

        unset($this['slug'], $this['created_at'], $this['updated_at'], $this['fecha_activacion'], $this['fecha_activacion'], $this['fecha_referendum'], $this['fecha_revision'], $this['fecha_deliberacion'], $this['fecha_observacion'], $this['fecha_cerrado'], $this['fecha_rechazado'], $this['fecha_nulo'], $this['revision_last_state_id'], $this["destacado"], $this["fecha_destacado"], $this['dividendo'], $this['active_reason'], $this['incidencia'], $this['user_id'], $this['profesional_estado_id']);


        $this->embedRelation('profesionalGoogleMap', 'ProfesionalGoogleMapForm');

        $letter_id = sfContext::getInstance()->getRequest()->getParameter('letter_id', '');

        if (!$letter_id)
            $profesional_letter = new ProfesionalLetter();
        else {
            $profesional_letter = Doctrine::getTable('ProfesionalLetter')->find($letter_id);
        }

        $profesionalLetter = new ProfesionalLetterBackendForm($profesional_letter);

        $asProfesional = $this->getObject()->getData();
        $oUnoProfesional = Doctrine::getTable('ProfesionalTipoUno')->find($asProfesional['profesional_tipo_uno_id']);
        $oDosProfesional = Doctrine::getTable('ProfesionalTipoDos')->find($asProfesional['profesional_tipo_dos_id']);
        $oTresProfesional = Doctrine::getTable('ProfesionalTipoTres')->find($asProfesional['profesional_tipo_tres_id']);
        $oRtypeProfesional = Doctrine::getTable('RoadType')->find($asProfesional['road_type_id']);
        $oStateProfesional = Doctrine::getTable('States')->find($asProfesional['states_id']);
        $oCityProfesional = Doctrine::getTable('City')->find($asProfesional['city_id']);
        $oTresName = ($asProfesional['profesional_tipo_tres_id'] != '' && $oTresProfesional) ? $oTresProfesional->getName() : '';

        $this->embedForm('ProfesionalLetter', $profesionalLetter);
        //$this->embedRelation('alertas', 'AlertasForm');

        if (($this->getObject()->getStates() != "Toda España" && $this->getObject()->getAddress()) || ($this->getObject()->getStates() == "Toda España" && $this->getObject()->getAddress())) {
            $this->widgetSchema['address'] = new audWidgetFormJQueryAutocompleterInField(array(
                'url' => url_for('@profesional_autocomplete_direccion'),
                    ), array('maxlength' => 70, 'class' => 'tamano_70_char'));
            $this->widgetSchema['address']->setAttribute('disabled', 'disabled');

            $this->validatorSchema['address'] = new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 70, 'required' => false), array('invalid' => __('Esa dirección no es válida.'))),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_direccion, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array('required' => true), array('required' => __('No has incluido la dirección del profesional.'),
                'invalid' => __('Esa dirección no es válida.')
                    )
            );
        } else {
            $this->widgetSchema['address'] = new sfWidgetFormInputHidden();
        }

        if (($this->getObject()->getStates() != "Toda España" && $this->getObject()->getNumero()) || ($this->getObject()->getStates() == "Toda España" && $this->getObject()->getNumero())) {
            $this->widgetSchema['numero'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_char'));

            $this->widgetSchema['numero']->setAttribute('disabled', 'disabled');

            $this->validatorSchema['numero'] = new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 6, 'required' => true)),
                new sfValidatorNombres(array('caracteres_no_validos' => 'caracteres_no_validos_numero', 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array('required' => true), array('required' => htmlentities('No has incluido un número en la dirección del profesional.'), 'invalid' => __('Ese Nº no es válido.'))
            );

            $this->validatorSchema['numero']->setOption('required', true);
            $this->validatorSchema['numero']->setMessage('required', 'No has incluido un Nº.');
        } else {
            $this->widgetSchema['numero'] = new sfWidgetFormInputHidden();
            $this->validatorSchema['numero'] = new sfValidatorPass();
        }

        if (($this->getObject()->getStates() != "Toda España" && $this->getObject()->getRoadTypeId()) || ($this->getObject()->getStates() == "Toda España" && $this->getObject()->getRoadTypeId())) {
            $this->widgetSchema['road_type_id'] = new sfWidgetFormInputText(array(), array('value' => ($oRtypeProfesional ? $oRtypeProfesional->getName() : ''), 'class' => 'tamano_70_char tamano_dark_color'));
            $this->widgetSchema['road_type_id']->setAttribute('disabled', 'disabled');
        } else {
            $this->widgetSchema['road_type_id'] = new sfWidgetFormInputHidden();
        }


        $this->widgetSchema['piso'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'class' => 'tamano_2_char'));
        $this->widgetSchema['puerta'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_char'));

        $this->widgetSchema['first_name'] = new audWidgetFormJQueryAutocompleterInField(array(
            'url' => url_for('@empresa_autocomplete_name')
                ), array('maxlength' => 70, 'class' => 'tamano_70_char'));

        $this->widgetSchema['last_name_one'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_70_char'));
        $this->widgetSchema['last_name_two'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_70_char'));

        /* $this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => 'Selecciona Usuario'));
          $this->setValidators['user_id']  = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User')));
          $this->validatorSchema["user_id"]->setMessage("required", 'Necesitas selecciona un Usuario.');

          $this->getWidgetSchema()->moveField('user_id', sfWidgetFormSchema::AFTER, 'first_name'); */

        $this->widgetSchema['profesional_tipo_uno_id'] = new sfWidgetFormInputText(array(), array('value' => ($oUnoProfesional ? $oUnoProfesional->getName() : ''), 'class' => 'tamano_70_char tamano_dark_color'));
        $this->widgetSchema['profesional_tipo_dos_id'] = new sfWidgetFormInputText(array(), array('value' => ($oDosProfesional ? $oDosProfesional->getName() : ''), 'class' => 'tamano_70_char tamano_dark_color'));

        if ($this->getObject()->getProfesionalTipoTresId()) {
            $this->widgetSchema['profesional_tipo_tres_id'] = new sfWidgetFormInputText(array(), array('value' => $oTresName, 'class' => 'tamano_70_char tamano_dark_color'));
            $this->widgetSchema['profesional_tipo_tres_id']->setAttribute('disabled', 'disabled');
        } else {
            $this->widgetSchema['profesional_tipo_tres_id'] = new sfWidgetFormInputHidden();
        }

        $this->widgetSchema['states_id'] = new sfWidgetFormInputText(array(), array('value' => ($oStateProfesional ? $oStateProfesional->getName() : ''), 'class' => 'tamano_70_char tamano_dark_color'));
        $this->widgetSchema['city_id'] = new sfWidgetFormInputText(array(), array('value' => is_object($oCityProfesional) ? $oCityProfesional->getName() : '', 'class' => 'tamano_70_char tamano_dark_color'));

        /* $this->widgetSchema['profesional_estado_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalEstado'), 'table_method' => 'getEstedioName','add_empty' => 'Selecciona estado','label'=>'Estado'));
          $this->setValidators['profesional_estado_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProfesionalEstado'), 'column' => 'id'));
          $this->validatorSchema["profesional_estado_id"]->setMessage("required", 'Necesitas seleccionar un estado.');

          if($this->isNew())
          $this->setDefault("profesional_estado_id", 1); */

        // pila de validators...
        $this->widgetSchema['email'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_70_char tamano_dark_color'));
        $this->validatorSchema['email'] = new sfValidatorEmail(array('required' => false, 'trim' => true), array('invalid' => 'Ese correo electrónico no es válido.'));

        //$this->validatorSchema['valida'] = new sfValidatorChoice(array('choices' => array_keys($choices)));


        $this->setValidator('first_name', new sfValidatorAnd(array(
            new sfValidatorString(array('required' => true, 'min_length' => 2, 'max_length' => 70), array('required' => __('No has incluido el nombre del profesional.'), 'invalid' => __('Ese nombre no es válido.'))),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', "ñ", 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')), array('invalid' => __('Ese nombre no es válido.')))
                ), array(), array('required' => __('No has incluido el nombre del profesional.'), 'invalid' => __('Ese nombre no es válido.'))));



        $this->validatorSchema['last_name_one'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'min_length' => 2), array('required' => 'No has incluido el primer apellido del profesional.', 'invalid' => 'Ese apellido no es válido.')),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', "ñ", 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array(), array('required' => __('No has incluido el primer apellido del profesional.'), 'invalid' => __('Ese apellido no es válido.')));

        $this->validatorSchema['last_name_two'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'min_length' => 2), array('required' => 'No has incluido el segundo apellido del profesional.', 'invalid' => 'Ese apellido no es válido.')),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array(), array('required' => __('No has incluido el segundo apellido del profesional.'), 'invalid' => __('Ese apellido no es válido.')));






        $this->validatorSchema['piso'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 6, 'required' => false)),
            new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_direccion, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('invalid' => __('Ese Piso no es válido.'))
        );

        $this->validatorSchema['puerta'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 6, 'required' => false)),
            new sfValidatorNombres(array(
                'caracteres_no_validos' => $caracteres_no_validos_direccion, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('invalid' => __('Esa Puerta no es válida.'))
        );

        $this->widgetSchema['telefono'] = new sfWidgetFormInputText(array(), array('maxlength' => 9, 'class' => 'tamano_9_char'));
        $this->validatorSchema['telefono'] = new sfValidatorString(array('required' => false, 'min_length' => 9, 'max_length' => 9, 'trim' => true), array('required' => __('Ese teléfono no es válido.')));
        $this->validatorSchema['telefono'] = new sfValidatorRegex(array('pattern' => '/^([1]-)?[0-9]{9}$/i', 'required' => false), array('invalid' => __('Ese teléfono no es válido.')));
        //$this->validatorSchema['numero']->setOption('required', true);
        //$this->validatorSchema['numero']->setMessage('required', 'No has incluido un Nº.');

        $this->validatorSchema['profesional_tipo_uno_id'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['profesional_tipo_dos_id'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['profesional_tipo_tres_id'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['road_type_id'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['states_id'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['city_id'] = new sfValidatorString(array('required' => false));
        $this->widgetSchema['featured_order'] = new sfWidgetFormInputText(array(), array('maxlength' => 2, 'class' => 'tamano_1_char tamano_dark_color'));

        $this->validatorSchema['profesionalGoogleMap']['address']->setMessage('required', 'Para publicar una empresa/entidad en la lista blanca necesitas asociarle una ubicación.');

        //post validator
        $this->mergePreValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkProvincia')))
        );

        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkLista')))
        );

        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkActividad')))
        );

        $letterForm = $this->getEmbeddedForm('ProfesionalLetter');

        /* $this->mergePostValidator(
          new sfValidatorCallback(array('callback' => array($this, 'checkDestacados')))
          ); */

        $this->widgetSchema->setLabels(array(
            'name' => __('Título'),
            'user_id' => 'Usuario',
            'incidencia' => __('Tu desaprobación'),
            'plan_accion' => __('Plan de acción'),
            'first_name' => __('Nombre'),
            'last_name_one' => __('Apellido 1'),
            'last_name_two' => __('Apellido 2'),
            'direccion' => __('Dirección'),
            'address' => __('Dirección'),
            'email' => __('Correo electrónico'),
            'numero' => __('Nº'),
            'piso' => __('Piso'),
            'puerta' => __('Puerta'),
            'road_type_id' => __('Tipo de vía'),
            'states_id' => __('Provincia'),
            'city_id' => __('Localidad'),
            'telefono' => __('Teléfono'),
            'profesional_tipo_uno_id' => __('Sector profesional'),
            'profesional_tipo_dos_id' => __('Subsector profesional'),
            'profesional_tipo_tres_id' => __('Actividad profesional'),
            'profesionalGoogleMap' => __('Ubicación Googlemap'),
            'incidencia' => __('Recomendación*'), //Tu recomendación
            'ProfesionalLetter' => __('Carta'),
            'featured' => __('Home'),
            'featured_order' => __('Orden Home')
        ));

        $this->widgetSchema['first_name']->setAttribute('disabled', 'disabled');
        $this->widgetSchema['last_name_one']->setAttribute('disabled', 'disabled');
        $this->widgetSchema['last_name_two']->setAttribute('disabled', 'disabled');
        $this->widgetSchema['piso']->setAttribute('disabled', 'disabled');
        $this->widgetSchema['puerta']->setAttribute('disabled', 'disabled');
//        $this->widgetSchema['profesional_estado_id']->setAttribute('disabled', 'disabled');
        //$this->widgetSchema['user_id']->setAttribute('disabled', 'disabled');
        //$this->widgetSchema['road_type_id']->setAttribute('disabled', 'disabled');
        $this->widgetSchema['states_id']->setAttribute('disabled', 'disabled');
        $this->widgetSchema['city_id']->setAttribute('disabled', 'disabled');
        $this->widgetSchema['telefono']->setAttribute('disabled', 'disabled');
        $this->widgetSchema['email']->setAttribute('disabled', 'disabled');
        $this->widgetSchema['profesional_tipo_uno_id']->setAttribute('disabled', 'disabled');
        $this->widgetSchema['profesional_tipo_dos_id']->setAttribute('disabled', 'disabled');
        //$this->widgetSchema['profesional_tipo_tres_id']->setAttribute('disabled', 'disabled');
        //$this->widgetSchema['profesionalGoogleMap']['address']->setAttribute('disabled', 'disabled');


        if (empty($asProfesional['piso'])) {
            unset($this['piso']);
        }
        if (empty($asProfesional['puerta'])) {
            unset($this['puerta']);
        }
        if (empty($asProfesional['telefono'])) {
            unset($this['telefono']);
        }
        if (empty($asProfesional['email'])) {
            unset($this['email']);
        }

        /* if ($letterForm->getObject()->getProfesionalLetterTypeId() == 1) {
          $this->widgetSchema->setPositions(
          array(
          'last_name_one', 'last_name_two', 'first_name', 'road_type_id', 'address', 'numero', 'piso', 'puerta',
          'states_id', 'city_id', 'telefono', 'email', 'profesional_tipo_uno_id', 'profesional_tipo_dos_id', 'profesional_tipo_tres_id', 'id',
          'profesionalGoogleMap', ''
          ));
          } else {
          $this->widgetSchema->setPositions(
          array(
          'last_name_one', 'last_name_two', 'first_name', 'road_type_id', 'address', 'numero', 'piso', 'puerta',
          'states_id', 'city_id', 'telefono', 'email', 'profesional_tipo_uno_id', 'profesional_tipo_dos_id', 'profesional_tipo_tres_id', 'id',
          'profesionalGoogleMap', 'ProfesionalLetter', 'featured', 'featured_order'
          ));
          } */
        //unset($this['featured'], $this['featured_order']);
    }

    public function checkProvincia($validator, $values) {
        if ($values['states_id'] == 1) {
            $this->validatorSchema['city_id']->setOption('required', false);
            $this->validatorSchema['road_type_id']->setOption('required', false);
            $this->validatorSchema['address']->setOption('required', false);
            $this->validatorSchema['numero']->setOption('required', false);
            $this->validatorSchema['profesionalGoogleMap']['address']->setOption('required', false);
        }

        return $values;
    }

    /**
     * Postvalidator que chequea si la empresa está validada y entonces obliga a tener un concurso asociado.
     *
     * @param $validator
     * @param $values
     * @return mixed
     * @throws sfValidatorErrorSchema
     */
    public function checkValida($validator, $values) {
        return $values;
        /** Al final esta validación no se hace pero la dejo porqué no tengo claro que no vuelva a ser necesario. */
        if ($values['valida'] == 1) {
            if (empty($values['concurso_id'])) {
                $error = new sfValidatorError($validator, 'Si la empresa está validada, este campo es requerido.');
                throw new sfValidatorErrorSchema($validator, array('concurso_id' => $error));
            }
        }

        return $values;
    }

    /**
     * Valida en caso que haya actividad que se escoja una.
     *
     * @param $validator
     * @param $values
     */
    public function checkActividad($validator, $values) {
        $errorSchema = new sfValidatorErrorSchema($validator);

        if (!empty($values['profesional_tipo_tres_id'])) {
            return $values;
        }

        if (empty($values['profesional_tipo_dos_id'])) {
            $this->validatorSchema['profesional_tipo_tres_id']->setOption('required', true);
            try {
                $this->validatorSchema['profesional_tipo_tres_id']->clean($values['profesional_tipo_tres_id']);
            } catch (sfValidatorErrorSchema $e) {
                $errorSchema->addErrors($e);
            } catch (sfValidatorError $e) {
                $errorSchema->addError($e, 'profesional_tipo_tres_id');
            }

            if (count($errorSchema)) {
                throw $errorSchema;
            }
        }
        $this->validatorSchema['profesional_tipo_tres_id']->setOption('required', true);

        $subsector_id = $values['profesional_tipo_dos_id'];
        if (ProfesionalTipoDosTable::hasActividad($subsector_id)) {
            $error = new sfValidatorError($validator, 'Has de seleccionar una actividad');
            throw new sfValidatorErrorSchema($validator, array('profesional_tipo_tres_id' => $error));
        }
        return $values;
    }

    public function checkLista(sfValidatorCallback $validator, $values) {
        $errorSchema = new sfValidatorErrorSchema($validator);
        $required = array();

        //si está en una lista... googleMap required...
        if ($values['states_id'] != 1) {

            if ($values['profesionalGoogleMap']['address'] == '') {
                //$errorSchema->addError(new sfValidatorError($validator, 'Para publicar un profesional en el Directorio necesitas asociarle una ubicación.'), 'profesionalGoogleMap');
            }
        }

        if (count($errorSchema)) {
            throw $errorSchema;
        }

        return $values;
    }

    /* public function checkDestacados($validator, $values)
      {
      $newValues = $this->getTaintedValues();
      $defaultValues = $this->getDefaults();
      $profesional = $this->getObject();
      if ($newValues['localidad_id'] != $defaultValues['localidad_id']) {
      //check if destacado...
      if($empresa->isDestacadaPorLocalidad() || $empresa->isDestacadaPorSectorLocalidad()) {
      $invalid = new sfValidatorError($validator, 'Para editar la localidad de esta empresa/entidad, necesitas antes quitarla como destacada.');
      throw new sfValidatorErrorSchema($validator,array($invalid));
      }

      }

      if ($newValues['states_id'] != $defaultValues['states_id']) {
      if ($empresa->isDestacadaPorProvincia() || $empresa->isDestacadaPorSectorProvincia() ) {
      $invalid = new sfValidatorError($validator, 'Para editar la provincia de esta empresa/entidad, necesitas antes quitarla como destacada.');
      throw new sfValidatorErrorSchema($validator,array($invalid));
      }
      }

      if (($newValues['empresa_sector_dos_id'] != $defaultValues['empresa_sector_dos_id']) || ($newValues['empresa_sector_tres_id'] != $defaultValues['empresa_sector_tres_id'])) {
      if ($empresa->isDestacadaPorSector() || $empresa->isDestacadaPorSectorProvincia() || $empresa->isDestacadaPorSectorLocalidad()) {
      $invalid = new sfValidatorError($validator, 'Para editar el subsector o la actividad de esta empresa/entidad, necesitas antes quitarla como destacada.');
      throw new sfValidatorErrorSchema($validator,array($invalid));
      }
      }



      return $values;
      } */

    public function bind(array $taintedValues = null, array $taintedFiles = null) {
        $bReturn = parent::bind($taintedValues, $taintedFiles);

        foreach ($this->embeddedForms as $name => $form) {

            $this->embeddedForms[$name]->isBound = true;
            if (isset($this->values[$name]))
                $this->embeddedForms[$name]->values = $this->values[$name];
        }
        return $bReturn;
    }

    protected function doSave($con = null) {
        $profesional = sfContext::getInstance()->getRequest()->getParameter('profesional');

        $asProfesional = $this->getObject()->getData();
        $gLetterForm = $this->getEmbeddedForm('ProfesionalLetter');
        $gLetterForm->getObject()->setProfesional($this->getObject());
        $gLetterForm->getObject()->setProfesionalLetterTypeId($profesional['ProfesionalLetter']['profesional_letter_type_id']);
        $gLetterForm->getObject()->setName($profesional['ProfesionalLetter']['name']);
        $gLetterForm->getObject()->setDescription($profesional['ProfesionalLetter']['description']);
        $gLetterForm->getObject()->setprofesionalLetterEstadoId($profesional['ProfesionalLetter']['profesional_letter_estado_id']);
        $gLetterForm->getObject()->setProfesionalAproDesproId($profesional['ProfesionalLetter']['profesional_apro_despro_id']);
        $gLetterForm->getObject()->setUserId($profesional['ProfesionalLetter']['user_id']);

        if (isset($profesional['ProfesionalLetter']['plan_accion']))
            $gLetterForm->getObject()->setPlanAccion($profesional['ProfesionalLetter']['plan_accion']);

        if ($profesional['ProfesionalLetter']['profesional_letter_type_id'] == 1)
            ProfesionalLetter::setRecommandationAlert($asProfesional, $this->getObject()->getId(), $gLetterForm->getObject()->getId());
        else
            ProfesionalLetter::setDisapprovalAlert($asProfesional, $this->getObject()->getId(), $gLetterForm->getObject()->getId());

        $gLetterForm->getObject()->save();
        sfConfig::set('profesional_letter_id', $gLetterForm->getObject()->getId());
    }

}
