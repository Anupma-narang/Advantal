<?php

/**
 * UserCompanyCaseStudy form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserCompanyCaseStudyForm extends BaseUserCompanyCaseStudyForm {

    public function configure() {
        sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));
        //set status array
        $status_array = array('1' => 'Revista ', '2' => 'Tramitado', '3' => 'Cerrado');

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
        //get usernames
        //$user_names = Doctrine::getTable('sfGuardUser')->getUsernames();
        //fetch direction records
        $direction_array = Doctrine::getTable('Empresa')->getAllDirections();
        unset($this["created_at"], $this["updated_at"]);
        //get company names
        $company_names_array = Doctrine::getTable('Empresa')->getAllCompanyNames();
        //set widgets
        $this->widgetSchema['description'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'error_max_length', 'max_length' => 43000));
        $this->widgetSchema['summary'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'error_max_length_summary', 'max_length' => 1000));
        $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => $status_array, 'label' => 'Estado'));
        $this->widgetSchema['direccion'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));


        $this->widgetSchema['numero'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
        $this->widgetSchema['piso'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'class' => 'tamano_2_c'));
        $this->widgetSchema['puerta'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));

        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));

        $this->widgetSchema['road_type_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'RoadType',
                    'order_by' => array('orden', 'asc'),
                    'add_empty' => __('Selecciona vía')));

        $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => $this->getRelatedModelName('EmpresaSectorUno'),
                    'order_by' => array('orden', 'asc'),
                    'add_empty' => 'Selecciona sector',
                ));

        $this->widgetSchema['empresa_sector_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'EmpresaSectorDos',
//            'table_method' => 'getSectoresDosOrderByOrden',
                    'depends' => 'EmpresaSectorUno',
                    'ajax' => true,
                    'add_empty' => 'Selecciona subsector '));

        $this->widgetSchema['empresa_sector_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'EmpresaSectorTres',
                    //'table_method' => 'getSectoresTresOrderByOrden',
                    'depends' => 'EmpresaSectorDos',
                    'ajax' => true,
                    'add_empty' => 'Selecciona actividad '));

        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Provincia',
                    'model' => 'States',
                    'order_by' => array('orden', 'asc'),
                    'add_empty' => 'Selecciona provincia'
                ));
        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'label' => 'Localidad',
                    'model' => 'City',
                    'depends' => 'States',
                    'add_empty' => 'Selecciona localidad',
                    'ajax' => true,
                ));
        $this->widgetSchema['file1'] = new sfWidgetFormInputFileEditable(array('file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getFile1(),
                    'is_image' => false,
                    'edit_mode' => true,
                    'label' => 'Archivo',
                    'template' => '<div><strong>' . $this->getObject()->getFile1() . '</strong></div>%input%'));
        /* $this->widgetSchema['file2'] = new sfWidgetFormInputFileEditable(array('file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getFile2(),
          'is_image' => false,
          'edit_mode' => true,
          'template' => '<div><strong>' . $this->getObject()->getFile2() . '</strong></div>%input%'));
          $this->widgetSchema['file3'] = new sfWidgetFormInputFileEditable(array('file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getFile3(),
          'is_image' => false,
          'edit_mode' => true,
          'template' => '<div><strong>' . $this->getObject()->getFile3() . '</strong></div>%input%'));
          $this->widgetSchema['file4'] = new sfWidgetFormInputFileEditable(array('file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getFile4(),
          'is_image' => false,
          'edit_mode' => true,
          'template' => '<div><strong>' . $this->getObject()->getFile4() . '</strong></div>%input%')); */

        $this->widgetSchema['logo'] = new sfWidgetFormInputFileEditable(array('file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getLogo(),
                    'is_image' => false,
                    'edit_mode' => true,
                    'label' => 'Añadir logo',
                    'template' => '<div><strong>' . $this->getObject()->getLogo() . '</strong></div>%input%'));

        $choices = array(0 => 'Pendiente de revisar', 1 => 'Revisada');

        //set validation

        $this->validatorSchema['name'] = new sfValidatorString(array('required' => true, 'max_length' => 70), array('required' => __('No has incluido una empresa o entidad.')));

        $this->validatorSchema['road_type_id']->setOption('required', true);
        $this->validatorSchema['road_type_id']->setMessage('required', 'No has seleccionado un tipo de vía.');
        $this->validatorSchema['direccion'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 70, 'required' => true)),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_direccion, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => true), array('required' => 'No has incluido una dirección.', 'invalid' => __('Esa dirección no es válida.'))
        );
        $this->validatorSchema['description'] = new sfValidatorString(array('required' => true), array('required' => __('No has incluido una descripción del caso de éxito.')));
        //$this->validatorSchema['description'] = new sfValidatorString(array('required' => true, 'max_length' => 43000), array('required' => __('No has incluido una descripción del caso de éxito.'), 'max_length' => __('Has superado el espacio permitido para la descripción del caso de éxito.')));
        $this->validatorSchema['summary'] = new sfValidatorString(array('required' => true), array('required' => __('No has incluido un resumen del caso de éxito.')));
        //$this->validatorSchema['summary'] = new sfValidatorString(array('required' => true, 'max_length' => 1000), array('required' => __('No has incluido un resumen del caso de éxito.'), 'max_length' => __('Has superado el espacio permitido para el resumen del caso de éxito.')));
        $this->validatorSchema['status'] = new sfValidatorChoice(array('choices' => array(1, 2, 3), 'required' => false));
        $this->validatorSchema['numero'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 6, 'required' => true)),
                    new sfValidatorNombres(array('caracteres_no_validos' => 'caracteres_no_validos_numero', 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => true), array('required' => 'No has incluido un Nº',
                    'invalid' => __('Ese Nº no es válido.'))
        );

        $this->validatorSchema['piso'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 6, 'required' => false)),
                    new sfValidatorNombres(array('caracteres_no_validos' => 'caracteres_no_validos_piso_puerta', 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => false), array('invalid' => __('Ese Piso no es válido.'))
        );


        $this->validatorSchema['puerta'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 6, 'required' => false)),
                    new sfValidatorNombres(array(
                        'caracteres_no_validos' => 'caracteres_no_validos_piso_puerta', 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => false), array('invalid' => __('Esa Puerta no es válida.'))
        );

        $this->validatorSchema['numero']->setOption('required', true);
        $this->validatorSchema['numero']->setMessage('required', 'No has incluido un Nº.');

        $request = sfContext::getInstance()->getRequest();
        $requiredCity = true;
        if ($request->isMethod('post') || (sfContext::getInstance()->getRequest()->getParameter('action') == "edit" || sfContext::getInstance()->getRequest()->getParameter('action') == "update")) {
            $ma_contratanos = $request->getParameter('user_company_case_study');
            if (!empty($ma_contratanos['states_id'])) {
                $state = Doctrine::getTable('States')->findOneById($ma_contratanos['states_id']);
                $city = Doctrine::getTable('City')->findByStatesId($ma_contratanos['states_id']);
                if ($state && count($city) == 1 && $city[0]->getIsCapital()) {
                    $requiredCity = false;
                }
            }
        }


        $this->validatorSchema['states_id']->setOption('required', true);
        $this->validatorSchema['states_id']->setMessage('required', 'No has seleccionado una provincia.');

        $this->validatorSchema['city_id']->setOption('required', $requiredCity);
        $this->validatorSchema['city_id']->setMessage('required', 'No has seleccionado una localidad.');

        $this->validatorSchema['empresa_sector_uno_id']->setOption('required', true);
        $this->validatorSchema['empresa_sector_uno_id']->setMessage('required', 'No has seleccionado un sector.');

        $this->validatorSchema['empresa_sector_dos_id']->setOption('required', true);
        $this->validatorSchema['empresa_sector_dos_id']->setMessage('required', 'No has seleccionado un subsector.');
        $this->validatorSchema['empresa_sector_tres_id']->setOption('required', false);
        $this->validatorSchema['empresa_sector_tres_id']->setMessage('required', 'No has seleccionado una actividad.');
        $this->validatorSchema['file1'] = new sfValidatorFile(array('required' => false, 'mime_type_guessers' => array(array('fakemime', 'detect')), 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
//        $this->validatorSchema['file2'] = new sfValidatorFile(array('required' => false, 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
//        $this->validatorSchema['file3'] = new sfValidatorFile(array('required' => false, 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
//        $this->validatorSchema['file4'] = new sfValidatorFile(array('required' => false, 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
        $this->validatorSchema['logo'] = new sfValidatorFile(array('required' => false, 'mime_type_guessers' => array(array('fakemime', 'detect')), 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));

        //username
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        //$this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User')));
        $this->validatorSchema['user_id']->setOption('required', false);
        //username
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array("default" => (!$this->isNew() ? $this->getObject()->getUser()->getUsername() : "")), array('id' => 'user_company_case_study_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->validatorSchema['user_name']->setOption('required', false);
        //$this->validatorSchema['user_name'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'column' => 'username'));
        //$this->validatorSchema['user_name']->setMessage('required', 'Necesitas incluir un Usuario.');
        //post validator
        $this->mergePreValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkProvincia')))
        );
        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkActividad')))
        );
        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkUserNameValide')))
        );

        unset($this->widgetSchema['file2']);
        unset($this->widgetSchema['file3']);
        unset($this->widgetSchema['file4']);

        unset($this->validatorSchema['file2']);
        unset($this->validatorSchema['file3']);
        unset($this->validatorSchema['file4']);

        $this->widgetSchema->setLabels(array(
            'name' => 'Nombre Empresa o entidad',
            'road_type_id' => 'Tipo de vía',
            'direccion' => 'Dirección',
            'numero' => 'Número',
            'empresa_sector_uno_id' => 'Sector',
            'empresa_sector_dos_id' => 'Subsector',
            'empresa_sector_tres_id' => 'Actividad',
            'states_id' => 'Provincia',
        ));

        $this->validatorSchema['user_name']->setMessages(array('required' => __("Necesitas seleccionar un Usuario"), 'invalid' => __('Ese Usuario no es válido')));
        $this->validatorSchema['user_id']->setMessages(array('required' => __("Necesitas seleccionar un Usuario"), 'invalid' => __('Ese Usuario no es válido')));

    }

    public function checkProvincia($validator, $values) {
        if ($values['states_id'] == 1) {
            $this->validatorSchema['city_id']->setOption('required', false);
            $this->validatorSchema['road_type_id']->setOption('required', false);
            $this->validatorSchema['direccion']->setOption('required', false);
            $this->validatorSchema['numero']->setOption('required', false);
        }

        return $values;
    }

    public function checkUserNameValide($validator, $values) {
        if (empty($values['user_id']) && empty($values['user_name'])) {
            $error = new sfValidatorError($validator, 'Necesitas seleccionar un Usuario.');
            throw new sfValidatorErrorSchema($validator, array('user_name' => $error));
        } elseif (empty($values['user_id']) && !empty($values['user_name'])) {
            $error = new sfValidatorError($validator, 'Ese Usuario no es válido.');
            throw new sfValidatorErrorSchema($validator, array('user_name' => $error));
        } elseif (!empty($values['user_id']) && empty($values['user_name'])) {
            $error = new sfValidatorError($validator, 'Necesitas seleccionar un Usuario.');
            throw new sfValidatorErrorSchema($validator, array('user_name' => $error));
        } elseif (!empty($values['user_id']) && !empty($values['user_name'])) {
            $userName = Doctrine::getTable('sfGuardUser')->findBy('username', $values['user_name'])->getData();
            $userid = Doctrine::getTable('sfGuardUser')->findBy('id', $values['user_id'])->getData();
            if (empty($userName)) {
                $error = new sfValidatorError($validator, 'Ese Usuario no es válido.');
                throw new sfValidatorErrorSchema($validator, array('user_name' => $error));
            } elseif (empty($userid)) {
                $error = new sfValidatorError($validator, 'Ese Usuario no es válido.');
                throw new sfValidatorErrorSchema($validator, array('user_name' => $error));
            }
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

    public function checkCP($validator, $values) {
        if ((isset($values['states_id'])) and ($values['cp'] != '')) {
            $name = Doctrine::getTable('States')->findOneById($values['states_id'])->getName();
            if (false == cp::checkCpByStateName($values['cp'], $name)) {
                $invalid = new sfValidatorError($validator, 'Ese C.P. no es válido.');
                throw new sfValidatorErrorSchema($validator, array('codigopostal' => $invalid));
            }
        }

        return $values;
    }

}