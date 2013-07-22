<?php

sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

class ConcursoPendienteFormBackend extends BaseConcursoForm {
    
    public function configure() {        
        unset(
                $this["created_at"], $this["updated_at"], $this['producto_id'], $this['empresa_id'], $this['fecha_activacion'], $this['fecha_referendum'], $this['fecha_destacado'], $this['cuestionario_id'], $this['cuestionario_total'], $this['fecha_revision'], $this['fecha_deliberacion'], $this['fecha_rechazado'], $this['fecha_cerrado'], $this['fecha_nulo'], $this['revision_last_state_id'], $this['fecha_observacion'], $this['slug']
        );
        if ($this->isNew()) {
            $this->configureNewForm();
        } else {
            $this->configureEditForm();
        }
        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->validatorSchema->setOption('filter_extra_fields', false);
    }

    public function configureNewForm() {

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
        $caracteres_no_validos_empresa = array(
            'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
            'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω',
            'ϊ', 'ϋ', 'ύ', 'ώ', 'Б', 'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы',
            'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п', 'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю',
            'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ', 'Ѵ', 'ѵ', 'Ґ', 'ґ',
            'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '•', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '←', '↑', '→', '↓', '↔',
            '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−', '√', '∞', '∫', '≈', '≠', '≤', '≥', '◊', '⅓',
            '⅔', '⅕', '⅖', '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', '€', 'Ø', '@', '©', '¶', '℮'
        );

        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'style' => 'width:492px !important'));
        $this->validatorSchema['name']->setMessage("required", 'No has incluido un título de la incidencia.');

        //user_id
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User')));

        //username
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array("default" => (!$this->isNew() ? $this->getObject()->getUser()->getUsername() : "")), array('id' => 'concurso_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->validatorSchema['user_name'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'column' => 'username'), array('required' => 'Necesitas seleccionar un Usuario.', 'invalid' => 'Ese Usuario no es válido.'));

        /* Add new fileds */
        $this->widgetSchema['empresa_nombre'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->setValidator('empresa_nombre', new sfValidatorAnd(array(
                    new sfValidatorString(
                            array('required' => true, 'trim' => false, 'min_length' => 1, 'max_length' => 70),
                            array('required' => __('No has incluido una empresa o entidad.'), 'min_length' => __('La empresa o entidad debe tener entre 1 y 70 caracteres, con espacios en blanco.'), 'max_length' => __('La empresa o entidad debe tener entre 1 y 70 caracteres, con espacios en blanco.'))
                    ),
                    //new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_empresa), array('invalid' => __('Esa empresa/entidad no es válida.')))
                        ), array(), array('required' => __('No has incluido una empresa o entidad.'))));


        $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'EmpresaSectorUno',
                    //'table_method' => 'getSectoresUnoOrderByOrden',
                    'order_by' => array('orden', 'asc'),
                    'add_empty' => __('Selecciona sector')));
        $this->validatorSchema['empresa_sector_uno_id'] = new sfValidatorDoctrineChoice(array('model' => 'EmpresaSectorUno'), array('required' => 'No has seleccionado un sector de la empresa o entidad.'));

        $this->widgetSchema['empresa_sector_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'EmpresaSectorDos',
                    //'table_method' => 'getSectoresDosOrderByOrden',
                    'depends' => 'EmpresaSectorUno',
                    'add_empty' => __('Selecciona subsector')));
        $this->validatorSchema['empresa_sector_dos_id'] = new sfValidatorDoctrineChoice(array('model' => 'EmpresaSectorDos'), array('required' => 'No has seleccionado un subsector de la empresa o entidad.'));

        $this->widgetSchema['empresa_sector_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'EmpresaSectorTres',
                    //'table_method' => 'getSectoresTresOrderByOrden',
                    'depends' => 'EmpresaSectorDos',
                    'add_empty' => __('Selecciona actividad')));
        $this->validatorSchema['empresa_sector_tres_id'] = new sfValidatorDoctrineChoice(array('model' => 'EmpresaSectorTres'), array('required' => 'No has seleccionado una actividad de la empresa o entidad.'));

        $this->widgetSchema['producto'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->validatorSchema['producto'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('trim' => false, 'max_length' => 70, 'min_length' => 2, 'required' => true), array('required' => __('No has incluido un producto.'), 'invalid' => __('Ese producto no es válido.'))),
                    new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array(), array('required' => __('No has incluido un producto.'), 'invalid' => __('Ese producto no es válido.')));


        $this->widgetSchema['producto_nombre'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->setValidator('producto_nombre', new sfValidatorAnd(array(
                    new sfValidatorString(array(
                        'required' => true,
                        'trim' => false,
                        'min_length' => 1,
                        'max_length' => 70
                            ), array('required' => __('No has incluido una marca.'))),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_empresa), array('invalid' => __('Esa marca no es válida.')))
                        ), array(), array('required' => __('No has incluido una marca.')))
        );

        $this->widgetSchema['modelo'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_20_c', 'maxlength' => 20));
        $this->setValidator('modelo', new sfValidatorAnd(array(
                    new sfValidatorString(
                            array('required' => false, 'trim' => false, 'min_length' => 1, 'max_length' => 70), array('required' => __('No has incluido el modelo.'), 'min_length' => __('El modelo debe tener entre 1 y 70 caracteres, con espacios en blanco.'), 'max_length' => __('El modelo debe tener entre 1 y 20 caracteres, con espacios en blanco.'))
                    ),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_empresa), array('invalid' => __('Ese modelo no es válido.')))
                        ), array('required' => false)));

        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoUno',
                    'order_by' => array('orden', 'asc'),
                    'add_empty' => __('Selecciona sector ')));
        $this->validatorSchema['producto_tipo_uno_id'] = new sfValidatorDoctrineChoice(array('model' => 'ProductoTipoUno'), array('required' => 'No has seleccionado un sector del producto.'));

        $this->widgetSchema['producto_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'productoTipoDos',
                    'depends' => 'ProductoTipoUno',
                    'add_empty' => __('Selecciona subsector ')));
        $this->validatorSchema['producto_tipo_dos_id'] = new sfValidatorDoctrineChoice(array('model' => 'ProductoTipoDos'), array('required' => 'No has seleccionado un subsector del producto.'));

        $this->widgetSchema['producto_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoTres',
                    'depends' => 'ProductoTipoDos',
                    'add_empty' => __('Selecciona tipo de producto')));
        $this->validatorSchema['producto_tipo_tres_id'] = new sfValidatorDoctrineChoice(array('model' => 'ProductoTipoTres'), array('required' => 'No has seleccionado un tipo de producto.'));


        $this->widgetSchema['road_type_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'RoadType',
                    'order_by' => array('orden', 'asc'),
                    'add_empty' => __('Selecciona vía')), array('class' => 'select_pequeño'));
        $this->validatorSchema['road_type_id']->setOption("required", true);
        $this->validatorSchema['road_type_id']->setMessage('required', 'No has seleccionado un tipo de vía.');

        $this->widgetSchema['concurso_address'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->validatorSchema['concurso_address'] = new sfValidatorAnd(array(
                    new sfValidatorString(
                            array('max_length' => 70, 'required' => false), array('invalid' => __('Esa dirección no es válida.')
                    )),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_direccion, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/",
                        'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => true), array('required' => __('No has incluido una dirección.'), 'invalid' => __('Esa dirección no es válida.')));


        $caracteres_no_validos_numero = $caracteres_no_validos_direccion;
        unset($caracteres_no_validos_numero[array_search('/', $caracteres_no_validos_numero)]); // para número sí permitimos la barra
        $this->widgetSchema['concurso_numero'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'style' => 'width:28px;'));
        $this->validatorSchema['concurso_numero'] = new sfValidatorAnd(array(
                    new sfValidatorString(
                            array('max_length' => 6, 'required' => false)),
                    //				new sfValidatorRegex(array('pattern' =>"/^[a-z\s\áéíóúAÉÍÓÚÑñ\d-ªº']+$/i"),array('invalid' => __('Sólo puedes introducir números, letras y guiones.')))
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_numero, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/",
                        'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => true), array('required' => __('No has incluido un Nº.'), 'invalid' => __('Ese Nº no es válido.')));


        $caracteres_no_validos_piso_puerta = $caracteres_no_validos_direccion;
        unset($caracteres_no_validos_piso_puerta[array_search('.', $caracteres_no_validos_piso_puerta)]); // para piso y puerta sí permitimos el punto
        $this->widgetSchema['concurso_piso'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'style' => 'width:21px;'));
        $this->validatorSchema['concurso_piso'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 6, 'required' => false)),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => false), array('invalid' => __('Ese Piso no es válido.')));


        $this->widgetSchema['concurso_puerta'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
        $this->validatorSchema['concurso_puerta'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 6, 'required' => false)),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => false), array('invalid' => __('Esa Puerta no es válida.'))
        );
        $module_name = sfContext::getInstance()->getModuleName();
        if ($module_name == 'concursos_pendientes_empresa' || $module_name == 'concursos_pendientes') {
            $this->widgetSchema['codigopostal'] = new sfWidgetFormInputText(array(), array('maxlength' => 5, 'class' => 'tamano_5_c_1'));
            $this->validatorSchema['codigopostal'] = new sfValidatorString(array('required' => false));
        }

        $ma_concurso = sfContext::getInstance()->getRequest()->getParameter("concurso");
        if (($module_name == 'concursos_pendientes_empresa' || $module_name == 'concursos_pendientes') && $ma_concurso['concurso_tipo_id'] == 1) {
            $this->widgetSchema['codigopostal'] = new sfWidgetFormInputText(array(), array('maxlength' => 5, 'class' => 'tamano_5_c_1'));
            $this->validatorSchema['codigopostal'] = new sfValidatorRegex(array(
                        'pattern' => '#^(\d{5})$#',
                        'required' => false,
                            ), array('invalid' => 'Ese C.P. no es válido.')
            );
        }
        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Provincia',
                    'model' => 'States',
                    'order_by' => array('orden', 'asc'),
                    'add_empty' => 'Selecciona provincia'
                ));
        $this->validatorSchema['states_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'required' => true), array('required' => 'No has seleccionado una provincia.'));

        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Localidad',
                    'model' => 'City',
                    'depends' => 'States',
                    'add_empty' => 'Selecciona localidad',
                    'ajax' => true,
                ));
        $this->validatorSchema["city_id"]->setOption("required", true);
        $this->validatorSchema["city_id"]->setMessage("required", 'No has seleccionado una localidad.');

        $this->widgetSchema['destacado'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['destacado'] = new sfValidatorBoolean(array('required' => false));

        $this->widgetSchema['featured_order'] = new sfWidgetFormInputText(array(), array('maxlength' => 2, 'class' => 'tamano_2_c'));
        $this->validatorSchema['featured_order'] = new sfValidatorInteger(array('required' => false));

        $this->widgetSchema['incidencia'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300));
        //$this->validatorSchema['incidencia'] = new sfValidatorString(array('max_length' => 12300),array('max_length' => 'Has superado el espacio permitido para la descripción de la incidencia.'));
        $this->validatorSchema["incidencia"]->setMessage("required", 'No has incluido una descripción de la incidencia.');

        $this->widgetSchema['plan_accion'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_plan_accion', 'max_length' => 43000));
        $this->validatorSchema['plan_accion'] = new sfValidatorString(array('required' => true), array('required' => 'No has incluido tu Plan de acción.'));

        $this->widgetSchema['resumen'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_resumen', 'max_length' => 1000));
        $this->validatorSchema["resumen"] = new sfValidatorString(array('required' => true), array('required' => 'No has incluido el resumen de tu Plan de acción.'));

        if (sfWebRequest::POST || sfWebRequest::PUT) {

            if ($ma_concurso['concurso_tipo_id'] == '2') {
                $q = Doctrine_Query::create()
                        ->from('ConcursoCategoria')
                        ->where('concurso_tipo_id = 2');
            } else {
                $q = Doctrine_Query::create()
                        ->from('ConcursoCategoria')
                        ->where('concurso_tipo_id = 1');
            }
            $this->widgetSchema['concurso_categoria_id'] = new sfWidgetFormDoctrineChoice(array('label' => 'Categoría', 'model' => $this->getRelatedModelName('ConcursoCategoria'), 'add_empty' => 'Selecciona categoría', 'order_by' => array('name', 'asc'), 'query' => $q));
        }

        if (sfContext::getInstance()->getModuleName() == 'concursos_pendientes_empresa' && ($ma_concurso['concurso_tipo_id'] == 1 || $ma_concurso['concurso_tipo_id'] == '')) {
            $q = Doctrine_Query::create()
                    ->from('ConcursoCategoria')
                    ->where('concurso_tipo_id = 1');
            $this->widgetSchema['concurso_categoria_id'] = new sfWidgetFormDoctrineChoice(array('label' => 'Categoría', 'model' => $this->getRelatedModelName('ConcursoCategoria'), 'add_empty' => 'Selecciona categoría', 'order_by' => array('name', 'asc'), 'query' => $q));
        } elseif (sfContext::getInstance()->getModuleName() == 'concursos_pendientes_product' && ($ma_concurso['concurso_tipo_id'] == 2 || $ma_concurso['concurso_tipo_id'] == '')) {
            $q = Doctrine_Query::create()
                    ->from('ConcursoCategoria')
                    ->where('concurso_tipo_id = 2');
            $this->widgetSchema['concurso_categoria_id'] = new sfWidgetFormDoctrineChoice(array('label' => 'Categoría', 'model' => $this->getRelatedModelName('ConcursoCategoria'), 'add_empty' => 'Selecciona categoría', 'order_by' => array('name', 'asc'), 'query' => $q));
        }

        $this->validatorSchema['concurso_categoria_id'] = new sfValidatorDoctrineChoice(array(
                    'model' => $this->getRelatedModelName('ConcursoCategoria'),
                    'required' => true), array('required' => 'No has seleccionado una categoría del concurso.'));

        for ($i = 1; $i <= 5; $i++) {
            $this->widgetSchema['archivo_' . $i] = new sfWidgetFormInputFileEditable(array(
                        'file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/'
                        . basename(sfConfig::get('sf_documents_dir')) . '/',
                        'is_image' => false,
                        'edit_mode' => false,
                        'template' => ''
                    ));
        }

        for ($i = 1; $i <= 5; $i++) {
            $this->validatorSchema['archivo_' . $i] = new sfValidatorFile(array(
                        'required' => false,
                        'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/',
                        'mime_type_guessers' => array(array('fakemime', 'detect'))
                    ));
        }
        if ($module_name == 'concursos_pendientes_empresa' || $module_name == 'concursos_pendientes') {
            $this->widgetSchema->setPositions(array('id', 'name', 'concurso_estado_id', 'user_name', 'user_id', 'concurso_tipo_id', 'concurso_categoria_id', 'empresa_nombre', 'empresa_sector_uno_id', 'empresa_sector_dos_id',
                'empresa_sector_tres_id', 'producto', 'producto_nombre', 'modelo', 'producto_tipo_uno_id', 'producto_tipo_dos_id', 'producto_tipo_tres_id', 'road_type_id',
                'concurso_address', 'concurso_numero', 'concurso_piso', 'concurso_puerta', 'codigopostal', 'states_id', 'city_id', 'destacado', 'featured', 'featured_order', 'incidencia', 'plan_accion', 'resumen',
                'concurso_puerta', 'archivo_1', 'archivo_2', 'archivo_3', 'archivo_4', 'archivo_5'));
        } else {
            $this->widgetSchema->setPositions(array('id', 'name', 'concurso_estado_id', 'user_name', 'user_id', 'concurso_tipo_id', 'concurso_categoria_id', 'empresa_nombre', 'empresa_sector_uno_id', 'empresa_sector_dos_id',
                'empresa_sector_tres_id', 'producto', 'producto_nombre', 'modelo', 'producto_tipo_uno_id', 'producto_tipo_dos_id', 'producto_tipo_tres_id', 'road_type_id',
                'concurso_address', 'concurso_numero', 'concurso_piso', 'concurso_puerta', 'states_id', 'city_id', 'destacado', 'featured', 'featured_order', 'incidencia', 'plan_accion', 'resumen',
                'concurso_puerta', 'archivo_1', 'archivo_2', 'archivo_3', 'archivo_4', 'archivo_5'));
        }
        $this->validatorSchema->setPreValidator(new sfValidatorCallback(array("callback" => array($this, "preValidate"))));
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidate'))));

        $this->widgetSchema->setLabels(array(
            'empresa_id' => __('Empresa/Entidad'),
            'empresa_nombre' => __('Empresa/Entidad'),
            'concurso_address' => __('Dirección'),
            'producto_id' => __('Producto'),
            'producto' => __('Producto'),
            'producto_nombre' => __('Marca'),
            'modelo' => __('Modelo'),
            'producto_tipo_uno_id' => __('Sector del producto'),
            'producto_tipo_dos_id' => __('Subsector del producto'),
            'producto_tipo_tres_id' => __('Tipo de producto'),
            'name' => __('Título'),
            'incidencia' => __('Descripción de la incidencia'),
            'resumen' => __('Resumen del Plan de acción'),
            'plan_accion' => __('Plan de acción'),
            'concurso_categoria_id' => __('Categoría del concurso'),
            'road_type_id' => __('Tipo de vía'),
            'states_id' => __('Provincia'),
            'city_id' => __('Localidad'),
            'empresa_sector_uno_id' => __('Sector'),
            'empresa_sector_dos_id' => __('Subsector'),
            'empresa_sector_tres_id' => __('Actividad'),
            'slug' => __('Url-alias'),
            'concurso_piso' => __('Piso'),
            'concurso_puerta' => __('Puerta'),
            'concurso_numero' => __('Nº'),
            'destacado' => __('Destacado'),
            'user_name' => __('Usuario'),
            'codigopostal' => __('C.P.')
        ));
    }

    public function configureEditForm() {
        
    }

    public function preValidate($validator, $values) {

        if (isset($values['states_id'])) {
            if ($values['states_id'] == 1) {
                $this->getValidator('road_type_id')->setOption('required', false);
                $this->getValidator('concurso_address')->setOption('required', false);
                $this->getValidator('concurso_numero')->setOption('required', false);
            }
            if (($values['states_id'] == 16) || ($values['states_id'] == 35) || ($values['states_id'] == 1)) {
                $this->getValidator('city_id')->setOption('required', false);
            }
        }

        if ((isset($values['empresa_sector_dos_id'])) && ($values['empresa_sector_dos_id'] != '')) {
            if ($empresa_sector_3 = Doctrine::getTable('EmpresaSectorTres')->findBy('empresa_sector_dos_id', $values['empresa_sector_dos_id']))
                if (count($empresa_sector_3) == 0)
                    $this->getValidator('empresa_sector_tres_id')->setOption('required', false);
        }
        if ((isset($values['producto_tipo_dos_id'])) && ($values['producto_tipo_dos_id'] != '')) {
            if ($producto_tipo_3 = Doctrine::getTable('ProductoTipoTres')->findBy('producto_tipo_dos_id', $values['producto_tipo_dos_id']))
                if (count($producto_tipo_3) == 0)
                    $this->getValidator('producto_tipo_tres_id')->setOption('required', false);
        }

        if ($values['concurso_tipo_id'] == 1) {
            $this->getValidator("producto")->setOption("required", false);
            $this->getValidator("producto_nombre")->setOption("required", false);
            $this->getValidator("modelo")->setOption("required", false);
            $this->getValidator("producto_tipo_uno_id")->setOption("required", false);
            $this->getValidator("producto_tipo_dos_id")->setOption("required", false);
            $this->getValidator("producto_tipo_tres_id")->setOption("required", false);
        } else if ($values['concurso_tipo_id'] == 2) {
            $this->getValidator("empresa_nombre")->setOption("required", false);
            $this->getValidator("empresa_sector_uno_id")->setOption("required", false);
            $this->getValidator("empresa_sector_dos_id")->setOption("required", false);
            $this->getValidator("empresa_sector_tres_id")->setOption("required", false);
            $this->getValidator("road_type_id")->setOption("required", false);
            $this->getValidator("concurso_address")->setOption("required", false);
            $this->getValidator("concurso_numero")->setOption("required", false);
            //  $this->getValidator("codigopostal")->setOption("required", false);
            $this->getValidator("states_id")->setOption("required", false);
            $this->getValidator("city_id")->setOption("required", false);
        }
    }

    public function save($con = null) {
        $isNew = $this->getObject()->isNew();
        if ($this->isValid()) {
            $nueva = false;
            $values = $this->getValues();
            if ($values['concurso_tipo_id'] == 1) {
                if (!$empresa = Doctrine::getTable('empresa')->createQuery()->where('name like ?', ucfirst(strtolower($values["empresa_nombre"])))->fetchOne()) {
                    $empresa = new Empresa();
                }
                $id = $values['id'];
                unset($values['id']);
                $empresa->fromArray($values);
                if (isset($values['empresa_nombre']))
                    $empresa->setName($values["empresa_nombre"]);
                if (isset($values['road_type_id']))
                    $empresa->setRoadTypeId($values['road_type_id']);
                if (isset($values['empresa_sector_uno_id']))
                    $empresa->setEmpresaSectorUnoId($values['empresa_sector_uno_id']);
                if (isset($values['empresa_sector_dos_id']))
                    $empresa->setEmpresaSectorDosId($values['empresa_sector_dos_id']);
                if (isset($values['empresa_sector_tres_id']))
                    $empresa->setEmpresaSectorTresId($values['empresa_sector_tres_id']);
                if (isset($values['concurso_address']))
                    $empresa->setDireccion($values['concurso_address']);
                if (isset($values['concurso_numero']))
                    $empresa->setNumero($values['concurso_numero']);
                if (isset($values['concurso_piso']))
                    $empresa->setPiso($values['concurso_piso']);
                if (isset($values['concurso_puerta']))
                    $empresa->setPuerta($values['concurso_puerta']);
                if (isset($values['codigopostal']))
                    $empresa->setCodigopostal($values['codigopostal']);
                if (isset($values['states_id']))
                    $empresa->setStatesId($values['states_id']);
                if (isset($values['city_id']))
                    $empresa->setLocalidadId($values['city_id']);
                $empresa->save();
                $values['id'] = $id;
                if ($nueva) {
                    AlertasTable::nueva(1, 'Nueva empresa/entidad', 'Se ha dado de alta la empresa/entidad <a href="empresa/' . $empresa->getId() . '/edit">' . $values["empresa_nombre"] . '</a>');
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
                    $contribucion->destacado = $values['destacado'];
                    $contribucion->principal = 1;
                    $contribucion->save();
                } else {
                    $this->getObject()->fromArray($values);
                    $this->getObject()->setEmpresaId($empresa->getId());
                    $this->getObject()->save();
                    $contribucion = $this->getObject()->getContribucionPrincipal();
                    $contribucion->plan_accion = $values['plan_accion'];
                    $contribucion->resumen = $values['resumen'];
                    $contribucion->save();
                }
            } else if ($values['concurso_tipo_id'] == 2) {

                if (!$producto = Doctrine::getTable('producto')->createQuery()->where('name like ?', ucfirst(strtolower($values["producto"])))->fetchOne()) {
                    $producto = new Producto();
                }

                $id = $values['id'];
                unset($values['id']);

                $producto->fromArray($values);

                if (isset($values['producto']))
                    $producto->setName($values["producto"]);
                if (isset($values['producto_nombre']))
                    $producto->setMarca($values['producto_nombre']);
                if (isset($values['modelo']))
                    $producto->setModelo($values['modelo']);
                if (isset($values['producto_tipo_uno_id']))
                    $producto->setProductoTipoUnoId($values['producto_tipo_uno_id']);
                if (isset($values['producto_tipo_dos_id']))
                    $producto->setProductoTipoDosId($values['producto_tipo_dos_id']);
                if (isset($values['producto_tipo_tres_id']))
                    $producto->setProductoTipoTresId($values['producto_tipo_tres_id']);

                $producto->save();
                $values['id'] = $id;

                if ($isNew) {
                    $this->getObject()->fromArray($values);
                    $this->getObject()->setConcursoTipoId(2);
                    $this->getObject()->setProductoId($producto->getId());
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
                    $this->getObject()->setProductoId($producto->getId());
                    $this->getObject()->save();
                    $contribucion = $this->getObject()->getContribucionPrincipal();
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
        }
        return $this->getObject();
    }

    public function postValidate($validator, $values) {
        if ((!empty($values['states_id'])) && (!empty($values['codigopostal']))) {
            $name = Doctrine::getTable('States')->findOneById($values['states_id'])->getName();
            if (false == cp::checkCpByStateName($values['codigopostal'], $name)) {
                $invalid = new sfValidatorError($validator, 'Ese C.P. no es válido.');
                throw new sfValidatorErrorSchema($validator, array('codigopostal' => $invalid));
            }
        }
        return $values;
    }

}