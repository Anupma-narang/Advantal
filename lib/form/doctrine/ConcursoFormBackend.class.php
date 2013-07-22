<?php

class ConcursoFormBackend extends BaseConcursoForm {

    public function configure() {

        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));  //para las traduciones del formulario
        unset(
                $this["created_at"], $this["updated_at"], $this['producto_id'], $this['empresa_id'], $this['fecha_activacion'], $this['fecha_referendum'], $this['fecha_destacado'], $this['cuestionario_id'], $this['cuestionario_total'], $this['fecha_revision'], $this['fecha_deliberacion'], $this['fecha_observacion'], $this['fecha_rechazado'], $this['fecha_cerrado'], $this['fecha_nulo'], $this['revision_last_state_id']
        );

        $this->type = $this->getObject()->getConcursoTipoId();


        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => $this->getRelatedModelName('States'), 'add_empty' => __('Selecciona provincia'), 'order_by' => array('orden', 'asc')));
        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'City', 'depends' => 'States', 'add_empty' => __('Selecciona localidad')/* , 'ajax' => true */));


        $this->getWidgetSchema()->moveField('concurso_tipo_id', sfWidgetFormSchema::BEFORE, 'concurso_estado_id');

        //   $this->setDefault("user_id", sfContext::getInstance()->getUser()->getGuardUser()->getId());
        //user_id
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User')));

        //username
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array("default" => (!$this->isNew() ? $this->getObject()->getUser()->getUsername() : "")), array('id' => 'concurso_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->validatorSchema['user_name'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'column' => 'username'), array('required' => 'Necesitas seleccionar un Usuario.', 'invalid' => 'Ese Usuario no es válido.'));



        $this->widgetSchema['road_type_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'RoadType',
                    'order_by' => array('orden', 'asc'),
                    'add_empty' => __('Selecciona vía')), array('class' => 'select_pequeño'));

        if ($this->type == 1) {
            unset($this["producto_id"]);
            $this->setDefault("concurso_tipo_id", 1);

            $this->embedRelation('Empresa as Empresa/Entidad', 'EmpresaAdminForm');
            $this->widgetSchema['concurso_address'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
            //$this->validatorSchema['concurso_address'] = new sfValidatorString(array('max_length' => 32, 'required' => true),array('required' => 'No has incluido una dirección.'));
            $caracteres_no_validos_direccion = array(
                '@', '#', '+', '|', '£', '¥', '§', '©', '®', '±', '²', '³', 'µ', '¶', '{', '}', ';', ':', '_', '"',
                '¼', '½', '¾', 'Ø', 'Γ', 'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
                'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω', 'ϊ', 'ϋ', 'ύ', 'ώ', 'Б',
                'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п',
                'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю', 'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ',
                'Ѵ', 'ѵ', 'Ґ', 'ґ', 'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '·', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '№', '℮', '⅓', '⅔', '⅕', '⅖',
                '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', '←', '↑', '→', '↓', '↔', '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−',
                '√', '∞', '∫', '≈', '≠', '≤', '≥', '◊', '/', '\\', '^', '$', '€', '¿?', '?', '.', ',', '¡', '!', '%', '&', '(', ')', '=',
                '*', '[', ']', '>', '<', '¬', '·', '¿', '³', '¨', '•'
            );
            $this->validatorSchema['concurso_address'] = new sfValidatorAnd(array(
                        new sfValidatorString(
                                array(
                                    'max_length' => 70,
                                    'required' => true), array(
                            'invalid' => __('Esa dirección no es válida.')
                        )),
                        //new sfValidatorRegex(array('pattern' =>"/[^\"()·$%=?¿^']+$/i"),array('invalid' => __('Esa dirección no es válida.')))
                        new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_direccion, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/",
                            'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                            ), array('required' => true), array('required' => __('No has incluido una dirección.'), 'invalid' => __('Esa dirección no es válida.')));

            $caracteres_no_validos_numero = $caracteres_no_validos_direccion;
            unset($caracteres_no_validos_numero[array_search('/', $caracteres_no_validos_numero)]); // para número sí permitimos la barra
            $this->widgetSchema['concurso_numero'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
            $this->validatorSchema['concurso_numero'] = new sfValidatorAnd(array(
                        new sfValidatorString(
                                array('max_length' => 6, 'required' => false)),
                        //				new sfValidatorRegex(array('pattern' =>"/^[a-z\s\áéíóúAÉÍÓÚÑñ\d-ªº']+$/i"),array('invalid' => __('Sólo puedes introducir números, letras y guiones.')))
                        new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_numero, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/",
                            'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                            ), array('required' => true), array('required' => __('No has incluido un Nº.'), 'invalid' => __('Ese Nº no es válido.')));

            $caracteres_no_validos_piso_puerta = $caracteres_no_validos_direccion;
            unset($caracteres_no_validos_piso_puerta[array_search('.', $caracteres_no_validos_piso_puerta)]); // para piso y puerta sí permitimos el punto
            $this->widgetSchema['concurso_piso'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'class' => 'tamano_2_c'));
            $this->validatorSchema['concurso_piso'] = new sfValidatorAnd(array(
                        new sfValidatorString(
                                array('max_length' => 6, 'required' => false)),
                        //new sfValidatorRegex(array('pattern' =>"/^[a-z\s\áéíóúAÉÍÓÚÑñ\d-\ºª']+$/i"),array('invalid' => __('Sólo puedes introducir números, letras y guiones.')))
                        new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/",
                            'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                            ), array('required' => false), array('invalid' => __('Ese Piso no es válido.')));

            $this->widgetSchema['concurso_puerta'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
            $this->validatorSchema['concurso_puerta'] = new sfValidatorAnd(array(
                        new sfValidatorString(
                                array('max_length' => 6, 'required' => false)),
                        new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/",
                            'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                            ), array('required' => false), array('invalid' => __('Esa Puerta no es válida.')));

            $this->widgetSchema["concurso_categoria_id"] = new sfWidgetFormDoctrineChoice(array(
                        "model" => $this->getRelatedModelName("ConcursoCategoria"),
                        "add_empty" => __('Selecciona categoría'),
                        "table_method" => "selectTipoCategoria_Empresa"
                    ));

            $this->validatorSchema['road_type_id']->setOption("required", true);
            $this->validatorSchema['road_type_id']->setMessage('required', 'No has seleccionado un tipo de vía.');
            $this->validatorSchema['states_id']->setMessage('required', 'No has seleccionado una provincia.');
            $this->validatorSchema["city_id"]->setOption("required", true);
            $this->validatorSchema["city_id"]->setMessage("required", 'No has seleccionado una localidad.');
        } else if ($this->type == 2) {
            unset(
                    $this["empresa_id"], $this['concurso_city_id'], $this['road_type_id'], $this['states_id'], $this['city_id'], $this['concurso_address'], $this['concurso_numero'], $this['concurso_piso'], $this['concurso_puerta']
            );
            $this->setDefault("concurso_tipo_id", 2);

//			$this->embedRelation('Producto');
            $this->embedRelation('Producto', 'ProductoAdminForm');

            $this->widgetSchema["concurso_categoria_id"] = new sfWidgetFormDoctrineChoice(array(
                        "model" => $this->getRelatedModelName("ConcursoCategoria"),
                        "add_empty" => __('Selecciona categoría'),
                        "table_method" => "selectTipoCategoria_Producto"
                    ));
        }

        $this->validatorSchema['concurso_categoria_id'] = new sfValidatorDoctrineChoice(array(
                    'model' => $this->getRelatedModelName('ConcursoCategoria'),
                    'required' => true), array('required' => 'No has seleccionado una categoría del concurso.'));

        if (!$contribucion = $this->getObject()->getContribucionPrincipal()) {
            $contribucion = new Contribucion();
            $contribucion->Concurso = $this->getObject();
        }
        $formulario = new ContribucionAdminForm($contribucion);
        $this->embedForm("contribución inicial", $formulario);

        /* 		$this->widgetSchema['incidencia'] = new sfWidgetFormTextareaTinyMCE(array(
          'config' => sfConfig::get('app_tiny_mce_backend')
          )); */
        $this->widgetSchema['incidencia'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300));

        $this->validatorSchema['incidencia'] = new sfValidatorString(array('max_length' => 20000), array('max_length' => 'Has superado el espacio permitido para la descripción de la incidencia.'));
        $this->validatorSchema["incidencia"]->setMessage("required", 'No has incluido una descripción de la incidencia.');
        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_60_c'));
        $this->validatorSchema['name']->setMessage("required", 'No has incluido un título de la incidencia.');

        $this->widgetSchema['featured'] = new sfWidgetFormInputCheckbox();
        $this->widgetSchema['featured_order'] = new sfWidgetFormInputText(array(), array('maxlength' => 2, 'class' => 'tamano_2_c'));
        $this->validatorSchema['featured'] = new sfValidatorBoolean(array('required' => false));
        $this->validatorSchema['featured_order'] = new sfValidatorInteger(array('required' => false), array('invalid' => 'Sólo puedes introducir números.'));

        $archivo_1 = new ConcursoArchivo();
        $archivo_1->Concurso = $this->getObject();
        $formulario_1 = new ConcursoArchivoFormBackend($archivo_1);
        $this->embedForm("archivo_1", $formulario_1);

        $archivo_2 = new ConcursoArchivo();
        $archivo_2->Concurso = $this->getObject();
        $formulario_2 = new ConcursoArchivoFormBackend($archivo_2);
        $this->embedForm("archivo_2", $formulario_2);

        $archivo_3 = new ConcursoArchivo();
        $archivo_3->Concurso = $this->getObject();
        $formulario_3 = new ConcursoArchivoFormBackend($archivo_3);
        $this->embedForm("archivo_3", $formulario_3);

        $archivo_4 = new ConcursoArchivo();
        $archivo_4->Concurso = $this->getObject();
        $formulario_4 = new ConcursoArchivoFormBackend($archivo_4);
        $this->embedForm("archivo_4", $formulario_4);

        $archivo_5 = new ConcursoArchivo();
        $archivo_5->Concurso = $this->getObject();
        $formulario_5 = new ConcursoArchivoFormBackend($archivo_5);
        $this->embedForm("archivo_5", $formulario_5);


        $this->widgetSchema->setLabels(array(
            'empresa_id' => __('Empresa/Entidad'),
            'concurso_address' => __('Dirección'),
            'producto_id' => __('Producto'),
            'user_name' => 'Usuario',
            'marca' => __('Marca'),
            'producto_tipo_uno_id' => __('Sector del producto'),
            'producto_tipo_dos_id' => __('Subsector del producto'),
            'producto_tipo_tres_id' => __('Tipo de producto'),
            'name' => __('Título de la incidencia'),
            'incidencia' => __('Descripción de la incidencia'),
            'concurso_categoria_id' => __('Categoría del concurso'),
            'road_type_id' => __('Tipo de vía'),
            'states_id' => __('Provincia'),
            'city_id' => __('Localidad'),
            'empresa_sector_uno_id' => __('Sector de la empresa/entidad'),
            'empresa_sector_dos_id' => __('Subsector de la empresa/entidad'),
            'empresa_sector_tres_id' => __('Actividad de la empresa/entidad'),
            'slug' => __('Url-alias'),
            'featured' => __('Home'),
            'featured_order' => __('Orden Home')
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->validatorSchema->setOption('filter_extra_fields', false);

        $this->getWidgetSchema()->moveField('user_name', sfWidgetFormSchema::AFTER, 'name');
    }

}