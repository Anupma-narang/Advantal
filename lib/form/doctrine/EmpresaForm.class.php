<?php

/**
 * Empresa form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EmpresaForm extends BaseEmpresaForm {

    public function configure() {
        sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));
        unset($this["user_id"], $this['slug'], $this['created_at'], $this['updated_at'], $this['featured']);
        $this->embedRelation('googleMap', 'GoogleMapForm');
        $this->widgetSchema['direccion'] = new audWidgetFormJQueryAutocompleterInField(array(
            'url' => url_for('@empresa_autocomplete_direccion'),
                ), array('maxlength' => 70, 'class' => 'tamano_32_c'));

        $this->widgetSchema['gmap_check'] = new sfWidgetFormInputHidden(array('default' => ($this->getObject()->isNew() ? 'false' : 'true')));
        $this->widgetSchema['numero'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c_1'));
        $this->widgetSchema['piso'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'class' => 'tamano_3_c_1'));
        $this->widgetSchema['puerta'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));

        $this->widgetSchema['name'] = new audWidgetFormJQueryAutocompleterInField(array(
            'url' => url_for('@empresa_autocomplete_name')
                ), array('maxlength' => 70, 'class' => 'tamano_32_c'));

        $this->widgetSchema['telefono']->setAttributes(array('maxlength' => 9, 'class' => 'tamano_8_c_1'));
        $this->widgetSchema['road_type_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => 'RoadType',
            'order_by' => array('orden', 'asc'),
            'add_empty' => __('Selecciona vía')));

        /* $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineChoice(array(
          'model' => $this->getRelatedModelName('EmpresaSectorUno'),
          'order_by' => array('orden', 'asc'),
          'add_empty' => 'Selecciona sector',
          )); */

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
            'add_empty' => __('Selecciona provincia')
        ));
        $this->widgetSchema['localidad_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'label' => 'Localidad',
            'model' => 'City',
            'depends' => 'States',
            'add_empty' => __('Selecciona localidad'),
            'ajax' => true,
        ));
        $this->widgetSchema['lista'] = new sfWidgetFormChoice(array(
            'choices' => sfConfig::get('app_listas_tipos')
        ));
        if (sfContext::getInstance()->getModuleName() == 'empresaListaBlanca' && (sfContext::getInstance()->getRequest()->getParameter('action') == "new" || sfContext::getInstance()->getRequest()->getParameter('action') == "create")) {
            $this->setDefault('lista', 'lb');
        } elseif (sfContext::getInstance()->getModuleName() == 'listaNegraEmpresa' && (sfContext::getInstance()->getRequest()->getParameter('action') == "new" || sfContext::getInstance()->getRequest()->getParameter('action') == "create")) {
            $this->setDefault('lista', 'ln');
        }

        //Deven: 2.13) Add the field Destacada (“Highlighted”)
        /* $destacada_choice = array(
          'NULL' => __('Sin destacar'),
          'sector' => __('Destacada por actividad'),
          'provincia' => __('Destacada por provincia'),
          'localidad' => __('Destacada por localidad'),
          'sector_provincia' => __('Destacada por actividad y provincia'),
          'sector_localidad' => __('Destacada por actividad y localidad'));


          $this->widgetSchema['destacada'] = new sfWidgetFormChoice(array(
          'choices' => $destacada_choice
          )); */

        $this->widgetSchema['lista_cuestionario_id'] = new sfWidgetFormDoctrineChoiceEdit(array(
            'model' => $this->getRelatedModelName('Cuestionario'),
            'add_empty' => 'Selecciona un cuestionario',
            'url' => '@cuestionario_edit',
            'table_method' => 'getCuestionariosForEmpresa'
        ));
        $this->widgetSchema['comentario_inicial'] = new sfWidgetFormTextareaCKEditor(array('width'=>600, 'height' => 200, 'err_id' => 'error_max_length', 'max_length' => 3000));
        $this->widgetSchema['texto_lista_negra'] = new sfWidgetFormTextareaCKEditor(array('width'=>600, 'height' => 200, 'err_id' => 'error_max_length', 'max_length' => 3000));
        $this->widgetSchema['concurso_id']->setOption('query', ConcursoTable::getConcursosCerradosQuery($this->getObject()));

        $this->widgetSchema['featured'] = new sfWidgetFormInputCheckbox();
        $this->widgetSchema['featured_order'] = new sfWidgetFormInputText(array(), array('maxlength' => 2, 'class' => 'tamano_2_c'));
        $this->validatorSchema['featured'] = new sfValidatorBoolean(array('required' => false));
        $this->validatorSchema['featured_order'] = new sfValidatorInteger(array('required' => false), array('invalid' => 'Sólo puedes introducir números.'));

        $choices = array(0 => 'Pendiente de revisar', 1 => 'Revisada');

        $this->widgetSchema['valida'] = new sfWidgetFormChoice(array('choices' => $choices));

        // pila de validators...
        $this->validatorSchema['email'] = new sfValidatorEmail(array('required' => false, 'trim' => true), array('invalid' => 'Ese correo electrónico no es válido.'));
        $this->validatorSchema['lista'] = new sfValidatorChoice(array(
            'choices' => array_keys(sfConfig::get('app_listas_tipos'))
        ));
        $this->validatorSchema['valida'] = new sfValidatorChoice(array('choices' => array_keys($choices)));

        $this->setValidator('name', new sfValidatorAnd(array(
            new sfValidatorString(
                    array('required' => true, 'trim' => false, 'min_length' => 1, 'max_length' => 70), array('required' => __('No has incluido una empresa o entidad.'), 'min_length' => __('La empresa o entidad debe tener entre 1 y 70 caracteres, con espacios en blanco.'), 'max_length' => __('La empresa o entidad debe tener entre 1 y 70 caracteres, con espacios en blanco.'))
            ),
            new sfValidatorNombres(array('caracteres_no_validos' => 'caracteres_no_validos_empresa'), array('invalid' => __('Esa empresa o entidad no es válida.')))
                ), array(), array('required' => __('No has incluido una empresa o entidad.'))));


        $this->validatorSchema['road_type_id']->setOption('required', true);
        $this->validatorSchema['road_type_id']->setMessage('required', 'No has seleccionado un tipo de vía.');


        $this->validatorSchema['direccion'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'required' => false), array('invalid' => __('Esa dirección no es válida.'))),
            new sfValidatorNombres(array('caracteres_no_validos' => 'caracteres_no_validos_direccion', 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => true), array('required' => __('No has incluido una dirección.'),
            'invalid' => __('Esa dirección no es válida.')
                )
        );

        $this->validatorSchema['numero'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 6, 'required' => true)),
            new sfValidatorNombres(array('caracteres_no_validos' => 'caracteres_no_validos_numero', 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => true), array('required' => 'No has incluido un Nº.',
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

        $this->validatorSchema['codigopostal'] = new sfValidatorRegex(array(
            'pattern' => '#^(\d{5})$#',
            'required' => false,
                ), array('invalid' => 'Ese C.P. no es válido')
        );

        $this->validatorSchema['telefono'] = new sfValidatorRegex(array(
            'pattern' => '#^(\d{9})$#',
            'required' => false
                ), array('invalid' => 'Ese teléfono no es válido')
        );

        $this->validatorSchema['numero']->setOption('required', true);
        $this->validatorSchema['numero']->setMessage('required', 'No has incluido un Nº.');

        $this->validatorSchema['states_id']->setOption('required', true);
        $this->validatorSchema['states_id']->setMessage('required', 'No has seleccionado una provincia.');

        $this->validatorSchema['localidad_id']->setOption('required', true);
        $this->validatorSchema['localidad_id']->setMessage('required', 'No has seleccionado una localidad.');

        $this->validatorSchema['empresa_sector_uno_id']->setOption('required', true);
        $this->validatorSchema['empresa_sector_uno_id']->setMessage('required', 'No has seleccionado un sector.');

        $this->validatorSchema['empresa_sector_dos_id']->setOption('required', true);
        $this->validatorSchema['empresa_sector_dos_id']->setMessage('required', 'No has seleccionado un subsector.');
        $this->validatorSchema['empresa_sector_tres_id']->setOption('required', false);
        $this->validatorSchema['empresa_sector_tres_id']->setMessage('required', 'No has seleccionado una actividad.');

        $this->validatorSchema['lista_cuestionario_id']->setMessage('required', 'Si la empresa/entidad está en la lista blanca necesitas asociarle un cuestionario.');
        $this->validatorSchema['dividendo']->setMessage('min', 'Para publicar una empresa/entidad en la lista blanca necesitas incluir los puntos totales.');
        $this->validatorSchema['dividendo']->setMessage('required', 'Para publicar una empresa/entidad en la lista blanca necesitas incluir los puntos totales.');
        $this->validatorSchema['dividendo']->setMessage('invalid', 'Ese número no es válido.');
        $this->validatorSchema['divisor']->setMessage('min', 'Para publicar una empresa/entidad en la lista blanca necesitas incluir las auditorías realizadas.');
        $this->validatorSchema['divisor']->setMessage('required', 'Para publicar una empresa/entidad en la lista blanca necesitas incluir las auditorías realizadas.');
        $this->validatorSchema['divisor']->setMessage('invalid', 'Ese número no es válido.');
        $this->validatorSchema['persona_contacto'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'min_length' => 2, 'required' => false), array('invalid' => __('Esa persona de contacto no es válida.'))),
            new sfValidatorNombres(array('caracteres_no_validos' => 'caracteres_no_validos_nombre', 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('invalid' => __('Esa persona de contacto no es válida.')));


        $this->validatorSchema['googleMap']['address']->setMessage('required', 'Para publicar una empresa/entidad en la lista blanca necesitas asociarle una ubicación.');
        $this->validatorSchema['comentario_inicial']->setMessage('required', 'Para publicar una empresa/entidad en la lista blanca necesitas asociarle un comentario inicial.');
        $this->validatorSchema['texto_lista_negra'] = new sfValidatorString(
                array('required' => false), array('required' => 'Necesitas incluir las razones por las que la empresa/entidad está en la lista negra.'));

        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'featuredCallback'))));
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

        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkCP')))
        );
        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkDestacados')))
        );
        $this->mergePostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'Empresa', 'primary_key' => 'id', 'column' => array("name", "localidad_id", "road_type_id", "direccion", "numero")), array('invalid' => 'Ya existe un profesional con esas características. Por favor revísalo.'))
        );


        $this->widgetSchema->setLabels(array(
            'name' => __('Nombre Empresa o entidad'),
            'road_type_id' => __('Tipo de vía'),
            'direccion' => __('Dirección'),
            'numero' => __('Nº'),
            'codigopostal' => __('C.P.'),
            'empresa_sector_uno_id' => __('Sector'),
            'empresa_sector_dos_id' => __('Subsector'),
            'empresa_sector_tres_id' => __('Actividad'),
            'states_id' => __('Provincia'),
            'divisor' => __('Número auditorias realizadas'),
            'dividendo' => __('Puntos iniciales'),
            'lista_cuestionario_id' => __('Cuestionario asociado'),
            'valida' => __('Validación'),
            'texto_lista_negra' => __('Lista negra: por qué aparece aquí'),
            'persona_contacto' => __('Persona de contacto'),
            'telefono' => __('Teléfono'),
            'email' => __('Correo electrónico'),
            'googleMap' => __('Ubicación asociada'),
            'concurso_id' => __('Concurso asociado')
        ));

        $this->widgetSchema['codigopostal']->setAttributes(array('class' => 'tamano_5_c_1', 'maxlength' => 5));
        $this->widgetSchema['persona_contacto']->setAttributes(array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->widgetSchema['email']->setAttributes(array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->widgetSchema['dividendo']->setAttributes(array('class' => 'tamano_9_c_1', 'maxlength' => 10));
        $this->widgetSchema['divisor']->setAttributes(array('class' => 'tamano_9_c_1', 'maxlength' => 10));

        $this->widgetSchema->setPositions(array('gmap_check', 'name', 'valida', 'road_type_id', 'direccion', 'numero', 'piso', 'puerta',
            'states_id', 'localidad_id', 'codigopostal', 'persona_contacto', 'email', 'telefono',
            'empresa_sector_uno_id', 'empresa_sector_dos_id', 'empresa_sector_tres_id', 'lista', 'dividendo', 'divisor',
            'lista_cuestionario_id', 'comentario_inicial', 'texto_lista_negra', 'concurso_id', 'id', 'googleMap', 'featured', 'featured_order'
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->validatorSchema->setOption('filter_extra_fields', false);
    }

    public function checkProvincia($validator, $values) {
        if ($values['states_id'] == 1) {
            $this->validatorSchema['localidad_id']->setOption('required', false);
            $this->validatorSchema['road_type_id']->setOption('required', false);
            $this->validatorSchema['direccion']->setOption('required', false);
            $this->validatorSchema['numero']->setOption('required', false);
            $this->validatorSchema['googleMap']['address']->setOption('required', false);
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
        if (($values['lista'] == 'lb' || $values['lista'] == 'ln') && $values['states_id'] != 1) {
            if ($values['googleMap']['address'] == '' || $ma_empresa['gmap_check'] == 'false') {
                $errorSchema->addError(new sfValidatorError($validator, 'Para publicar una empresa/entidad en una lista necesitas asociarle una ubicación.'), 'googleMap');
            }
        }

        //si está en lista negra no puede tener un cuestionario

        if ($values['lista'] == 'ln' && !empty($values['lista_cuestionario_id'])) {
            $error = new sfValidatorError($validator, 'Si la empresa está en lista negra no puede tener un cuestionario asociado.');
            $errorSchema->addError($error, 'lista_cuestionario_id');
        }

        if (count($errorSchema)) {
            throw $errorSchema;
        }

        return $values;
    }

    public function checkCP($validator, $values) {
        if ((isset($values['states_id'])) and ($values['codigopostal'] != '')) {
            $name = Doctrine::getTable('States')->findOneById($values['states_id'])->getName();
            if (false == cp::checkCpByStateName($values['codigopostal'], $name)) {
                $invalid = new sfValidatorError($validator, 'Ese C.P. no es válido.');
                throw new sfValidatorErrorSchema($validator, array('codigopostal' => $invalid));
            }
        }

        return $values;
    }

    public function checkDestacados($validator, $values) {
        $newValues = $this->getTaintedValues();
        $defaultValues = $this->getDefaults();
        $empresa = $this->getObject();
        if (isset($newValues['localidad_id']) && ($newValues['localidad_id'] != $defaultValues['localidad_id'])) {
            //check if destacado...
            if ($empresa->isDestacadaPorLocalidad() || $empresa->isDestacadaPorSectorLocalidad()) {
                $invalid = new sfValidatorError($validator, 'Para editar la provincia o localidad de esta empresa/entidad, necesitas antes quitarla como destacada.');
                throw new sfValidatorErrorSchema($validator, array($invalid));
            }
        }

        if (isset($newValues['states_id']) && ($newValues['states_id'] != $defaultValues['states_id'])) {
            if ($empresa->isDestacadaPorProvincia() || $empresa->isDestacadaPorSectorProvincia()) {
                $invalid = new sfValidatorError($validator, 'Para editar la provincia de esta empresa/entidad, necesitas antes quitarla como destacada.');
                throw new sfValidatorErrorSchema($validator, array($invalid));
            }
        }

        if (isset($newValues['empresa_sector_dos_id']) && isset($newValues['empresa_sector_tres_id'])) {
            if (($newValues['empresa_sector_dos_id'] != $defaultValues['empresa_sector_dos_id']) || (isset($newValues['empresa_sector_tres_id']) && isset($defaultValues['empresa_sector_tres_id']) && $newValues['empresa_sector_tres_id'] != $defaultValues['empresa_sector_tres_id'])) {
                if ($empresa->isDestacadaPorSector() || $empresa->isDestacadaPorSectorProvincia() || $empresa->isDestacadaPorSectorLocalidad()) {
                    $invalid = new sfValidatorError($validator, 'Para editar el subsector o la actividad de esta empresa/entidad, necesitas antes quitarla como destacada.');
                    throw new sfValidatorErrorSchema($validator, array($invalid));
                }
            }
        }


        if (isset($newValues['lista']) && ($newValues['lista'] != $defaultValues['lista'])) {
            if ($empresa->isDestacada() != '') {
                $invalid = new sfValidatorError($validator, 'Para pasar esta empresa/entidad a la lista negra necesitas primero quitarla como destacada.');
                throw new sfValidatorErrorSchema($validator, array($invalid));
            }
        }


        return $values;
    }

    protected function doSave($con = null) {
        parent::doSave($con);
//        //as embed form don't call doSave method, I put the doSave code here for the google maps widget :(
        $gMapForm = $this->getEmbeddedForm('googleMap');
        $gMapForm->getObject()->setEmpresa($this->getObject());
        $gMapForm->getObject()->save();
        if ($this->getObject()->isNew()) {

            if ($this->getValue('concurso') != '') {
                $concurso = Doctrine::getTable('concurso')->find($this->getValue('concurso'));
                $concurso->setEmpresa($this->getObject());
                $concurso->save();
            }
        }
    }

    /**
     *
     * @param type $validator
     * @param type $values
     * @return type
     */
    public function featuredCallback($validator, $values) {
        if (!empty($values['featured']) && !empty($values['lista'])) {
            //get featured limit
            $featured_limit = Doctrine::getTable('Empresa')->getFeatreudLimit($values['lista']);

            //if featured limit is more then 10 then show error message
            if ($featured_limit[0]['contest_limit'] >= 10) {
                $invalid = new sfValidatorError($validator, 'No puedes destacar más de 10 empresas o entidades de la Lista blanca en la Home.');
                throw new sfValidatorErrorSchema($validator, array('featured' => $invalid));
            }
        }
        return $values;
    }

}
