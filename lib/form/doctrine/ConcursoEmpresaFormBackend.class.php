<?php

class ConcursoEmpresaFormBackend extends BaseConcursoForm {

    public function configure() {
        if ($this->isNew()) {
            $this->configureNewForm();
        } else {
            $this->configureEditForm();
        }
        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->validatorSchema->setOption('filter_extra_fields', false);
    }

    public function configureNewForm() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N', 'Url'));  //para las traduciones del formulario
        unset($this["created_at"], $this["updated_at"], $this["concurso_tipo_id"]);
        $choices = array(0 => 'Pendiente de revisar', 1 => 'Revisada');
        $caracteres_no_validos_empresa = array(
            'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
            'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω',
            'ϊ', 'ϋ', 'ύ', 'ώ', 'Б', 'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы',
            'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п', 'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю',
            'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ', 'Ѵ', 'ѵ', 'Ґ', 'ґ',
            'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '•', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '←', '↑', '→', '↓', '↔',
            '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−', '√', '∞', '∫', '≈', '◊', '⅓',
            '⅔', '⅕', '⅖', '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', 'Ø', '©', '¶', '℮', '¼', '½', '¾', 'µ'
        );
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


        $this->widgetSchema['gmap_check'] = new sfWidgetFormInputHidden(array('default' => ($this->getObject()->isNew() ? 'false' : 'true')));
        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_60_c'));
        //$this->widgetSchema["concurso_categoria_id"] = new sfWidgetFormDoctrineChoice(array("model" => $this->getRelatedModelName("ConcursoCategoria"), "add_empty" => __('Selecciona categoría'), 'order_by' => array('orden', 'asc'), "table_method" => "selectTipoCategoria_Empresa"));
        $q = Doctrine_Query::create()
                ->from('ConcursoCategoria')
                ->where('concurso_tipo_id = 1');
        $this->widgetSchema['concurso_categoria_id'] = new sfWidgetFormDoctrineChoice(array('label' => 'Categoría', 'model' => $this->getRelatedModelName('ConcursoCategoria'), 'add_empty' => 'Selecciona categoría', 'order_by' => array('name', 'asc'), 'query' => $q));

        $this->widgetSchema['empresa_nombre'] = new audWidgetFormJQueryAutocompleterInField(array('url' => url_for('@empresa_autocomplete_name')), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['road_type_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'RoadType', 'order_by' => array('orden', 'asc'), 'add_empty' => __('Selecciona vía')), array('class' => 'select_pequeño'));
        $this->widgetSchema['concurso_address'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['concurso_numero'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
        $this->widgetSchema['concurso_piso'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'style' => 'width:16px'));
        $this->widgetSchema['concurso_puerta'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
        $this->widgetSchema['featured_order'] = new sfWidgetFormInputText(array(), array('maxlength' => 2, 'class' => 'tamano_2_c'));


        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => $this->getRelatedModelName('States'), 'add_empty' => __('Selecciona provincia'), 'order_by' => array('orden', 'asc')));
        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'City', 'depends' => 'States', 'add_empty' => __('Selecciona localidad')/* , 'ajax' => true */));
        $this->widgetSchema['resumen'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_resumen', 'max_length' => 1000));
        $this->widgetSchema['plan_accion'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_plan_accion', 'max_length' => 43000));
        $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'EmpresaSectorUno', 'order_by' => array('orden', 'asc'), 'add_empty' => 'Selecciona sector'));
        $this->widgetSchema['empresa_sector_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'EmpresaSectorDos', 'order_by' => array('orden'), 'depends' => 'EmpresaSectorUno', 'ajax' => true, 'order_by' => array('orden', 'asc'), 'add_empty' => 'Selecciona subsector '));
        $this->widgetSchema['empresa_sector_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'EmpresaSectorTres', 'order_by' => array('orden'), 'depends' => 'EmpresaSectorDos', 'ajax' => true, 'order_by' => array('orden', 'asc'), 'add_empty' => 'Selecciona actividad '));

        for ($i = 1; $i <= 5; $i++) {
            $this->widgetSchema['archivo_' . $i] = new sfWidgetFormInputFileEditable(array(
                        'file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/'
                        . basename(sfConfig::get('sf_documents_dir')) . '/',
                        'is_image' => false,
                        'edit_mode' => false,
                        'template' => ''
                    ));
        }

        $this->validatorSchema['name']->setMessage("required", 'No has incluido un título de la incidencia.');
        $this->widgetSchema['incidencia'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300));
        $this->validatorSchema["incidencia"]->setMessage("required", 'No has incluido una descripción de la incidencia.');
        $this->validatorSchema['concurso_categoria_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCategoria'), 'required' => true), array('required' => 'No has seleccionado una categoría del concurso.'));
        $this->setValidator('empresa_nombre', new sfValidatorAnd(array(
                    new sfValidatorString(
                            array('required' => true, 'trim' => false, 'min_length' => 1, 'max_length' => 70), array('required' => __('No has incluido una empresa o entidad.'), 'min_length' => __('La empresa o entidad debe tener entre 1 y 70 caracteres, con espacios en blanco.'), 'max_length' => __('La empresa o entidad debe tener entre 1 y 70 caracteres, con espacios en blanco.'))
                    ),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_empresa), array('invalid' => __('Esa empresa/entidad no es válida.')))
                        ), array(), array('required' => __('No has incluido una empresa o entidad.'))));
        $this->validatorSchema['road_type_id']->setOption("required", true);
        $this->validatorSchema['road_type_id']->setMessage('required', 'No has seleccionado un tipo de vía.');

        $this->validatorSchema['concurso_address'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 70, 'required' => true), array('invalid' => __('Esa dirección no es válida.'))),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_direccion, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => true), array('required' => __('No has incluido una dirección.'), 'invalid' => __('Esa dirección no es válida.')));

        $caracteres_no_validos_numero = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_numero[array_search('/', $caracteres_no_validos_numero)]); // para número sí permitimos la barra
        $this->validatorSchema['concurso_numero'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 6, 'required' => false)),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_numero, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => true), array('required' => __('No has incluido un Nº.'), 'invalid' => __('Ese Nº no es válido.')));

        $caracteres_no_validos_piso_puerta = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_piso_puerta[array_search('.', $caracteres_no_validos_piso_puerta)]); // para piso y puerta sí permitimos el punto
        $this->validatorSchema['concurso_piso'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 6, 'required' => false)),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => false), array('invalid' => __('Ese Piso no es válido.')));
        $this->validatorSchema['concurso_puerta'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 6, 'required' => false)),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => false), array('invalid' => __('Esa Puerta no es válida.')));
        $this->validatorSchema["states_id"]->setOption("required", true);
        $this->validatorSchema['states_id']->setMessage('required', __('No has seleccionado una provincia.'));
        $this->validatorSchema["city_id"]->setOption("required", true);
        $this->validatorSchema["city_id"]->setMessage("required", __('No has seleccionado una localidad.'));
        $this->validatorSchema['plan_accion'] = new sfValidatorString(array('required' => true), array('required' => 'No has incluido tu Plan de acción.'));
        $this->validatorSchema["resumen"] = new sfValidatorString(array('required' => true), array('required' => 'No has incluido el resumen de tu Plan de acción.'));
        $this->validatorSchema['empresa_sector_uno_id'] = new sfValidatorDoctrineChoice(array('model' => 'EmpresaSectorUno', 'required' => false));
        $this->validatorSchema['empresa_sector_uno_id']->setOption('required', true);
        $this->validatorSchema['empresa_sector_uno_id']->setMessage('required', 'No has seleccionado un sector de la empresa o entidad.');
        $this->validatorSchema['empresa_sector_dos_id'] = new sfValidatorDoctrineChoice(array('model' => 'EmpresaSectorDos', 'required' => true));
        $this->validatorSchema['empresa_sector_dos_id']->setMessage('required', 'No has seleccionado un subsector de la empresa o entidad.');
        $this->validatorSchema['featured_order'] = new sfValidatorInteger(array('required' => false));
        $this->validatorSchema['empresa_sector_tres_id'] = new sfValidatorDoctrineChoice(array('model' => 'EmpresaSectorTres', 'required' => true));
        //$this->validatorSchema['empresa_sector_tres_id']->setOption('required', false);
        $this->validatorSchema['empresa_sector_tres_id']->setMessage('required', 'No has seleccionado una actividad.');
        $this->widgetSchema['codigopostal'] = new sfWidgetFormInputText(array(), array('maxlength' => 5, 'class' => 'tamano_5_c_1'));
        $this->validatorSchema['codigopostal'] = new sfValidatorRegex(array(
                    'pattern' => '#^(\d{5})$#',
                    'required' => false,
                        ), array('invalid' => 'Ese C.P. no es válido.')
        );


        for ($i = 1; $i <= 5; $i++) {
            $this->validatorSchema['archivo_' . $i] = new sfValidatorFile(array(
                        'required' => false,
                        'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/',
                        'mime_type_guessers' => array(array('fakemime', 'detect'))
                    ));
        }
        //user_id
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User')));

        //username
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array("default" => (!$this->isNew() ? $this->getObject()->getUser()->getUsername() : "")), array('id' => 'concurso_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->validatorSchema['user_name'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'column' => 'username'), array('required' => 'Necesitas seleccionar un Usuario.', 'invalid' => 'Ese Usuario no es válido.'));

        $this->widgetSchema->setLabels(array(
            'name' => __('Título'),
            'user_id' => __('Usuario'),
            'user_name' => __('Usuario'),
            'incidencia' => __('Descripción de la incidencia'),
            'concurso_estado_id' => __('Estado'),
            'concurso_categoria_id' => __('Categoría'),
            'empresa_nombre' => __('Empresa/Entidad'),
            'road_type_id' => __('Tipo de vía'),
            'states_id' => __('Provincia'),
            'city_id' => __('Localidad'),
            'codigopostal' => __('C.P.'),
            'concurso_address' => __('Dirección'),
            'concurso_numero' => __('Nº'),
            'concurso_piso' => __('Piso'),
            'concurso_puerta' => __('Puerta'),
            'dividendo' => 'Puntos totales',
            'divisor' => 'Auditorías realizadas',
            'lista_cuestionario_id' => __('Cuestionario asociado'),
            'resumen' => __('Resumen del Plan de acción'),
            'plan_accion' => __('Plan de acción'),
            'slug' => __('Url-alias'),
            'featured' => __('Home'),
            'featured_order' => __('Orden Home'),
            'empresa_sector_uno_id' => __('Sector'),
            'empresa_sector_dos_id' => __('Subsector'),
            'empresa_sector_tres_id' => __('Actividad')
        ));

        $this->validatorSchema->setPreValidator(new sfValidatorCallback(array("callback" => array($this, "preValidate"))));
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'featuredCallback'))));
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidate'))));
        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkLista')))
        );
    }

    public function configureEditForm() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N', 'Url'));  //para las traduciones del formulario

        unset($this["created_at"], $this["updated_at"], $this["concurso_tipo_id"]);

        $choices = array(0 => 'Pendiente de revisar', 1 => 'Revisada');
        $caracteres_no_validos_empresa = array(
            'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
            'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω',
            'ϊ', 'ϋ', 'ύ', 'ώ', 'Б', 'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы',
            'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п', 'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю',
            'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ', 'Ѵ', 'ѵ', 'Ґ', 'ґ',
            'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '•', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '←', '↑', '→', '↓', '↔',
            '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−', '√', '∞', '∫', '≈', '◊', '⅓',
            '⅔', '⅕', '⅖', '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', 'Ø', '©', '¶', '℮', '¼', '½', '¾', 'µ'
        );
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


        $this->widgetSchema['gmap_check'] = new sfWidgetFormInputHidden(array('default' => ($this->getObject()->isNew() ? 'false' : 'true')));
        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_60_c'));

        $q = Doctrine_Query::create()->from('ConcursoCategoria')->where('concurso_tipo_id = 1');

        $this->widgetSchema['concurso_categoria_id'] = new sfWidgetFormDoctrineChoice(array('label' => 'Categoría', 'model' => $this->getRelatedModelName('ConcursoCategoria'), 'add_empty' => 'Selecciona categoría', 'order_by' => array('name', 'asc'), 'query' => $q));

        $this->widgetSchema['incidencia'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300));
        $this->widgetSchema['empresa_nombre'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['road_type_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'RoadType', 'order_by' => array('orden', 'asc'), 'add_empty' => __('Selecciona vía')), array('class' => 'select_pequeño'));
        $this->widgetSchema['concurso_address'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['concurso_numero'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
        $this->widgetSchema['concurso_piso'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'style' => 'width:16px'));
        $this->widgetSchema['concurso_puerta'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
        $this->widgetSchema['featured_order'] = new sfWidgetFormInputText(array(), array('maxlength' => 2, 'class' => 'tamano_2_c'));
        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => $this->getRelatedModelName('States'), 'add_empty' => __('Selecciona provincia'), 'order_by' => array('orden', 'asc')));
        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'City', 'depends' => 'states_id', 'add_empty' => __('Selecciona localidad')/* , 'ajax' => true */));
        $this->widgetSchema['resumen'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_resumen', 'max_length' => 1000));
        $this->widgetSchema['plan_accion'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_plan_accion', 'max_length' => 43000));
        $this->widgetSchema['created_at'] = new sfWidgetFormDateTime(array('date' => array('format' => '%day%/%month%/%year%')));

        $this->widgetSchema['valida'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->widgetSchema['codigopostal'] = new sfWidgetFormInputText(array(), array('maxlength' => 5, 'class' => 'tamano_5_c_1'));
        $this->widgetSchema['persona_contacto'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['email'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['telefono'] = new sfWidgetFormInputText(array(), array('maxlength' => 9, 'class' => 'tamano_8_c_1'));
        $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'EmpresaSectorUno', 'order_by' => array('orden', 'asc'), 'add_empty' => 'Selecciona sector'));
        $this->widgetSchema['empresa_sector_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'EmpresaSectorDos', 'order_by' => array('orden', 'asc'), 'depends' => 'EmpresaSectorUno', 'ajax' => true, 'order_by' => array('orden', 'asc'), 'add_empty' => 'Selecciona subsector '));
        $this->widgetSchema['empresa_sector_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'EmpresaSectorTres', 'order_by' => array('orden', 'asc'), 'depends' => 'EmpresaSectorDos', 'ajax' => true, 'order_by' => array('orden', 'asc'), 'add_empty' => 'Selecciona actividad '));
        $this->widgetSchema['lista'] = new sfWidgetFormChoice(array('choices' => sfConfig::get('app_listas_tipos')));
        $this->widgetSchema['comentario_inicial'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'error_max_length', 'max_length' => 3000));
        $this->widgetSchema['texto_lista_negra'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'error_max_length_negra', 'max_length' => 3000));
        $this->widgetSchema['googlemap'] = new sfWidgetFormGmap(array(), array(
                    'map.address' => $this->getObject()->getEmpresa()->getGoogleMap()->getAddress(),
                    'map.lat' => $this->getObject()->getEmpresa()->getGoogleMap()->getLat(),
                    'map.lng' => $this->getObject()->getEmpresa()->getGoogleMap()->getLng(),
                    'map.zoom' => $this->getObject()->getEmpresa()->getGoogleMap()->getZoom()
                ));
        $files = array();
        $i = 1;
        foreach ($this->getObject()->ArchivosSubidos() as $file) {
            $files[$i] = $file->getFile();
            $i++;
        }
        for ($i = 1; $i <= 5; $i++) {
            $this->widgetSchema['archivo_' . $i] = new sfWidgetFormInputFileEditable(array(
                        //'file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . (isset($files[$i]) ? $files[$i] : ''),
                        'file_src' => (isset($files[$i]) ? $files[$i] : ''),
                        'is_image' => false,
                        'edit_mode' => isset($files[$i]) && strlen($files[$i]) > 0,
                        'template' => (isset($files[$i]) ? '<div id=remove><strong>%file%</strong><br/>%input%</div>' : '')
                    ));
        }


        for ($i = 1; $i <= 5; $i++) {
            $this->validatorSchema['archivo_' . $i] = new sfValidatorFile(array(
                        'required' => false,
                        'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/',
                        'mime_type_guessers' => array(array('fakemime', 'detect')),
                    ));
        }
        $this->validatorSchema['persona_contacto'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 70, 'min_length' => 2, 'required' => true), array('required' => __('No has incluido tu nombre.'), 'invalid' => __('Ese nombre no es válido.'))),
                    new sfValidatorNombres(array('caracteres_no_validos' => sfGuardUserProfileFormBackend::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => false), array('required' => __('No has incluido tu nombre.'), 'invalid' => __('Esa persona de contacto no es válida.')));

        $this->validatorSchema['name']->setMessage("required", 'No has incluido un título de la incidencia.');
        $this->validatorSchema["incidencia"]->setMessage("required", 'No has incluido una descripción de la incidencia.');
        $this->validatorSchema['concurso_categoria_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCategoria'), 'required' => true), array('required' => 'No has seleccionado una categoría del concurso.'));
        $this->validatorSchema['empresa_nombre'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('required' => true, 'trim' => false, 'min_length' => 1, 'max_length' => 70), array('required' => __('No has incluido una empresa o entidad.'))),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_empresa), array('invalid' => __('Esa empresa o entidad no es válida.')))
                        ), array(), array('required' => __('No has incluido una empresa o entidad.')));
        $this->validatorSchema['road_type_id']->setOption("required", true);
        $this->validatorSchema['road_type_id']->setMessage('required', 'No has seleccionado un tipo de vía.');
        $this->validatorSchema['featured_order'] = new sfValidatorInteger(array('required' => false));
        $this->validatorSchema['concurso_address'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 70, 'required' => true), array('invalid' => __('Esa dirección no es válida.'))),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_direccion, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => true), array('required' => __('No has incluido una dirección.'), 'invalid' => __('Esa dirección no es válida.')));

        $caracteres_no_validos_numero = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_numero[array_search('/', $caracteres_no_validos_numero)]); // para número sí permitimos la barra
        $this->validatorSchema['concurso_numero'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 6, 'required' => false)),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_numero, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => true), array('required' => __('No has incluido un Nº.'), 'invalid' => __('Ese Nº no es válido.')));

        $caracteres_no_validos_piso_puerta = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_piso_puerta[array_search('.', $caracteres_no_validos_piso_puerta)]); // para piso y puerta sí permitimos el punto
        $this->validatorSchema['concurso_piso'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 6, 'required' => false)),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => false), array('invalid' => __('Ese Piso no es válido.')));
        $this->validatorSchema['concurso_puerta'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 6, 'required' => false)),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => false), array('invalid' => __('Esa Puerta no es válida.')));
        $this->validatorSchema["states_id"]->setOption("required", true);
        $this->validatorSchema['states_id']->setMessage('required', __('No has seleccionado una provincia.'));
        $this->validatorSchema["city_id"]->setOption("required", true);
        $this->validatorSchema["city_id"]->setMessage("required", __('No has seleccionado una localidad.'));

        $this->validatorSchema['plan_accion'] = new sfValidatorString(array('required' => true), array('required' => 'No has incluido tu Plan de acción.'));
        $this->validatorSchema["resumen"] = new sfValidatorString(array('required' => true), array('required' => 'No has incluido el resumen de tu Plan de acción.'));

        $this->validatorSchema['created_at'] = new sfValidatorDateTime(array(), array('required' => __('La fecha del concurso es obligatoria'), 'invalid' => __('La fecha del concurso no es válida')));

        $this->validatorSchema['valida'] = new sfValidatorChoice(array('choices' => array_keys($choices)));
        $this->validatorSchema['codigopostal'] = new sfValidatorRegex(array(
                    'pattern' => '#^(\d{5})$#',
                    'required' => false,
                        ), array('invalid' => 'Ese C.P. no es válido.')
        );
        $this->validatorSchema['email'] = new sfValidatorEmail(array('required' => false, 'trim' => true), array('invalid' => 'Ese correo electrónico no es válido.'));
        $this->validatorSchema['telefono'] = new sfValidatorRegex(array(
                    'pattern' => '#^(\d{9})$#',
                    'required' => false
                        ), array('invalid' => 'Ese teléfono no es válido.')
        );
        $this->validatorSchema['empresa_sector_uno_id'] = new sfValidatorDoctrineChoice(array('model' => 'EmpresaSectorUno', 'required' => true), array('required' => 'No has seleccionado un sector de la empresa o entidad.'));
        $this->validatorSchema['empresa_sector_dos_id'] = new sfValidatorDoctrineChoice(array('model' => 'EmpresaSectorDos', 'required' => true), array('required' => 'No has seleccionado un subsector de la empresa o entidad.'));
        $this->validatorSchema['empresa_sector_tres_id'] = new sfValidatorDoctrineChoice(array('model' => 'EmpresaSectorTres', 'required' => false), array('required' => 'No has seleccionado una actividad de la empresa o entidad.'));

        $this->validatorSchema['lista'] = new sfValidatorChoice(array('choices' => array_keys(sfConfig::get('app_listas_tipos')), 'required' => true), array('required' => 'N'));
        $this->validatorSchema['comentario_inicial'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['comentario_inicial']->setMessage('required', 'Para publicar una empresa/entidad en la lista blanca necesitas asociarle un comentario inicial.');
        $this->validatorSchema['texto_lista_negra'] = new sfValidatorString(array('required' => false), array('required' => 'Necesitas incluir las razones por las que la empresa/entidad está en la lista negra.'));
        $this->validatorSchema['googlemap'] = new sfValidatorPass();


        $this->widgetSchema['lista_cuestionario_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'ListaCuestionario',
                    'add_empty' => 'Selecciona un cuestionario',
                    'table_method' => 'getCuestionariosForEmpresa'
                ));
        $this->validatorSchema['lista_cuestionario_id'] = new sfValidatorDoctrineChoice(array('model' => 'ListaCuestionario', 'required' => false), array('required' => 'Si la empresa/entidad está en la lista blanca necesitas asociarle un cuestionario.'));


        $this->widgetSchema['divisor'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_9_c_1', 'maxlength' => 10));
        $this->validatorSchema['divisor'] = new sfValidatorInteger(array('required' => false));
        $this->validatorSchema['divisor']->setMessage('min', 'Para publicar una empresa/entidad en la lista blanca necesitas incluir las auditorías realizadas.');
        $this->validatorSchema['divisor']->setMessage('required', 'Para publicar una empresa/entidad en la lista blanca necesitas incluir las auditorías realizadas.');
        $this->validatorSchema['divisor']->setMessage('invalid', 'Para publicar una empresa/entidad en la lista blanca necesitas incluir las auditorías realizadas.');

        $this->widgetSchema['dividendo'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_9_c_1', 'maxlength' => 10));
        $this->validatorSchema['dividendo'] = new sfValidatorInteger(array('required' => false));
        $this->validatorSchema['dividendo']->setMessage('min', 'Para publicar una empresa/entidad en la lista blanca necesitas incluir los puntos totales.');
        $this->validatorSchema['dividendo']->setMessage('required', 'Para publicar una empresa/entidad en la lista blanca necesitas incluir los puntos totales.');
        $this->validatorSchema['dividendo']->setMessage('invalid', 'Para publicar una empresa/entidad en la lista blanca necesitas incluir los puntos totales.');





        $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
                        //new sfValidatorCallback(array('callback' => array($this, 'extraValidatorsPersonaContacto')))
                )));


        //user_id
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User')));

        //username
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array("default" => (!$this->isNew() ? $this->getObject()->getUser()->getUsername() : "")), array('id' => 'concurso_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->validatorSchema['user_name'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'column' => 'username'), array('required' => 'Necesitas seleccionar un Usuario.', 'invalid' => 'Ese Usuario no es válido.'));


        $this->widgetSchema->setLabels(array(
            'name' => __('Título'),
            'user_id' => __('Usuario'),
            'user_name' => __('Usuario'),
            'incidencia' => __('Descripción de la incidencia'),
            'concurso_estado_id' => __('Estado'),
            'concurso_categoria_id' => __('Categoría'),
            'empresa_nombre' => __('Empresa/Entidad'),
            'road_type_id' => __('Tipo de vía'),
            'states_id' => __('Provincia'),
            'city_id' => __('Localidad'),
            'concurso_address' => __('Dirección'),
            'concurso_numero' => __('Nº'),
            'concurso_piso' => __('Piso'),
            'concurso_puerta' => __('Puerta'),
            'dividendo' => 'Puntos totales',
            'divisor' => 'Auditorías realizadas',
            'lista_cuestionario_id' => __('Cuestionario asociado'),
            'resumen' => __('Resumen del Plan de acción'),
            'plan_accion' => __('Plan de acción'),
            'slug' => __('Url-alias'),
            'created_at' => __('Fecha'),
            'valida' => __('Validación'),
            'codigopostal' => __('C.P.'),
            'email' => __('Correo electrónico'),
            'telefono' => __('Teléfono'),
            'empresa_sector_uno_id' => __('Sector'),
            'empresa_sector_dos_id' => __('Subsector'),
            'empresa_sector_tres_id' => __('Actividad'),
            'texto_lista_negra' => __('Lista negra: por qué aparece aquí'),
            'googlemap' => __('Ubicación asociada'),
            'featured' => __('Home'),
            'featured_order' => __('Orden Home')
        ));

        $this->validatorSchema->setPreValidator(new sfValidatorCallback(array("callback" => array($this, "preValidate"))));
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'featuredCallback'))));
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidate'))));
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'checkActividad'))));
        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkLista')))
        );
        $this->mergePreValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkUniqueSlug')))
        );
      //  $this->validatorSchema->setPreValidator(new sfValidatorCallback(array("callback" => array($this, "checkUniqueSlug"))));
        /* $this->mergePostValidator(
          new sfValidatorDoctrineUnique(array('model' => 'Empresa', 'primary_key' => 'id', 'column' => array("name", "localidad_id", "road_type_id", "direccion", "numero")), array('invalid' => 'Ya existe un profesional con esas características. Por favor revísalo.'))
          ); */
        $this->mergePostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'Producto', 'primary_key' => 'id', 'column' => array("name", "marca", "modelo")), array('invalid' => 'Ya existe un profesional con esas características. Por favor revísalo.'))
        );
    }

    public function checkUniqueSlug($validator, $values) {
        $empresa = $this->getObject();

        $slug = $values['empresa_nombre'];

        $states = $empresa->getCheckStates($values['states_id']);
        $city = $empresa->getCheckCity($values['city_id']);
        if ($values['city_id']) {
            if ($city->getIsCapital() == '1') {
                $slug .= "-" . $states;
            } else {
                $slug .= "-" . $city->getName();
            }
        }
        $tipo = $empresa->getCheckTipo($values['road_type_id']);
        if (!empty($tipo)) {
            $slug .= "-" . $tipo;
        }
        if (($states != 'Toda España' && $values['concurso_address']) || ($states == 'Toda España' && $values['concurso_address'])) {
            $slug .= '-' . $values['concurso_address'];
        }
        if (($states != 'Toda España' && $values['concurso_numero']) || ($states == 'Toda España' && $values['concurso_numero'])) {
            $slug .= '-' . $values['concurso_numero'];
        }

        $slug_string = functions::toSlug($slug);
        $slug_chk = $empresa->getUniqueSlug($slug_string);

        if ($this->getObject()->isNew()) {
            if ($slug_chk != 0) {
                throw new sfValidatorError($validator, 'Ya existe un empresa/entidad con esas características. Por favor revísalo.');
            }
        } else {
            if ($slug_chk > 0 && $slug_chk == 1) {
                throw new sfValidatorError($validator, 'Ya existe un empresa/entidad con esas características. Por favor revísalo.');
            }
        }
        return $values;
    }

    public function preValidate($validator, $values) {
        if (isset($values['states_id']))
            if (($values['states_id'] == 16) || ($values['states_id'] == 35) || ($values['states_id'] == 1))
                $this->getValidator('city_id')->setOption('required', false);

        if ((isset($values['empresa_sector_dos_id'])) && ($values['empresa_sector_dos_id'] != '')) {
            if ($empresa_sector_3 = Doctrine::getTable('EmpresaSectorTres')->findBy('empresa_sector_dos_id', $values['empresa_sector_dos_id']))
                if (count($empresa_sector_3) == 0)
                    $this->getValidator('empresa_sector_tres_id')->setOption('required', false);
        }
        if ($values['states_id'] == 1) {
            $this->getValidator('road_type_id')->setOption('required', false);
            $this->getValidator('concurso_address')->setOption('required', false);
            $this->getValidator('concurso_numero')->setOption('required', false);
        }
        if ($values['lista'] == 'lb') {
            $this->getValidator('texto_lista_negra')->setOption('required', false);
        }
        if ($values['lista'] == 'ln') {
            $this->getValidator('comentario_inicial')->setOption('required', false);
        }
    }

    public function getDefaultValuesConcurso() {
        $arr = $this->getDefaults();

        $arr['empresa_nombre'] = $this->getObject()->getEmpresa()->getName();
        $arr['road_type_id'] = $this->getObject()->getEmpresa()->getRoadTypeId();
        $arr['states_id'] = $this->getObject()->getEmpresa()->getStatesId();
        $arr['city_id'] = $this->getObject()->getEmpresa()->getLocalidadId();
        $arr['concurso_address'] = $this->getObject()->getEmpresa()->getDireccion();
        $arr['concurso_numero'] = $this->getObject()->getEmpresa()->getNumero();
        $arr['concurso_piso'] = $this->getObject()->getEmpresa()->getPiso();
        $arr['concurso_puerta'] = $this->getObject()->getEmpresa()->getPuerta();
        $arr['valida'] = $this->getObject()->getEmpresa()->getValida();
        $arr['codigopostal'] = $this->getObject()->getEmpresa()->getCodigoPostal();
        $arr['persona_contacto'] = $this->getObject()->getEmpresa()->getPersonaContacto();
        $arr['email'] = $this->getObject()->getEmpresa()->getEmail();
        $arr['telefono'] = $this->getObject()->getEmpresa()->getTelefono();
        $arr['empresa_sector_uno_id'] = $this->getObject()->getEmpresa()->getEmpresaSectorUnoId();
        $arr['empresa_sector_dos_id'] = $this->getObject()->getEmpresa()->getEmpresaSectorDosId();
        $arr['empresa_sector_tres_id'] = $this->getObject()->getEmpresa()->getEmpresaSectorTresId();
        $arr['comentario_inicial'] = $this->getObject()->getEmpresa()->getComentarioInicial();
        $arr['lista'] = $this->getObject()->getEmpresa()->getLista();
        $arr['texto_lista_negra'] = $this->getObject()->getEmpresa()->getTextoListaNegra();
        $arr['dividendo'] = $this->getObject()->getEmpresa()->getDividendo();
        $arr['divisor'] = $this->getObject()->getEmpresa()->getDivisor();
        $arr['lista_cuestionario_id'] = $this->getObject()->getEmpresa()->getListaCuestionarioId();
        if ($this->getObject()->getContribucionPrincipal()) {
            $arr['resumen'] = $this->getObject()->getContribucionPrincipal()->getResumen();
            $arr['plan_accion'] = $this->getObject()->getContribucionPrincipal()->getPlanAccion();
        }

        $arr['googlemap']['address'] = $this->getObject()->getEmpresa()->getGoogleMap()->getAddress();
        $arr['googlemap']['lat'] = $this->getObject()->getEmpresa()->getGoogleMap()->getLat();
        $arr['googlemap']['lng'] = $this->getObject()->getEmpresa()->getGoogleMap()->getLng();
        $arr['googlemap']['zoom'] = $this->getObject()->getEmpresa()->getGoogleMap()->getZoom();

        return $arr;
    }

    /**
     * Valida en caso que haya actividad que se escoja una.
     *
     * @param $validator
     * @param $values
     */
    public function checkActividad($validator, $values) {
        $errorSchema = new sfValidatorErrorSchema($validator);

        if (!empty($values['empresa_sector_tres_id'])) {
            return $values;
        }

        if (empty($values['empresa_sector_dos_id'])) {
            $this->validatorSchema['empresa_sector_tres_id']->setOption('required', true);
            try {
                $this->validatorSchema['empresa_sector_tres_id']->clean($values['empresa_sector_tres_id']);
            } catch (sfValidatorErrorSchema $e) {
                $errorSchema->addErrors($e);
            } catch (sfValidatorError $e) {
                $errorSchema->addError($e, 'empresa_sector_tres_id');
            }

            if (count($errorSchema)) {
                throw $errorSchema;
            }
        }
        $this->validatorSchema['empresa_sector_tres_id']->setOption('required', true);

        $subsector_id = $values['empresa_sector_dos_id'];
        if (EmpresaSectorDosTable::hasActividad($subsector_id)) {
            $error = new sfValidatorError($validator, 'No has seleccionado una actividad.');
            throw new sfValidatorErrorSchema($validator, array('empresa_sector_tres_id' => $error));
        }
        return $values;
    }

    public function postValidate($validator, $values) {
        if ((!empty($values['states_id'])) and (!empty($values['codigopostal']))) {
            $name = Doctrine::getTable('States')->findOneById($values['states_id'])->getName();
            if (false == cp::checkCpByStateName($values['codigopostal'], $name)) {
                $invalid = new sfValidatorError($validator, 'Ese C.P. no es válido.');
                throw new sfValidatorErrorSchema($validator, array('codigopostal' => $invalid));
            }
        }
        return $values;
    }

    public function checkLista(sfValidatorCallback $validator, $values) {
        $errorSchema = new sfValidatorErrorSchema($validator);
        $required = array();
        if ($values['lista'] == 'lb') {
            array_push($required, 'lista_cuestionario_id', 'dividendo', 'divisor', 'comentario_inicial');
        } elseif ($values['lista'] == 'ln') {
            array_push($required, 'texto_lista_negra');
        }

        foreach ($required as $field) {
            $this->validatorSchema[$field]->setOption('required', true);
            $this->validatorSchema['dividendo']->setOption('min', 1);
            $this->validatorSchema['divisor']->setOption('min', 1);

            try {
                $this->validatorSchema[$field]->clean($values[$field]);
            } catch (sfValidatorErrorSchema $e) {
                $errorSchema->addErrors($e);
            } catch (sfValidatorError $e) {
                $errorSchema->addError($e, $field);
            }
        }

        //si está en una lista... googleMap required...
        $ma_empresa = sfContext::getInstance()->getRequest()->getParameter("empresa");
        if ($values['lista'] == 'lb' && $values['states_id'] != 1) {
            if ($values['googlemap']['address'] == '' || $ma_empresa['gmap_check'] == 'false') {
                $errorSchema->addError(new sfValidatorError($validator, 'Para publicar una empresa/entidad en la lista blanca necesitas asociarle una ubicación.'), 'googlemap');
            }
        }
        if ($values['lista'] == 'ln' && $values['states_id'] != 1) {
            if ($values['googlemap']['address'] == '' || $ma_empresa['gmap_check'] == 'false') {
                $errorSchema->addError(new sfValidatorError($validator, 'Para publicar una empresa/entidad en la lista negra necesitas asociarle una ubicación.'), 'googlemap');
            }
        }


        //si está en lista negra no puede tener un cuestionario

        /* if ($values['lista'] == 'ln' && !empty($values['lista_cuestionario_id'])) {
          $error = new sfValidatorError($validator, 'Si la empresa está en lista negra no puede tener un cuestionario asociado.');
          $errorSchema->addError($error, 'lista_cuestionario_id');
          } */

        if (count($errorSchema)) {
            throw $errorSchema;
        }

        return $values;
    }

    public function featuredCallback($validator, $values) {
        if (!empty($values['featured'])) {
            //get featured limit
            $featured_limit = Doctrine::getTable('Concurso')->getFeatreudLimit('company');

            //if featured limit is more then 10 then show error message
            if ($featured_limit[0]['contest_limit'] >= 10) {
                $invalid = new sfValidatorError($validator, 'No puedes destacar más de 10 concursos de Empresa/Entidad en la Home.');
                throw new sfValidatorErrorSchema($validator, array('featured' => $invalid));
            }
        }

        return $values;
    }

    public function save($con = null) {
        $isNew = $this->getObject()->isNew();
        $values = $this->getValues();

        $empresa = Doctrine::getTable('empresa')->createQuery()->where('name like ?', ucfirst(strtolower($values["empresa_nombre"])))->fetchOne();
        if (!$empresa) {
            $empresa = new Empresa();
        }
        $id = $values['id'];
        unset($values['id']);

        //$empresa->fromArray($values);

        if (isset($values['empresa_nombre']))
            $empresa->setName($values["empresa_nombre"]);
        if (isset($values['valida']))
            $empresa->setValida($values["valida"]);
        if (isset($values['road_type_id']))
            $empresa->setRoadTypeId($values['road_type_id']);
        else
            $empresa->setRoadTypeId(NULL);

        if (isset($values['empresa_sector_uno_id']))
            $empresa->setEmpresaSectorUnoId($values['empresa_sector_uno_id']);
        if (isset($values['empresa_sector_dos_id']))
            $empresa->setEmpresaSectorDosId($values['empresa_sector_dos_id']);
        //if (isset($values['empresa_sector_tres_id']))
        $empresa->setEmpresaSectorTresId($values['empresa_sector_tres_id']);
        if (isset($values['concurso_address']))
            $empresa->setDireccion($values['concurso_address']);
        else
            $empresa->setDireccion("");

        if (isset($values['concurso_numero']))
            $empresa->setNumero($values['concurso_numero']);
        else
            $empresa->setNumero("");

        if (isset($values['concurso_piso']))
            $empresa->setPiso($values['concurso_piso']);
        else
            $empresa->setPiso("");

        if (isset($values['concurso_puerta']))
            $empresa->setPuerta($values['concurso_puerta']);
        else
            $empresa->setPuerta("");

        if (isset($values['dividendo']))
            $empresa->setDividendo($values['dividendo']);
        if (isset($values['divisor']))
            $empresa->setDivisor($values['divisor']);
        if (isset($values['lista_cuestionario_id']))
            $empresa->setListaCuestionarioId($values['lista_cuestionario_id']);

        if (isset($values['states_id']))
            $empresa->setStatesId($values['states_id']);
        if (isset($values['city_id']))
            $empresa->setLocalidadId($values['city_id']);
        if (isset($values['codigopostal']))
            $empresa->setCodigopostal($values['codigopostal']);
        if (isset($values['persona_contacto']))
            $empresa->setPersonaContacto($values['persona_contacto']);
        if (isset($values['email']))
            $empresa->setEmail($values['email']);
        if (isset($values['telefono']))
            $empresa->setTelefono($values['telefono']);
        if (isset($values['lista']))
            $empresa->setLista($values['lista']);
        if (isset($values['comentario_inicial']))
            $empresa->setComentarioInicial($values['comentario_inicial']);
        if (isset($values['texto_lista_negra']))
            $empresa->setTextoListaNegra($values['texto_lista_negra']);

        $empresa->setSlug();

        $empresa->save();



        $values['id'] = $id;
        // googlemap
        if (!empty($values['googlemap']['address'])) {
            if (!$google_map = Doctrine::getTable('googleMap')->createQuery()->where('empresa_id=?', $empresa->getId())->fetchOne()) {
                $google_map = new GoogleMap();
                $google_map->setEmpresaId($empresa->getId());
            }

            $google_map->setAddress($values['googlemap']['address']);
            $google_map->setLat($values['googlemap']['lat']);
            $google_map->setLng($values['googlemap']['lng']);
            $google_map->setZoom($values['googlemap']['zoom']);
            $google_map->save();
        }
        if ($isNew) {
            $this->getObject()->fromArray($values);
            $this->getObject()->setConcursoTipoId(1);
            $this->getObject()->setEmpresaId($empresa->getId());
            $this->getObject()->save();

            $contribucion = new Contribucion();
            $contribucion->concurso_id = $this->getObject()->getId();
            $contribucion->contribucion_estado_id = 1;
            $contribucion->plan_accion = $values['plan_accion'];
            $contribucion->resumen = $values['resumen'];
            $contribucion->numero = 1;
            $contribucion->user_id = $values['user_id'];
            $contribucion->destacado = 0;
            $contribucion->principal = 1;
            $contribucion->save();
        } else {
            $this->getObject()->fromArray($values);
            $this->getObject()->setEmpresaId($empresa->getId());
            $this->getObject()->save();

            $contribucion = $this->getObject()->getContribucionPrincipal();
            if ($contribucion) {
                $contribucion->plan_accion = $values['plan_accion'];
                $contribucion->resumen = $values['resumen'];
                $contribucion->save();
            }
        }

        // archivos
        for ($i = 1; $i <= 5; $i++) {
            $upload = $this->getValue('archivo_' . $i);
            if (!is_null($upload)) {
                $filename = sha1($upload->getOriginalName() . microtime() . rand()) . $upload->getExtension($upload->getOriginalExtension());
                $upload->save($filename);

                $concurso_archivo = new ConcursoArchivo();
                $concurso_archivo->setConcursoId($this->getObject()->getId());
                $concurso_archivo->setFile($filename);
                $concurso_archivo->save();
            }
        }
        return $this->getObject()->getId();
    }

}