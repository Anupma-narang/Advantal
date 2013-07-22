<?php

/**
 * UserCompanyCaseStudyRequest form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserCompanyCaseStudyRequestForm extends BaseUserCompanyCaseStudyRequestForm {

    public function configure() {

        //set status array
        $status_array = array('1' => 'Revista ',
            '2' => 'Tramitado',
            '3' => 'Cerrado');
        //fetch username array
        $username_array = Doctrine::getTable('sfGuardUser')->getUsernames();
        //set language configuration
        sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));

        $usuario = $this->getOption('usuario');
        $usuari = false;
        if (isset($usuario))
            if ($usuario->isAuthenticated())
                $usuari = true;

        //$guard = $usuario->getGuardUser();
        //set widgets
        //$this->widgetSchema['user_name'] = new sfWidgetFormInputText(array('default' => ($usuari) ? $usuario : ''), array('maxlength' => 25, 'style' => 'width:176px;'));
        $this->widgetSchema['description'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'max_length' => 43000, 'err_id' => 'error_max_length'));
        $this->widgetSchema['summary'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'max_length' => 12300, 'err_id' => 'error_max_length_summary'));
        $this->validatorSchema['description'] = new sfValidatorString(
                        array('required' => true), array(
                    'required' => (sfConfig::get("sf_app") == "frontend") ? 'Necesitas incluir tu
caso de éxito.' : 'No has incluido una descripción del caso de éxito.',
                    'invalid' => __('Ese caso de éxito no es válido.'
                    )
                ));
        $this->validatorSchema['summary'] = new sfValidatorString(
                        array('required' => true), array(
                    'required' => (sfConfig::get("sf_app") == "frontend") ? __('Necesitas incluir el
resumen de tu caso de éxito.') : __('Necesitas incluir el
resumen de tu caso de éxito.'),
                    'invalid' => __('Ese resumen de tu caso de éxito no es válido.')
                ));
        $this->widgetSchema['homepage'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['direccion'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['cp'] = new sfWidgetFormInput(array(), array('maxlength' => 5, 'class' => 'tamano_5_c'));
        $this->widgetSchema['numero'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'style' => 'width:30px;'));
        $this->widgetSchema['piso'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'class' => 'tamano_2_c'));
        $this->widgetSchema['puerta'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
        $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => $status_array));
        $this->widgetSchema['name'] = new audWidgetFormJQueryAutocompleterInField(array(
                    'url' => url_for('@empresa_autocomplete_name')
                        ), array('maxlength' => 70, 'class' => 'tamano_32_c'));

        $this->widgetSchema['road_type_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'RoadType',
                    'order_by' => array('orden', 'asc'),
                    'add_empty' => __('Selecciona vía')));



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
        $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => $this->getRelatedModelName('EmpresaSectorUno'),
                    'add_empty' => __('Selecciona sector')), array('style' => 'width:265px'));
        $this->validatorSchema['empresa_sector_uno_id']->setOption('required', true);
        $this->validatorSchema['empresa_sector_uno_id']->setMessage('required', 'Necesitas seleccionar un sector.');



        $this->widgetSchema['empresa_sector_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => $this->getRelatedModelName('EmpresaSectorDos'),
                    'depends' => 'EmpresaSectorUno',
                    'ajax' => true,
                    'add_empty' => __('Selecciona subsector')), array('style' => 'width:265px'));
        $this->validatorSchema['empresa_sector_dos_id']->setOption('required', true);
        $this->validatorSchema['empresa_sector_dos_id']->setMessage('required', 'Necesitas seleccionar un subsector.');

        $this->widgetSchema['empresa_sector_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => $this->getRelatedModelName('EmpresaSectorTres'),
                    'depends' => 'EmpresaSectorDos',
                    'ajax' => true,
                    'add_empty' => __('Selecciona actividad')), array('style' => 'width:265px'));
        $this->validatorSchema['empresa_sector_tres_id']->setOption('required', false);
        $this->validatorSchema['empresa_sector_tres_id']->setMessage('required', 'Necesitas seleccionar una actividad.');

        $choices = array(0 => 'Pendiente de revisar', 1 => 'Revisada');
        $this->validatorSchema['name'] = new sfValidatorAnd(array(
                    new sfValidatorString(
                            array('required' => true, 'trim' => false, 'min_length' => 1, 'max_length' => 70), array('required' => __('Necesitas incluir una empresa o entidad.'), 'min_length' => __('La empresa o entidad debe tener entre 1 y 70 caracteres, con espacios en blanco.'), 'max_length' => __('La empresa o entidad debe tener entre 1 y 70 caracteres, con espacios en blanco.'))
                    ),
                    new sfValidatorNombres(array('caracteres_no_validos' => 'caracteres_no_validos_empresa'), array('invalid' => __('Esa empresa o entidad no es válida.')))
                        ), array(), array('required' => __('Necesitas incluir una empresa o entidad.')));


        $this->validatorSchema['road_type_id']->setOption('required', true);
        $this->validatorSchema['road_type_id']->setMessage('required', 'Necesitas seleccionar un tipo de vía.');

        // $this->validatorSchema['homepage'] = new sfValidatorUrl(array('required' => false), array('invalid' => __('Esa página web no es correcta.')));

        $this->validatorSchema['homepage'] = new sfValidatorRegex(array('pattern' => "/\b(?:(?:https?|ftpppppxpxpxpxp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", 'required' => false), array('invalid' => __('Esa página web no es correcta.')));

        $this->validatorSchema['direccion'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 70, 'required' => false), array('invalid' => __('Esa dirección no es válida.'))),
                    new sfValidatorNombres(array('caracteres_no_validos' => 'caracteres_no_validos_direccion', 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => true), array('required' => __('Necesitas incluir una dirección.'),
                    'invalid' => __('Esa dirección no es válida.')
                        )
        );
        $this->validatorSchema['numero'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 6, 'required' => true)),
                    new sfValidatorNombres(array('caracteres_no_validos' => 'caracteres_no_validos_numero', 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array('required' => true), array('required' => 'Necesitas incluir un Nº.',
                    'invalid' => __('Ese Nº no es válido.'))
        );
        $this->validatorSchema['piso'] = new sfValidatorPass();
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
        $this->validatorSchema['numero']->setMessage('required', 'Necesitas incluir un Nº.');

        $this->validatorSchema['states_id']->setOption('required', true);
        $this->validatorSchema['states_id']->setMessage('required', 'Necesitas seleccionar una provincia.');

        $this->validatorSchema['city_id']->setOption('required', true);
        $this->validatorSchema['city_id']->setMessage('required', 'Necesitas seleccionar una localidad.');
        $this->validatorSchema['status'] = new sfValidatorChoice(array('choices' => array(1, 2, 3), 'required' => false));
        $this->validatorSchema['user_name'] = new sfValidatorString(array('max_length' => 70));
        $this->validatorSchema['user_name']->setMessage('required', 'Necesitas incluir un Usuario.');

        /*
          $this->widgetSchema['file1'] = new sfWidgetFormInputFileEditable(array('file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getFile1(),
          'is_image' => false,
          'edit_mode' => true,
          'template' => '<div><strong>' . $this->getObject()->getFile1() . '</strong></div>%input%'));
          $this->widgetSchema['file2'] = new sfWidgetFormInputFileEditable(array('file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getFile2(),
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
          'template' => '<div><strong>' . $this->getObject()->getFile4() . '</strong></div>%input%'));

          $this->widgetSchema['logo'] = new sfWidgetFormInputFileEditable(array('file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getLogo(),
          'is_image' => false,
          'edit_mode' => true,
          'template' => '<div><strong>' . $this->getObject()->getLogo() . '</strong></div>%input%'));
          $this->validatorSchema['file1'] = new sfValidatorFile(array('required' => false, 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
          $this->validatorSchema['file2'] = new sfValidatorFile(array('required' => false, 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
          $this->validatorSchema['file3'] = new sfValidatorFile(array('required' => false, 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
          $this->validatorSchema['file4'] = new sfValidatorFile(array('required' => false, 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
          $this->validatorSchema['logo'] = new sfValidatorFile(array('required' => false, 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
         */

        for ($i = 1; $i <= 4; $i++) {
            $this->widgetSchema['file' . $i] = new pkWidgetFormInputFilePersistentCasestudy(array('existing-html' => '<p>Ya has subido uno o varios ficheros.<br />Si desea reemplazar el fichero use el botón Examinar.</p>'));
            $this->validatorSchema['file' . $i] = new pkValidatorFilePersistent(array(
                        'required' => false,
                        'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/',
                        'max_size' => 10240000,
                        'mime_type_guessers' => array(array('fakemime', 'detect')),
                            // 'mime_types' => functions::$mime_types,
                            // 'mime_type_guessers' => array()
                            ), array('max_size' => 'Puedes incluir hasta 10 MB de archivos por mensaje.'));
        }
        $this->widgetSchema['logo'] = new pkWidgetFormInputFilePersistentlogo(array('existing-html' => '<p>Ya has subido uno o varios ficheros.<br />Si desea reemplazar el fichero use el botón Examinar.</p>'));
        $this->validatorSchema['logo'] = new pkValidatorFilePersistent(array(
                    'required' => false,
                    'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/',
                    'max_size' => 10240000,
                    'mime_type_guessers' => array(array('fakemime', 'detect')),
                        //'mime_type_guessers' => array()
                        ), array('max_size' => 'Puedes incluir hasta 10 MB de archivos por mensaje.'));

        //username
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        //$this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User')));
        $this->validatorSchema['user_id']->setOption('required', false);
        //username
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array("default" => (!$this->isNew() ? $this->getObject()->getUser()->getUsername() : "")), array('id' => 'user_company_case_study_request_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->validatorSchema['user_name']->setOption('required', false);


        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidate'))));



        $this->widgetSchema->setLabels(array(
            'name' => 'Nombre de la empresa/entidad*',
            'empresa_sector_uno_id' => "Sector",
            'empresa_sector_dos_id' => "Subsector",
            'empresa_sector_tres_id' => "Actividad",
            'road_type_id' => 'Tipo de vía*',
            'direccion' => 'Dirección*',
            'description' => 'Descripción del caso de éxito',
            'numero' => 'Nº*',
            'states_id' => 'Provincia',
            'user_name' => 'Tu Usuario/Alias',
            'homepage' => 'Página web',
            'states_id' => 'Provincia*',
            'city_id' => 'Localidad*',
            'cp' => 'C.P.',
            'file1' => 'Archivo 1',
            'file2' => 'Archivo 2',
            'file3' => 'Archivo 3',
            'file4' => 'Archivo 4',
            'logo' => 'Añadir logo',
        ));

        $this->widgetSchema->setNameFormat('user_company_case_study_request[%s]');
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

        $this->validatorSchema['user_name']->setMessages(array('required' => __("Necesitas seleccionar un Usuario"), 'invalid' => __('Ese Usuario no es válido')));
        $this->validatorSchema['user_id']->setMessages(array('required' => __("Necesitas seleccionar un Usuario"), 'invalid' => __('Ese Usuario no es válido')));

        unset($this["created_at"], $this["updated_at"]);
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

}