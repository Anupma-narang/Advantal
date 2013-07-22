<?php

/**
 * Contratanos form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContratanosForm extends BaseContratanosForm {

    public function configure() {
        sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));
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
        $status_array = array('1' => 'Revista ', '2' => 'Tramitado', '3' => 'Cerrado');
        $op = $this->getOption('select');
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $caracteres_no_validos_numero = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_numero[array_search('/', $caracteres_no_validos_numero)]);
        $widget_arr = array(
            'name' => new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c')),
            'cif' => new sfWidgetFormInput(array(), array('maxlength' => 9, 'class' => 'tamano_9_c')),
            'actividad' => new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c')),
            'nombre' => new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c')),
            'apellido1' => new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c')),
            'apellido2' => new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c')),
            'cargo' => new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c')),
            'email' => new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c')),
            'empresa' => new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c')),
            'phone' => new sfWidgetFormInput(array(), array('maxlength' => 9, 'class' => 'tamano_9_c')),
            'road_type_id' => new sfWidgetFormDoctrineChoice(array(
                'model' => 'RoadType',
                'order_by' => array('orden', 'asc'),
                'add_empty' => __('Selecciona vía'))),
            'direccion' => new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c')),
            'num' => new sfWidgetFormInput(array(), array('maxlength' => 6, 'class' => 'tamano_4_c')),
            'piso' => new sfWidgetFormInput(array(), array('maxlength' => 3, 'class' => 'tamano_2_c')),
            'puerta' => new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c')),
            'cp' => new sfWidgetFormInput(array(), array('maxlength' => 5, 'class' => 'tamano_5_c')),
            'states_id' => new sfWidgetFormDoctrineDependentSelect(array(
                'label' => 'Provincia', 'model' => 'States', 'order_by' => array('orden', 'asc'), 'add_empty' => __('Selecciona provincia')
                    )),
            //  new sfWidgetFormDoctrineDependentSelect(array('model' => 'States', 'table_method' => 'getWithoutTodas', 'add_empty' => __('Selecciona provincia'))),
            'city_id' => new sfWidgetFormDoctrineDependentSelect(array(
                'label' => 'Localidad', 'model' => 'City', 'depends' => 'States', 'add_empty' => __('Selecciona localidad'), 'ajax' => true,
                    )),
            //new sfWidgetFormDoctrineDependentSelect(array('model' => 'City', 'depends' => 'States', 'ajax' => true, 'add_empty' => __('Selecciona localidad')), array()),
            'ayudar' => new sfWidgetFormTextareaCKEditor(array('height' => 200, 'width' => ((sfConfig::get("sf_app") == "backend") ? 600 : 585), 'err_id' => 'error_max_length', 'max_length' => 1000)),
            'servicio' => new sfWidgetFormInput(array(), array('maxlength' => 100, 'class' => 'tamano_70_c')),
            'antes' => new sfWidgetFormChoice(array('choices' => array('NO', 'SI'))),
            'form_type' => new sfWidgetFormInputCheckbox(),
            'eres' => new sfWidgetFormChoice(array('choices' => array(null => 'Selecciona régimen laboral', 'Trabajador por cuenta ajena', 'Autónomo', 'Tengo una empresa', 'Otro'))),
            'what' => new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c')),
            'status' => new sfWidgetFormChoice(array('choices' => $status_array))
        );
        if (sfConfig::get("sf_app") == "frontend") {
            unset($widget_arr['form_type']);
        }
        if (sfContext::getInstance()->getModuleName() == "contratanos_professional") {
            unset($widget_arr['name']);
        }
        $this->setWidgets($widget_arr);

        $this->widgetSchema->setNameFormat('contratanos[%s]');
        $caracteres_no_validos_piso_puerta = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_piso_puerta[array_search('.', $caracteres_no_validos_piso_puerta)]);
        $caracteres_no_validos_empresa = sfApplyForm2::$caracteres_no_validos_nombre;

        $request = sfContext::getInstance()->getRequest();
        $requiredCity = true;
        if ($request->isMethod('post') || (sfContext::getInstance()->getRequest()->getParameter('action') == "edit" || sfContext::getInstance()->getRequest()->getParameter('action') == "update")) {
            $ma_contratanos = $request->getParameter('contratanos');
            if (!empty($ma_contratanos['states_id'])) {
                $state = Doctrine::getTable('States')->findOneById($ma_contratanos['states_id']);
                $city = Doctrine::getTable('City')->findByStatesId($ma_contratanos['states_id']);
                if ($state && count($city) == 1 && $city[0]->getIsCapital()) {
                    $requiredCity = false;
                }
            }
        }

        $validator_arr = array(
            'name' => new sfValidatorString(array('required' => true), array('required' => __('Necesitas incluir el
nombre de tu empresa o entidad.'))),
            'cif' => new sfValidatorAnd(array(
                new sfValidatorString(
                        array(
                    'max_length' => 12,
                    'required' => true), array()),
                new sfValidatorRegex(array('pattern' => "/^((([A-Z]|[a-z])\d{8})|(\d{8}([A-Z]|[a-z])))$/"))
                    ), array(), array('required' => __('Necesitas incluir tu NIF/NIE ó CIF.'),
                'invalid' => __('Ese NIF, NIE ó CIF no es válido.'))),
            'actividad' => new sfValidatorAnd(array(
                new sfValidatorString(
                        array('max_length' => 80, 'min_length' => 2, 'required' => true), array('required' => 'Necesitas incluir una
actividad.')),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre,
                    'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/",
                    'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array(), array('invalid' => 'Esa actividad no es válida.',
                'required' => (sfConfig::get("sf_app") == "frontend") ? __('Necesitas incluir una
actividad.') : __('Necesitas incluir una
actividad.'))),
            'nombre' => new sfValidatorAnd(array(
                new sfValidatorString(
                        array('max_length' => 80, 'min_length' => 2, 'required' => true), array('required' => 'Necesitas incluir tu nombre.')),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre,
                    'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/",
                    'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array(), array('invalid' => 'Ese nombre no es válido.',
                'required' => (sfConfig::get("sf_app") == "frontend") ? __('Necesitas incluir tu nombre.') : __('Necesitas incluir tu nombre.'))),
            'apellido1' => new sfValidatorAnd(array(
                new sfValidatorString(
                        array(
                    'max_length' => 80,
                    'min_length' => 2,
                    'required' => true), array('required' => 'Necesitas incluir tu primer apellido.')),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre,
                    'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/",
                    'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array(), array('invalid' => 'Ese apellido no es válido.',
                'required' => (sfConfig::get("sf_app") == "frontend") ? __('Necesitas incluir tu primer apellido.') : __('Necesitas incluir tu primer apellido.'))),
            'apellido2' => new sfValidatorAnd(array(
                new sfValidatorString(
                        array(
                    'max_length' => 80,
                    'min_length' => 2,
                    'required' => true), array()),
//  			new sfValidatorRegex(array('pattern' =>"/^[a-z\s\_áéíóúAÉÍÓÚÑñ\']+$/i"),array())
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/",
                    'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array(), array('invalid' => 'Ese apellido no es válido.',
                'required' => (sfConfig::get("sf_app") == "frontend") ? __('Necesitas incluir tu segundo apellido.') : __('Necesitas incluir tu segundo apellido.'))),
            'cargo' => new sfValidatorAnd(array(
                new sfValidatorString(
                        array('max_length' => 80, 'min_length' => 2, 'required' => true), array('required' => 'Necesitas incluir tu cargo.')),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_nombre,
                    'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/",
                    'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array(), array('invalid' => 'Ese cargo no es válido.',
                'required' => (sfConfig::get("sf_app") == "frontend") ? __('Necesitas incluir tu cargo.') : __('Necesitas incluir tu cargo.'))),
            'email' => new sfValidatorEmail(array('required' => true,), array('required' => 'Necesitas incluir tu correo
electrónico.', 'invalid' => 'Ese correo electrónico no es válido.')),
            'phone' => new sfValidatorRegex(array(
                'pattern' => '#^(\d{9})$#',
                'required' => false
                    ), array('invalid' => 'Necesitas introducir 9 números sin espacios.')
            ),
            'road_type_id' => new sfValidatorString(array('required' => false)),
            'eres' => new sfValidatorString(array('required' => false), array('required' => __('No has seleccionado tu régimen laboral.'))),
            'direccion' => new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 70, 'required' => false), array('invalid' => __('Esa dirección no es válida.'))),
                new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_direccion, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array('required' => false), array('invalid' => __('Esa dirección no es válida.'))
                    , array(), array('required' => __('No has incluido la dirección de tu empresa o entidad.'),
                'invalid' => __('Esa dirección de tu empresa o entidad no es válida.'))),
            'num' => new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 6, 'required' => false)),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_numero, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array('required' => false), array('invalid' => __('Ese Nº no es válido.'))
                    , array('required' => true), array('required' => __('No has incluido el Nº de la dirección de tu empresa o entidad.'),
                'invalid' => __('Ese número no es válido.'))),
            'piso' => new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 6, 'required' => false)),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array('required' => false), array('invalid' => __('Ese Piso no es válido.'))
                    , array(), array('invalid' => __('Ese Piso no es válido.'))),
            'puerta' => new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 6, 'required' => false)),
                new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array('required' => false), array('invalid' => __('Esa Puerta no es válida.'))
                    , array(), array('invalid' => __('Esa Puerta no es válida.'))),
            'cp' => new sfValidatorPass(),
            'states_id' => new sfValidatorString(array('required' => true), array('required' => 'Necesitas seleccionar una provincia.')),
            'city_id' => new sfValidatorString(array('required' => $requiredCity), array('required' => 'Necesitas seleccionar una localidad.')),
            'ayudar' => new sfValidatorString(array('required' => true), array('required' => 'Necesitas incluir en qué te podemos ayudar.')),
            //'ayudar' => new sfValidatorString(array('required' => true, 'max_length' => 3000), array('required' => 'No has incluido en qué te podemos ayudar.', 'max_length' => __('Has superado el límite para tu comentario.'))),
            'servicio' => new sfValidatorString(array('required' => false)),
            'antes' => new sfValidatorString(array('required' => false)),
            'empresa' => new sfValidatorString(array('required' => false)),
            'form_type' => new sfValidatorBoolean(array('required' => false)),
            'status' => new sfValidatorChoice(array('choices' => array(1, 2, 3), 'required' => false)),
            'eres' => new sfValidatorString(array('required' => true), array('required' => 'Necesitas incluir tu régimen laboral.')),
            'created_at' => new sfValidatorDateTime(array('required' => false)),
            'what' =>
            new sfValidatorString(
                    array('required' => false, 'trim' => false, 'min_length' => 1, 'max_length' => 70), array('required' => __('No has incluido el nombre de tu empresa o entidad.'), 'min_length' => __('La empresa o entidad debe tener entre 1 y 70 caracteres, con espacios en blanco.'), 'max_length' => __('La empresa o entidad debe tener entre 1 y 70 caracteres, con espacios en blanco.'))
            )
        );
        if (sfConfig::get("sf_app") == "frontend") {
            unset($validator_arr['form_type']);
        }
        if (sfContext::getInstance()->getModuleName() == "contratanos_professional") {
            unset($validator_arr['name']);
        }
        $this->setValidators($validator_arr);

        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidate'))));

        $this->widgetSchema->setLabels(array(
            'name' => 'Nombre de tu empresa/entidad*',
            'cif' => ($op == 1) ? 'CIF*' : 'NIF/NIE/CIF*',
            'actividad' => 'Actividad de tu empresa/entidad*',
            'nombre' => 'Tu nombre*',
            'apellido1' => 'Tu apellido 1*',
            'apellido2' => 'Tu apellido 2*',
            'cargo' => 'Cargo que ocupas*',
            'email' => 'Correo electrónico*',
            'eres' => 'Régimen laboral',
            'phone' => 'Teléfono',
            'road_type_id' => 'Tipo de vía',
            'direccion' => ($op == 1) ? 'Dirección de la empresa/entidad*' : 'Dirección',
            'num' => 'Nº',
            'piso' => 'Piso',
            'puerta' => 'Puerta',
            'cp' => 'C.P',
            'states_id' => 'Provincia*',
            'city_id' => 'Localidad*',
            'ayudar' => 'Comentarios',
            'servicio' => '¿Qué servicio deseas contratar?',
            'antes' => '¿Has sido antes objeto de un Análisis de Experiencia de Cliente o de una auditoría de calidad?',
            'what' => '¿Cuál/es?',
            'empresa' => 'Nombre de tu empresa'
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->validatorSchema->setOption('filter_extra_fields', true);
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

    public function checkProvincia($validator, $values) {
        if ($values['states_id'] == 1) {
            $this->validatorSchema['city_id']->setOption('required', false);
            $this->validatorSchema['road_type_id']->setOption('required', false);
            $this->validatorSchema['direccion']->setOption('required', false);
            $this->validatorSchema['numero']->setOption('required', false);
            $this->validatorSchema['googleMap']['address']->setOption('required', false);
        }

        return $values;
    }

}
