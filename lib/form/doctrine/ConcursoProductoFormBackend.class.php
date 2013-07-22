<?php

class ConcursoProductoFormBackend extends BaseConcursoForm {

    public function configure() {
        if ($this->isNew()) {
            $this->configureNewForm();
        } else {
            $this->configureEditForm();
        }
    }

    public function configureNewForm() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));  //para las traduciones del formulario

        unset($this["created_at"], $this["updated_at"], $this["concurso_tipo_id"], $this['concurso_city_id'], $this['road_type_id'], $this['states_id'], $this['city_id'], $this['concurso_address'], $this['concurso_numero'], $this['concurso_piso'], $this['concurso_puerta']);

        $choices = array(0 => 'Pendiente de revisar', 1 => 'Revisada');
        $caracteres_no_validos_producto = array(
            'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
            'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω',
            'ϊ', 'ϋ', 'ύ', 'ώ', 'Б', 'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы',
            'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п', 'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю',
            'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ', 'Ѵ', 'ѵ', 'Ґ', 'ґ',
            'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '•', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '←', '↑', '→', '↓', '↔',
            '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−', '√', '∞', '∫', '≈', '≠', '≤', '≥', '◊', '⅓',
            '⅔', '⅕', '⅖', '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', '€', 'Ø', '@', '©', '¶', '℮'
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
            '*', '[', ']', '>', '<', '¬', '·', '¿', '`', '³', '´', '¨'
        );
        $caracteres_no_validos_producto_name = array(
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '@', '#', '+', '|', '£', '¥', '§', '©', '®', '±', '²', '³', 'µ', '¶',
            '¼', '½', '¾', 'Ø', 'Γ', 'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
            'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω', 'ϊ', 'ϋ', 'ύ', 'ώ', 'Б',
            'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п',
            'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю', 'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ',
            'Ѵ', 'ѵ', 'Ґ', 'ґ', 'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '•', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '№', '℮', '⅓', '⅔', '⅕', '⅖',
            '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', '←', '↑', '→', '↓', '↔', '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−',
            '√', '∞', '∫', '≈', '≠', '≤', '≥', '◊', '/', '\\', '^', '$', '€', '¿?', '?', '.', ',', '¡', '!', '%', '&', '(', ')', '=',
            '*', '[', ']', '{', '}', ';', ':', '_', 'ª', 'º', '"', '>', '<', '¬', '·', '¿');

        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_60_c'));

        //$this->widgetSchema["concurso_categoria_id"] = new sfWidgetFormDoctrineChoice(array("model" => $this->getRelatedModelName("ConcursoCategoria"), "add_empty" => __('Selecciona categoría'),"table_method" => "selectTipoCategoria_Producto"));
        $q = Doctrine_Query::create()
                ->from('ConcursoCategoria')
                ->where('concurso_tipo_id = 2');
        $this->widgetSchema['concurso_categoria_id'] = new sfWidgetFormDoctrineChoice(array('label' => 'Categoría', 'model' => $this->getRelatedModelName('ConcursoCategoria'), 'add_empty' => 'Selecciona categoría', 'order_by' => array('name', 'asc'), 'query' => $q));
        $this->widgetSchema['producto_nombre'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['marca'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->widgetSchema['modelo'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_20_c', 'maxlength' => 20));

        $this->widgetSchema['resumen'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_resumen', 'max_length' => 1000));
        $this->widgetSchema['plan_accion'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_plan_accion', 'max_length' => 43000));
        $this->widgetSchema['incidencia'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300));

        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ProductoTipoUno', 'add_empty' => 'Selecciona sector', 'order_by' => array('orden', 'asc')));
        $this->widgetSchema['producto_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ProductoTipoDos', 'depends' => 'ProductoTipoUno', 'order_by' => array('orden', 'asc'), 'add_empty' => 'Selecciona subsector'));
        $this->widgetSchema['producto_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ProductoTipoTres', 'depends' => 'ProductoTipoDos', 'order_by' => array('orden', 'asc'), 'add_empty' => 'Selecciona tipo de producto'));
        $this->widgetSchema['featured_order'] = new sfWidgetFormInputText(array(), array('maxlength' => 2, 'class' => 'tamano_2_c'));
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
        //$this->validatorSchema['incidencia'] = new sfValidatorString(array('max_length' => 20000), array('max_length' => 'Has superado el espacio permitido para la descripción de la incidencia.'));

        $this->validatorSchema["incidencia"]->setMessage("required", 'No has incluido una descripción de la incidencia.');
        $this->validatorSchema['concurso_categoria_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCategoria'), 'required' => true), array('required' => 'No has seleccionado una categoría del concurso.'));

        $this->validatorSchema['producto_nombre'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('trim' => false, 'max_length' => 70, 'min_length' => 2, 'required' => true), array('required' => __('No has incluido un producto.'), 'invalid' => __('Ese producto no es válido.'))),
                    new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array(), array('required' => __('No has incluido un producto.'), 'invalid' => __('Ese producto no es válido.')));

        $this->setValidator('marca', new sfValidatorAnd(array(
                    new sfValidatorString(array('required' => true, 'trim' => false, 'min_length' => 1, 'max_length' => 70), array('required' => __('No has incluido una marca.'))),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_producto), array('invalid' => __('Esa marca no es válida.')))
                        ), array(), array('required' => __('No has incluido una marca.'))));
//		$this->setValidator('modelo', new sfValidatorAnd(array(
//			new sfValidatorString(array('required' => false, 'trim' => false, 'min_length' => 1, 'max_length' => 27)),
//			new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_producto),array('invalid' => __('Ese modelo no es válido.')))
//		),array('required' => false)));
        $this->validatorSchema['plan_accion'] = new sfValidatorString(array('required' => true), array('required' => 'No has incluido tu Plan de acción.'));
        $this->validatorSchema["resumen"] = new sfValidatorString(array('required' => true), array('required' => 'No has incluido el resumen de tu Plan de acción.'));
        $this->validatorSchema["marca"] = new sfValidatorString(array('required' => true), array('required' => 'No has incluido una marca.'));
        $this->validatorSchema["modelo"] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['producto_tipo_uno_id'] = new sfValidatorDoctrineChoice(array('model' => 'ProductoTipoUno', 'required' => false));
        $this->validatorSchema['producto_tipo_uno_id']->setOption('required', true);
        $this->validatorSchema['producto_tipo_uno_id']->setMessage('required', 'No has seleccionado un sector del producto.');
        $this->validatorSchema['producto_tipo_dos_id'] = new sfValidatorDoctrineChoice(array('model' => 'ProductoTipoDos', 'required' => false));
        $this->validatorSchema['producto_tipo_dos_id']->setOption('required', true);
        $this->validatorSchema['producto_tipo_dos_id']->setMessage('required', 'No has seleccionado un subsector del producto.');
        $this->validatorSchema['producto_tipo_tres_id'] = new sfValidatorDoctrineChoice(array('model' => 'ProductoTipoTres'), array('required' => 'No has seleccionado un tipo de producto.'));
        $this->validatorSchema['featured_order'] = new sfValidatorInteger(array('required' => false));
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

        //$this->setDefault("user_id", sfContext::getInstance()->getUser()->getGuardUser()->getId());

        $this->widgetSchema->setLabels(array(
            'name' => __('Título'),
            'user_id' => __('Usuario'),
            'user_name' => __('Usuario'),
            'incidencia' => __('Descripción de la incidencia'),
            'concurso_estado_id' => __('Estado'),
            'concurso_categoria_id' => __('Categoría'),
            'producto_nombre' => __('Producto'),
            'resumen' => __('Resumen del Plan de acción'),
            'plan_accion' => __('Plan de acción'),
            'slug' => __('Url-alias'),
            'featured' => __('Home'),
            'producto_tipo_uno_id' => __('Sector del producto'),
            'producto_tipo_dos_id' => __('Subsector del producto'),
            'producto_tipo_tres_id' => __('Tipo de producto'),
            'featured_order' => __('Orden Home')
        ));
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'featuredCallback'))));
        $this->validatorSchema->setPreValidator(new sfValidatorCallback(array("callback" => array($this, "preValidate"))));
    }

    public function configureEditForm() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));  //para las traduciones del formulario

        unset($this["created_at"], $this["updated_at"], $this["concurso_tipo_id"], $this['concurso_city_id'], $this['road_type_id'], $this['states_id'], $this['city_id'], $this['concurso_address'], $this['concurso_numero'], $this['concurso_piso'], $this['concurso_puerta']);

        $choices = array(0 => 'Pendiente de revisar', 1 => 'Revisada');
        $caracteres_no_validos_producto = array(
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
            '*', '[', ']', '>', '<', '¬', '·', '¿', '`', '³', '´', '¨'
        );


        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_60_c'));
        //$this->widgetSchema["concurso_categoria_id"] = new sfWidgetFormDoctrineChoice(array("model" => $this->getRelatedModelName("ConcursoCategoria"), "add_empty" => __('Selecciona categoría'),"table_method" => "selectTipoCategoria_Producto"));
        $q = Doctrine_Query::create()
                ->from('ConcursoCategoria')
                ->where('concurso_tipo_id = 2');
        $this->widgetSchema['concurso_categoria_id'] = new sfWidgetFormDoctrineChoice(array('label' => 'Categoría', 'model' => $this->getRelatedModelName('ConcursoCategoria'), 'add_empty' => 'Selecciona categoría', 'order_by' => array('orden', 'asc'), 'query' => $q));
        $this->widgetSchema['producto_nombre'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['marca'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->widgetSchema['modelo'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_20_c', 'maxlength' => 20));

        $this->widgetSchema['resumen'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_resumen', 'max_length' => 1000));
        $this->widgetSchema['incidencia'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300));
        $this->widgetSchema['plan_accion'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_plan_accion', 'max_length' => 43000));

        $this->widgetSchema['created_at'] = new sfWidgetFormDateTime(array('date' => array('format' => '%day%/%month%/%year%')));
        $this->widgetSchema['featured_order'] = new sfWidgetFormInputText(array(), array('maxlength' => 2, 'class' => 'tamano_2_c'));
        $this->widgetSchema['valida'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ProductoTipoUno', 'add_empty' => 'Selecciona sector'));
        $this->widgetSchema['producto_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ProductoTipoDos', 'depends' => 'ProductoTipoUno', 'order_by' => array('orden', 'asc'), 'add_empty' => 'Selecciona subsector'));
        $this->widgetSchema['producto_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ProductoTipoTres', 'depends' => 'ProductoTipoDos', 'order_by' => array('orden', 'asc'), 'add_empty' => 'Selecciona tipo de producto'));
        $this->widgetSchema['lista'] = new sfWidgetFormChoice(array('choices' => sfConfig::get('app_listas_tipos')));
        $this->widgetSchema['comentario_inicial'] = new sfWidgetFormTextareaCKEditor(array('width'=>600, 'height' => 200, 'err_id' => 'error_max_length', 'max_length' => 3000));
        $this->widgetSchema['texto_lista_negra'] = new sfWidgetFormTextareaCKEditor(array('width'=>600, 'height' => 200, 'err_id' => 'error_max_length_negra', 'max_length' => 3000));
        $this->widgetSchema['featured'] = new sfWidgetFormInputCheckbox();

        //new fields
        $this->widgetSchema['persona_contacto'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['email'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['telefono'] = new sfWidgetFormInputText(array(), array('maxlength' => 9, 'class' => 'tamano_8_c_1'));


        $files = array();
        $i = 1;
        foreach ($this->getObject()->ArchivosSubidos() as $file) {
            $files[$i] = $file->getFile();
            $i++;
        }

        for ($i = 1; $i <= 5; $i++) {
            $this->widgetSchema['archivo_' . $i] = new sfWidgetFormInputFileEditable(array(
                        //'file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/'. basename(sfConfig::get('sf_documents_dir')) . '/' . (isset($files[$i]) ? $files[$i] : ''),
                        'file_src' => (isset($files[$i]) ? $files[$i] : ''),
                        'is_image' => false,
                        'edit_mode' => isset($files[$i]) && strlen($files[$i]) > 0,
                        'template' => (isset($files[$i]) ? '<div id=remove><strong>%file%</strong><br/>%input%</div>' : '')
                    ));
        }

        $this->validatorSchema['name']->setMessage("required", 'No has incluido un título de la incidencia.');

        $this->validatorSchema["incidencia"]->setMessage("required", 'No has incluido una descripción de la incidencia.');

        $this->validatorSchema['concurso_categoria_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCategoria'), 'required' => true), array('required' => 'No has seleccionado una categoría del concurso.'));


        /* $this->validatorSchema['producto_nombre'] = new sfValidatorAnd(array(
          new sfValidatorString(array('max_length' => 70, 'min_length' => 2, 'required' => true), array('required' => __('No has incluido un producto.'), 'invalid' => __('Ese producto no es válido.'))),
          ), array(), array('required' => __('No has incluido un producto.'), 'invalid' => __('Ese producto no es válido.')));
         */
        $this->validatorSchema['producto_nombre'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('trim' => false, 'max_length' => 70, 'min_length' => 2, 'required' => true), array('required' => __('No has incluido un producto.'), 'invalid' => __('Ese producto no es válido.'))),
                    new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array(), array('required' => __('No has incluido un producto.'), 'invalid' => __('Ese producto no es válido.')));


        $this->setValidator('marca', new sfValidatorAnd(array(
                    new sfValidatorString(array('required' => true, 'trim' => false, 'min_length' => 1, 'max_length' => 70), array('required' => __('No has incluido una marca.'))),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_producto), array('invalid' => __('Esa marca no es válida.')))
                        ), array(), array('required' => __('No has incluido una marca.'))));
//		$this->setValidator('modelo', new sfValidatorAnd(array(
//			new sfValidatorString(array('required' => false, 'trim' => false, 'min_length' => 1, 'max_length' => 27)),
//			new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_producto),array('invalid' => __('Ese modelo no es válido.')))
//		),array('required' => false)));
        $this->validatorSchema["marca"] = new sfValidatorString(array('required' => true), array('required' => 'No has incluido una marca.'));
        $this->validatorSchema["modelo"] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['featured_order'] = new sfValidatorInteger(array('required' => false));
        $this->validatorSchema['plan_accion'] = new sfValidatorString(array('required' => true), array('required' => 'No has incluido tu Plan de acción.'));
        $this->validatorSchema["resumen"] = new sfValidatorString(array('required' => true), array('required' => 'No has incluido el resumen de tu Plan de acción.'));
        $this->validatorSchema['created_at'] = new sfValidatorDateTime(array(), array('required' => __('La fecha del concurso es obligatoria'), 'invalid' => __('La fecha del concurso no es válida')));

        $this->validatorSchema['valida'] = new sfValidatorChoice(array('choices' => array_keys($choices)));
        $this->validatorSchema['producto_tipo_uno_id'] = new sfValidatorDoctrineChoice(array('model' => 'ProductoTipoUno', 'required' => false));
        $this->validatorSchema['producto_tipo_uno_id']->setOption('required', true);
        $this->validatorSchema['producto_tipo_uno_id']->setMessage('required', 'No has seleccionado un sector del producto.');

        $this->validatorSchema['producto_tipo_dos_id'] = new sfValidatorDoctrineChoice(array('model' => 'ProductoTipoDos', 'required' => false));
        $this->validatorSchema['producto_tipo_dos_id']->setOption('required', true);
        $this->validatorSchema['producto_tipo_dos_id']->setMessage('required', 'No has seleccionado un subsector del producto.');

        $this->validatorSchema['producto_tipo_tres_id'] = new sfValidatorDoctrineChoice(array('model' => 'ProductoTipoTres'), array('required' => 'No has seleccionado un tipo de producto.'));

        $this->validatorSchema['lista'] = new sfValidatorChoice(array('choices' => array_keys(sfConfig::get('app_listas_tipos')), 'required' => true));

        $this->validatorSchema['comentario_inicial'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['comentario_inicial']->setMessage('required', 'Para publicar un producto en la lista blanca necesitas asociarle un comentario inicial.');

        $this->validatorSchema['texto_lista_negra'] = new sfValidatorString(array('required' => false), array('required' => 'Necesitas incluir las razones por las que el producto está en la lista negra.'));

        $this->validatorSchema['featured'] = new sfValidatorBoolean(array('required' => false));
        $this->validatorSchema['featured_order'] = new sfValidatorInteger(array('required' => false));
        for ($i = 1; $i <= 5; $i++) {
            $this->validatorSchema['archivo_' . $i] = new sfValidatorFile(array(
                        'required' => false,
                        'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/',
                        'mime_type_guessers' => array(array('fakemime', 'detect'))
                    ));
        }
        $this->widgetSchema['lista_cuestionario_id'] = new sfWidgetFormDoctrineChoice(array(
                    'label' => 'Cuestionario asociado',
                    'model' => 'ListaCuestionario',
                    'add_empty' => 'Selecciona un cuestionario',
                    'table_method' => 'getCuestionariosForProducto'
                ));
        $this->validatorSchema['lista_cuestionario_id'] = new sfValidatorDoctrineChoice(array('model' => 'ListaCuestionario', 'required' => false), array('required' => 'Si el producto está en la lista blanca necesitas asociarle un cuestionario.'));

        $this->widgetSchema['divisor'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_9_c_1', 'maxlength' => 10));
        $this->validatorSchema['divisor'] = new sfValidatorInteger(array('required' => false));
        $this->validatorSchema['divisor']->setMessage('min', 'Para publicar un producto en la lista blanca necesitas incluir las auditorías realizadas.');
        $this->validatorSchema['divisor']->setMessage('required', 'Para publicar un producto en la lista blanca necesitas incluir las auditorías realizadas.');
        $this->validatorSchema['divisor']->setMessage('invalid', 'Para publicar un producto en la lista blanca necesitas incluir las auditorías realizadas.');

        $this->widgetSchema['dividendo'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_9_c_1', 'maxlength' => 10));
        $this->validatorSchema['dividendo'] = new sfValidatorInteger(array('required' => false));
        $this->validatorSchema['dividendo']->setMessage('min', 'Para publicar un producto en la lista blanca necesitas incluir los puntos totales.');
        $this->validatorSchema['dividendo']->setMessage('required', 'Para publicar un producto en la lista blanca necesitas incluir los puntos totales.');
        $this->validatorSchema['dividendo']->setMessage('invalid', 'Para publicar un producto en la lista blanca necesitas incluir los puntos totales.');

        //user_id
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User')));

        //username
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array("default" => (!$this->isNew() ? $this->getObject()->getUser()->getUsername() : "")), array('id' => 'concurso_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->validatorSchema['user_name'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'column' => 'username'), array('required' => 'Necesitas seleccionar un Usuario.', 'invalid' => 'Ese Usuario no es válido.'));

        //new field validation
        $this->validatorSchema['persona_contacto'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 70, 'min_length' => 2, 'required' => true), array('required' => __('No has incluido tu nombre.'), 'invalid' => __('Ese nombre no es válido.'))),
                    new sfValidatorNombres(array('caracteres_no_validos' => sfGuardUserProfileFormBackend::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => false), array('required' => __('No has incluido tu nombre.'), 'invalid' => __('Esa persona de contacto no es válida.')));

        $this->validatorSchema['email'] = new sfValidatorEmail(array('required' => false, 'trim' => true), array('invalid' => 'Ese correo electrónico no es válido.'));
        $this->validatorSchema['telefono'] = new sfValidatorRegex(array(
                    'pattern' => '#^(\d{9})$#',
                    'required' => false
                        ), array('invalid' => 'Ese teléfono no es válido.')
        );

        //$this->setDefault("user_id", sfContext::getInstance()->getUser()->getGuardUser()->getId());

        $this->widgetSchema->setLabels(array(
            'name' => __('Título'),
            'user_id' => __('Usuario'),
            'user_name' => __('Usuario'),
            'incidencia' => __('Descripción de la incidencia'),
            'concurso_estado_id' => __('Estado'),
            'concurso_categoria_id' => __('Categoría'),
            'producto_nombre' => __('Producto'),
            'resumen' => __('Resumen del Plan de acción'),
            'plan_accion' => __('Plan de acción'),
            'slug' => __('Url-alias'),
            'created_at' => __('Fecha'),
            'valida' => __('Validación'),
            'dividendo' => 'Puntos totales',
            'divisor' => 'Auditorías realizadas',
            'producto_tipo_uno_id' => __('Sector del producto'),
            'producto_tipo_dos_id' => __('Subsector del producto'),
            'producto_tipo_tres_id' => __('Tipo de producto'),
            'texto_lista_negra' => __('Lista negra: por qué aparece aquí'),
            'featured' => __('Home'),
            'featured_order' => __('Orden Home'),
            'email' => __('Correo electrónico'),
            'telefono' => __('Teléfono'),
            'persona_contacto' => __('Persona de contacto')
        ));

        $this->validatorSchema->setPreValidator(new sfValidatorCallback(array("callback" => array($this, "preValidate"))));
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'featuredCallback'))));
        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkLista')))
        );
    }

    public function checkLista($validator, $values) {
        $errorSchema = new sfValidatorErrorSchema($validator);
        $required = array();
        if ($values['lista'] == 'lb') {
            array_push($required, 'lista_cuestionario_id', 'dividendo', 'divisor', 'comentario_inicial');
        } else if ($values['lista'] == 'ln') {
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


        /* if ($values['lista'] == 'ln' && !empty($values['lista_cuestionario_id'])) {
          $error = new sfValidatorError($validator, 'Si el producto está en la lista negra no puede tener un cuestionario asociado');
          $errorSchema->addError($error, 'lista_cuestionario_id');
          } */

        if (count($errorSchema)) {
            throw $errorSchema;
        }
        return $values;
    }

    public function preValidate($validator, $values) {
        if ((isset($values['producto_tipo_dos_id'])) && ($values['producto_tipo_dos_id'] != '')) {
            if ($producto_tipo_3 = Doctrine::getTable('ProductoTipoTres')->findBy('producto_tipo_dos_id', $values['producto_tipo_dos_id']))
                if (count($producto_tipo_3) == 0)
                    $this->getValidator('producto_tipo_tres_id')->setOption('required', false);
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

        $arr['producto_nombre'] = $this->getObject()->getProducto();
        $arr['marca'] = $this->getObject()->getProducto()->getMarca();
        $arr['modelo'] = $this->getObject()->getProducto()->getModelo();
        $arr['valida'] = $this->getObject()->getProducto()->getValida();
        $arr['dividendo'] = $this->getObject()->getProducto()->getDividendo();
        $arr['divisor'] = $this->getObject()->getProducto()->getDivisor();
        $arr['producto_tipo_uno_id'] = $this->getObject()->getProducto()->getProductoTipoUnoId();
        $arr['producto_tipo_dos_id'] = $this->getObject()->getProducto()->getProductoTipoDosId();
        $arr['producto_tipo_tres_id'] = $this->getObject()->getProducto()->getProductoTipoTresId();
        $arr['comentario_inicial'] = $this->getObject()->getProducto()->getComentarioInicial();
        $arr['lista'] = $this->getObject()->getProducto()->getLista();
        $arr['texto_lista_negra'] = $this->getObject()->getProducto()->getTextoListaNegra();
        $arr['lista_cuestionario_id'] = $this->getObject()->getProducto()->getListaCuestionarioId();
        $arr['persona_contacto'] = $this->getObject()->getProducto()->getPersonaContacto();
        $arr['email'] = $this->getObject()->getProducto()->getEmail();
        $arr['telefono'] = $this->getObject()->getProducto()->getTelefono();

        if ($this->getObject()->getContribucionPrincipal()) {
            $arr['resumen'] = $this->getObject()->getContribucionPrincipal()->getResumen();
            $arr['plan_accion'] = $this->getObject()->getContribucionPrincipal()->getPlanAccion();
        }

        return $arr;
    }

    public function save($con = null) {
        $isNew = $this->getObject()->isNew();
        $values = $this->getValues();

        $producto = Doctrine::getTable('producto')->createQuery()->where('name like ?', $values["producto_nombre"])->fetchOne();

        if (!$producto) {
            $producto = new Producto();
        }

        $q = Doctrine_Query::create()->from('Producto p')
                ->where('p.name like ?', $values["producto_nombre"])
                ->andWhere('p.marca like ?', $values['marca'])
                ->andWhere('p.modelo like ?', $values['modelo']);
        $res = $q->execute();

        $id = $values['id'];
        unset($values['id']);

        $producto->fromArray($values);


        if (isset($values['producto_nombre']))
            $producto->setName($values["producto_nombre"]);
        if (isset($values['marca']))
            $producto->setMarca($values['marca']);
        if (isset($values['modelo']))
            $producto->setModelo($values['modelo']);
        if (isset($values['producto_tipo_uno_id']))
            $producto->setProductoTipoUnoId($values['producto_tipo_uno_id']);
        if (isset($values['producto_tipo_dos_id']))
            $producto->setProductoTipoDosId($values['producto_tipo_dos_id']);
        if (isset($values['producto_tipo_tres_id']))
            $producto->setProductoTipoTresId($values['producto_tipo_tres_id']);
        if (isset($values['dividendo']))
            $producto->setDividendo($values['dividendo']);
        if (isset($values['divisor']))
            $producto->setDivisor($values['divisor']);
        if (isset($values['lista_cuestionario_id']))
            $producto->setListaCuestionarioId($values['lista_cuestionario_id']);
        if (isset($values['persona_contacto']))
            $producto->setPersonaContacto($values['persona_contacto']);
        if (isset($values['valida']))
            $producto->setValida($values['valida']);
        if (isset($values['email']))
            $producto->setEmail($values['email']);
        if (isset($values['telefono']))
            $producto->setTelefono($values['telefono']);
        if (isset($values['lista']))
            $producto->setLista($values['lista']);
        if (isset($values['comentario_inicial']))
            $producto->setComentarioInicial($values['comentario_inicial']);
        if (isset($values['texto_lista_negra']))
            $producto->setTextoListaNegra($values['texto_lista_negra']);

        $producto->setSlug();

        //$producto->
        /*$producto2 = Doctrine::getTable('producto')->createQuery()->where('slug like ?', $producto->getSlug())->andWhere("id=?", )->fetchOne();
        if()*/

        //echo $producto->getSlug();

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

    public function featuredCallback($validator, $values) {
        if (!empty($values['featured'])) {
            //get featured limit
            $featured_limit = Doctrine::getTable('Concurso')->getFeatreudLimit('company');

            //if featured limit is more then 10 then show error message
            if ($featured_limit[0]['contest_limit'] >= 10) {
                $invalid = new sfValidatorError($validator, 'No puedes destacar más de diez concursos de Producto en la Home.');
                throw new sfValidatorErrorSchema($validator, array('featured' => $invalid));
            }
        }

        return $values;
    }

}