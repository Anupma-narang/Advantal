<?php

/**
 * Concurso form.
 *
 * @package    symfony
 * @author     calambrenet <calambrenet@codefriends.es>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ConcursoForm extends BaseConcursoForm {

    public function configure() {
        $this->disableCSRFProtection();
        unset($this["created_at"], $this["updated_at"]);

        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => 'States',
            'order_by' => array('orden', 'asc'),
            'add_empty' => 'Seleccione Provincia'));

        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'City',
            'depends' => 'States',
            'add_empty' => 'Selecciona Localidad',
            'ajax' => true));

        $this->widgetSchema['cuestionario_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cuestionario'), 'add_empty' => "Seleccione ..."));
    }

}

class ConcursoFormFrontend extends BaseConcursoForm {

    private $type;

    public function __construct($object = null, $options = array(), $CSRFSecret = null) {
        $this->type = $options['type'];
        if (!$this->type)
            $this->type = 'empresa';

        parent::__construct($object, $options, $CSRFSecret);
    }

    public function configure() {
        $this->disableCSRFProtection();
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        unset($this["created_at"], $this["updated_at"], $this["producto_id"], $this["empresa_id"]);

        $this->widgetSchema["concurso_tipo_id"] = new sfWidgetFormInputHidden();
        $this->widgetSchema["user_id"] = new sfWidgetFormInputHidden();
        $this->setDefault("user_id", sfContext::getInstance()->getUser()->getGuardUser()->getId());

        $this->widgetSchema['road_type_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => 'RoadType', 'order_by' => array('orden', 'asc'), 'add_empty' => __('Selecciona vía')), array('class' => 'select_pequeño'));

        if ($this->type == 'empresa') {
            $this->setDefault("concurso_tipo_id", 1);
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
                new sfValidatorString(array('max_length' => 70, 'required' => true), array('invalid' => __('Esa dirección no es válida.'))),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_direccion, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array('required' => true), array('required' => __('No has incluido una dirección.'), 'invalid' => __('Esa dirección no es válida.'))
            );

            $caracteres_no_validos_numero = $caracteres_no_validos_direccion;
            unset($caracteres_no_validos_numero[array_search('/', $caracteres_no_validos_numero)]); // para número sí permitimos la barra
            $this->widgetSchema['concurso_numero'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_6_c'));
            $this->validatorSchema['concurso_numero'] = new sfValidatorAnd(array(
                new sfValidatorString(
                        array('max_length' => 6, 'required' => false)),
                //    			new sfValidatorRegex(array('pattern' =>"/^[a-z\s\áéíóúAÉÍÓÚÑñ\d-ªº']+$/i"),array('invalid' => __('Sólo puedes introducir números, letras y guiones.')))
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_numero, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/",
                    'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array('required' => true), array('required' => __('No has incluido un número.'), 'invalid' => __('Ese Nº no es válido.')));

            $caracteres_no_validos_piso_puerta = $caracteres_no_validos_direccion;
            unset($caracteres_no_validos_piso_puerta[array_search('.', $caracteres_no_validos_piso_puerta)]); // para piso y puerta sí permitimos el punto
            $this->widgetSchema['concurso_piso'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'class' => 'tamano_2_c'));
            $this->validatorSchema['concurso_piso'] = new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 6, 'required' => false)),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array('required' => false), array('invalid' => __('Ese Piso no es válido.'))
            );
            $this->widgetSchema['concurso_puerta'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_6_c'));
            $this->validatorSchema['concurso_puerta'] = new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 6, 'required' => false)),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array('required' => false), array('invalid' => __('Esa Puerta no es válida.'))
            );
            $this->widgetSchema['empresa_nombre'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));


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

            $this->setValidator('empresa_nombre', new sfValidatorAnd(array(
                new sfValidatorString(
                        array('required' => true, 'trim' => false, 'min_length' => 1, 'max_length' => 70), array('required' => __('No has incluido una empresa o entidad.'), 'min_length' => __('La empresa o entidad debe tener entre 1 y 70 caracteres, con espacios en blanco.'), 'max_length' => __('La empresa o entidad debe tener entre 1 y 70 caracteres, con espacios en blanco.'))
                ),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_empresa), array('invalid' => __('Esa empresa/entidad no es válida.')))
                    ), array(), array('required' => __('No has incluido una empresa o entidad.'))));

            $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineChoice(array(
                'model' => 'States',
                'add_empty' => __('Selecciona provincia'),
                'order_by' => array('orden', 'ASC')));

            $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                'model' => 'City',
                'depends' => 'States',
                'add_empty' => __('Selecciona localidad'),
                'ajax' => true));

            $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                'model' => 'EmpresaSectorUno',
                //'table_method' => 'getSectoresUnoOrderByOrden',
                'order_by' => array('orden', 'asc'),
                'add_empty' => __('Selecciona sector')));


            $this->widgetSchema['empresa_sector_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                'model' => 'EmpresaSectorDos',
                //'table_method' => 'getSectoresDosOrderByOrden',
                'depends' => 'EmpresaSectorUno',
                'add_empty' => __('Selecciona subsector')));

            $this->widgetSchema['empresa_sector_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                'model' => 'EmpresaSectorTres',
                //'table_method' => 'getSectoresTresOrderByOrden',
                'depends' => 'EmpresaSectorDos',
                'add_empty' => __('Selecciona actividad')));

            $this->setDefault('empresa_sector_uno_id', '');

            if ($empresa_id = $this->getObject()->getEmpresaId()) {
                $e = Doctrine::getTable('empresa')->findOneBy('id', $empresa_id);
                $this->setDefault('empresa_nombre', $e->getName());
                $this->setDefault('empresa_sector_uno_id', $e->getEmpresaSectorUnoId());
                $this->setDefault('empresa_sector_dos_id', $e->getEmpresaSectorDosId());
                $this->setDefault('empresa_sector_tres_id', $e->getEmpresaSectorTresId());
            }

            $this->validatorSchema['empresa_sector_uno_id'] = new sfValidatorDoctrineChoice(array('model' => 'EmpresaSectorUno'), array('required' => 'No has seleccionado un sector de la empresa o entidad.'));
            $this->validatorSchema['empresa_sector_dos_id'] = new sfValidatorDoctrineChoice(array('model' => 'EmpresaSectorDos'), array('required' => 'No has seleccionado un subsector de la empresa o entidad.'));
            $this->validatorSchema['empresa_sector_tres_id'] = new sfValidatorDoctrineChoice(array('model' => 'EmpresaSectorTres'), array('required' => 'No has seleccionado una actividad de la empresa o entidad.'));

            $this->validatorSchema['road_type_id']->setOption("required", true);
            $this->validatorSchema['road_type_id']->setMessage('required', __('No has seleccionado un tipo de vía.'));
            $this->validatorSchema["states_id"]->setOption("required", true);
            $this->validatorSchema['states_id']->setMessage('required', __('No has seleccionado una provincia.'));
            $this->validatorSchema["city_id"]->setOption("required", true);
            $this->validatorSchema["city_id"]->setMessage("required", __('No has seleccionado una localidad.'));
        } else if ($this->type == 'producto') {
            unset($this['concurso_city_id'], $this['concurso_numero']);
            $this->setDefault("concurso_tipo_id", 2);

            $this->widgetSchema['producto_nombre'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
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

            $this->setValidator('producto_nombre', new sfValidatorAnd(array(
                new sfValidatorString(array(
                    'required' => true,
                    'trim' => false,
                    'min_length' => 1,
                    'max_length' => 70
                        ), array('required' => __('No has incluido una marca.'))),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_producto), array('invalid' => __('Esa marca no es válida.')))
                    ), array(), array('required' => __('No has incluido una marca.')))
            );

            $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                'model' => 'ProductoTipoUno',
                'add_empty' => __('Selecciona sector ')));

            $this->widgetSchema['producto_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                'model' => 'productoTipoDos',
                'depends' => 'ProductoTipoUno',
                'add_empty' => __('Selecciona subsector ')));

            $this->widgetSchema['producto_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                'model' => 'ProductoTipoTres',
                'depends' => 'ProductoTipoDos',
                'add_empty' => __('Selecciona tipo ')));

            $this->validatorSchema['producto_tipo_uno_id'] = new sfValidatorDoctrineChoice(array('model' => 'ProductoTipoUno'), array('required' => 'No has seleccionado un sector del producto.'));
            $this->validatorSchema['producto_tipo_dos_id'] = new sfValidatorDoctrineChoice(array('model' => 'ProductoTipoDos'), array('required' => 'No has seleccionado un subsector del producto.'));
            $this->validatorSchema['producto_tipo_tres_id'] = new sfValidatorDoctrineChoice(array('model' => 'ProductoTipoTres'), array('required' => 'No has seleccionado un tipo de producto.'));

            $this->widgetSchema['producto'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
            $this->setValidator('producto', new sfValidatorAnd(array(
                new sfValidatorString(array(
                    'required' => true,
                    'trim' => false,
                    'min_length' => 1,
                    'max_length' => 70
                        ), array('required' => __('No has incluido un producto.'))),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_producto), array('invalid' => __('Ese producto no es válido.')))
                    ), array(), array('required' => __('No has incluido un producto.')))
            );

            $this->widgetSchema['modelo'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_20_c', 'maxlength' => 20));
            $this->setValidator('modelo', new sfValidatorAnd(array(
                new sfValidatorString(
                        array('required' => false, 'trim' => false, 'min_length' => 1, 'max_length' => 70), array('required' => __('No has incluido el modelo.'), 'min_length' => __('El modelo debe tener entre 1 y 70 caracteres, con espacios en blanco.'), 'max_length' => __('El modelo debe tener entre 1 y 20 caracteres, con espacios en blanco.'))
                ),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_producto), array('invalid' => __('Ese modelo no es válido.')))
                    ), array('required' => false)));
        }

        if ($producto_id = $this->getObject()->getProductoId()) {
            $p = Doctrine::getTable('producto')->findOneBy('id', $producto_id);
            $this->setDefault('producto_nombre', $p->getMarca());
            $this->setDefault('modelo', $p->getModelo());
            $this->setDefault('producto', $p->getName());
            $this->setDefault('producto_tipo_uno_id', $p->getProductoTipoUnoId());
            $this->setDefault('producto_tipo_dos_id', $p->getProductoTipoDosId());
            $this->setDefault('producto_tipo_tres_id', $p->getProductoTipoTresId());
        }

        $this->widgetSchema["concurso_estado_id"] = new sfWidgetFormInputHidden();
        $this->setDefault("concurso_estado_id", 1);
        $this->widgetSchema["concurso_categoria_id"] = new sfWidgetFormDoctrineChoice(array(
            "model" => $this->getRelatedModelName("ConcursoCategoria"),
            "add_empty" => __('Selecciona categoría'),
            "table_method" => "selectTipoCategoria"
        ));
        $this->validatorSchema['concurso_categoria_id'] = new sfValidatorDoctrineChoice(array(
            'model' => $this->getRelatedModelName('ConcursoCategoria'),
            'required' => true), array('required' => 'Necesitas seleccionar una categoría del concurso.'));

        $contribucion = $this->getObject()->getContribucionPrincipal();
        if (!$contribucion) {
            $contribucion = new Contribucion();
        }
        $this->embedForm("contribucion", new ContribucionForm($contribucion));

        $this->widgetSchema['incidencia'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300));

        $this->validatorSchema['incidencia'] = new sfValidatorString(array('max_rep_length' => 25000), array('max_rep_length' => 'Has superado el espacio permitido para la descripción de la incidencia.'));
        $this->validatorSchema["incidencia"]->setMessage("required", 'Necesitas incluir una descripción de la incidencia.');
        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_60_c'));
        $this->validatorSchema['name']->setMessage("required", 'Necesitas incluir un título de la incidencia.');


        $this->widgetSchema["borrador"] = new sfWidgetFormInputCheckbox(array("label" => __('Deseo continuar más tarde y guardar este concurso en borrador.'), "value_attribute_value" => "borrador"));

        //if($this->getObject()->getConcursoEstadoId()==9)
        //$this->setDefault('borrador', 1);
        $this->validatorSchema["borrador"] = new sfValidatorPass();
        $this->validatorSchema->setPreValidator(new sfValidatorCallback(array("callback" => array($this, "preValidate"))));


        /**
         * archivos
         */
        for ($i = 1; $i <= 5; $i++) {
            $this->embedForm('archivo_' . $i, new ConcursoArchivoForm(new ConcursoArchivo()));
        }

        $this->widgetSchema->setLabels(array(
            'empresa_nombre' => __('Empresa/Entidad*'),
            'concurso_address' => __('Dirección*'),
            'concurso_numero' => __('Nº*'),
            'concurso_piso' => __('Piso'),
            'concurso_puerta' => __('Puerta'),
            'producto_nombre' => __('Marca*'),
            'producto' => __('Producto*'),
            'producto_tipo_uno_id' => __('Sector del producto*'),
            'producto_tipo_dos_id' => __('Subsector del producto*'),
            'producto_tipo_tres_id' => __('Tipo de producto*'),
            'name' => __('Título de la incidencia*'),
            'incidencia' => __('Descripción de la incidencia*'),
            'concurso_categoria_id' => __('Categoría del concurso*'),
            'road_type_id' => __('Tipo de vía*'),
            'states_id' => __('Selecciona provincia*'),
            'city_id' => __('Selecciona localidad*'),
            'empresa_sector_uno_id' => __('Sector de la empresa/entidad'),
            'empresa_sector_dos_id' => __('Subsector de la empresa/entidad'),
            'empresa_sector_tres_id' => __('Actividad de la empresa/entidad'),
            'featured' => __('Home'),
            'featured_order' => __('Orden Home')
        ));
    }

    public function preValidate($validator, $values) {
        if (isset($values['states_id']))
            if (($values['states_id'] == 16) || ($values['states_id'] == 35) || ($values['states_id'] == 1))
                $this->getValidator('city_id')->setOption('required', false);

        if (isset($values["borrador"])) {
            $this->getValidator("states_id")->setOption("required", false);
            $this->getValidator("incidencia")->setOption("required", false);
            $this->getValidator('incidencia')->setOption('required', false);

            if (isset($this['empresa_sector_uno_id']))
                $this->getValidator('empresa_sector_uno_id')->setOption('required', false);
            if (isset($this['empresa_sector_dos_id']))
                $this->getValidator('empresa_sector_dos_id')->setOption('required', false);
            if (isset($this['empresa_sector_tres_id']))
                $this->getValidator('empresa_sector_tres_id')->setOption('required', false);
            if (isset($this['road_type_id']))
                $this->getValidator('road_type_id')->setOption('required', false);
            if (isset($this['concurso_address']))
                $this->getValidator('concurso_address')->setOption('required', false);
            if (isset($this['concurso_numero']))
                $this->getValidator('concurso_numero')->setOption('required', false);
            if (isset($this['concurso_piso']))
                $this->getValidator('concurso_piso')->setOption('required', false);
            if (isset($this['concurso_puerta']))
                $this->getValidator('concurso_puerta')->setOption('required', false);
            if (isset($this['city_id']))
                $this->getValidator('city_id')->setOption('required', false);
            if (isset($this['empresa_nombre']))
                $this->getValidator('empresa_nombre')->setOption('required', false);
            if (isset($this['producto_id']))
                $this->getValidator('producto_id')->setOption('required', false);
            if (isset($this['marca']))
                $this->getValidator('marca')->setOption('required', false);
            if (isset($this['producto_tipo_uno_id']))
                $this->getValidator('producto_tipo_uno_id')->setOption('required', false);
            if (isset($this['producto_tipo_dos_id']))
                $this->getValidator('producto_tipo_dos_id')->setOption('required', false);
            if (isset($this['producto_tipo_tres_id']))
                $this->getValidator('producto_tipo_tres_id')->setOption('required', false);

            $this->getValidator('concurso_categoria_id')->setOption('required', false);
            $contribucion_form = $this->validatorSchema['contribucion'];
            $contribucion_form['plan_accion']->setOption('required', false);
            $contribucion_form['resumen']->setOption('required', false);
        }
        else {
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
        }
    }

    public function save($con = null) {
        if ($this->isValid()) {
            $nueva = false;
            $values = $this->getValues();
            if ($this->type == 'empresa') {
                if (!$empresa = Doctrine::getTable('empresa')->createQuery()->where('name like ?', ucfirst(strtolower($values["empresa_nombre"])))->fetchOne()) {
                    $empresa = new Empresa();
                    $empresa->name = ucfirst(strtolower($values["empresa_nombre"]));
                    $nueva = true;
                }
                $empresa->setRoadTypeId($values['road_type_id'] != '' ? $values['road_type_id'] : null);
                $empresa->setEmpresaSectorUnoId($values['empresa_sector_uno_id'] != '' ? $values['empresa_sector_uno_id'] : null);
                $empresa->setEmpresaSectorDosId($values['empresa_sector_dos_id'] != '' ? $values['empresa_sector_dos_id'] : null);
                if (isset($values['empresa_sector_tres_id']))
                    $empresa->setEmpresaSectorTresId($values['empresa_sector_tres_id'] != '' ? $values['empresa_sector_tres_id'] : null);
                else
                    $empresa->setEmpresaSectorTresId(null);
                $empresa->setDireccion($values['concurso_address']);
                $empresa->setNumero($values['concurso_numero']);
//                $empresa->setStatesId($values['state_id']);
                $empresa->setLocalidadId($values['city_id']);
                $empresa->save();

                if ($nueva)
                    AlertasTable::nueva(1, 'Nueva empresa/entidad', 'Se ha dado de alta la empresa/entidad <a href="empresa/' . $empresa->getId() . '/edit">' . $values["empresa_nombre"] . '</a>');

                $this->getObject()->setEmpresaId($empresa->getId());
            }
            else if ($this->type == 'producto') {
                if (!$producto = Doctrine::getTable('producto')->createQuery()->where('Marca like ?', $values["producto_nombre"])->fetchOne()) {
                    $producto = new Producto();
                    $producto->setMarca($values["producto_nombre"]);
                    $nueva = true;
                }

                $producto->setName($values['producto']);
                $producto->setProductoTipoUnoId($values['producto_tipo_uno_id'] != '' ? $values['producto_tipo_uno_id'] : null);
                $producto->setProductoTipoDosId($values['producto_tipo_dos_id'] != '' ? $values['producto_tipo_dos_id'] : null);
                if (isset($values['producto_tipo_tres_id']))
                    $producto->setProductoTipoTresId($values['producto_tipo_tres_id'] != '' ? $values['producto_tipo_tres_id'] : null);
                else
                    $producto->setProductoTipoTresId(null);

                if (isset($values['modelo']))
                    $producto->setModelo($values['modelo']);

                $producto->save();
                $this->getObject()->setProductoId($producto->getId());

                if ($nueva)
                    AlertasTable::nueva(1, 'Nuevo producto', 'Se ha dado de alta el producto <a href="producto/' . $producto->getId() . '/edit">' . $values["producto"] . '</a> marca ' . $values["producto_nombre"] . ', modelo ' . $values["modelo"]);
            }
        }

        return parent::save($con);
    }

    public function doBind(array $values) {
        if (isset($values["borrador"])) {
            $values["concurso_estado_id"] = 9;
            $values["contribucion"]["contribucion_estado_id"] = 3;
        } else {
            $values["concurso_estado_id"] = 1;
            $values["contribucion"]["contribucion_estado_id"] = 1;
        }

        $values["contribucion"]["name"] = $values["name"];

        return parent::doBind($values);
    }

    public function saveEmbeddedForms($con = null, $forms = null) {
        if (null === $con) {
            $con = $this->getConnection();
        }

        if (null === $forms) {
            $forms = $this->embeddedForms;
        }

        foreach ($forms as $id_form => $form) {
            if ($form instanceof ConcursoArchivoForm) {
                $values = $this->getValues();
                if ($form->getObject()->getFile() && $values[$id_form]['status'] == TRUE) {
                    $upload = $form->getObject()->getFile();

                    $filename = sha1($upload->getOriginalName() . microtime() . rand()) . $upload->getExtension($upload->getOriginalExtension());
                    $upload->save(sfConfig::get('sf_images_dir') . '/documents/' . $filename);

                    $form->getObject()->setConcursoId($this->getObject()->getId()); //sfContext::getInstance()->getRequest()->getParameter('id'));
                    $form->getObject()->setFile($filename);
                    $form->getObject()->save($con);
                }
            } elseif ($form instanceof sfFormObject) {
                $form->getObject()->setConcursoId($this->getObject()->getId());
                $form->getObject()->setPrincipal(1);
                $form->getObject()->setUserId(sfContext::getInstance()->getUser()->getGuardUser()->getId());
                $form->getObject()->save($con);
                $form->saveEmbeddedForms($con);
            } else {
                $this->saveEmbeddedForms($con, $form->getEmbeddedForms());
            }
        }
    }

}

class SelectEmpresaForm extends BaseConcursoForm {

    public function configure() {
        $this->disableCSRFProtection();
        $this->useFields(array("empresa_id"));
        $this->widgetSchema->setLabels(array('empresa_id' => 'Selecciona la empresa'));
        //$this->useFields(array("producto_id"));
    }

}

class SelectProductoForm extends BaseConcursoForm {

    public function configure() {
        $this->disableCSRFProtection();
        //$this->widgetSchema["name"] = new sfWidgetFormInputText();
        $this->useFields(array("producto_id"));
        $this->widgetSchema->setLabels(array('producto_id' => 'Selecciona el producto'));
    }

}

class SelectProductoFormPrueba extends BaseConcursoForm {

    public function configure() {

    }

}

