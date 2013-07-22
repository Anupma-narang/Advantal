<?php

/**
 * Producto form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductoForm extends BaseProductoForm {

    public function configure() {
        sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));
        unset($this["created_at"], $this["updated_at"], $this['slug']);

        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProductoTipoUno',
            'add_empty' => 'Selecciona sector',
            'order_by' => array('orden', 'asc')));

        /*  $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineChoice(array(
          'model' => 'ProductoTipoUno',
          'order_by' => array('orden', 'asc'),
          'add_empty' => 'Selecciona sector'));
         */

        $this->widgetSchema['producto_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProductoTipoDos',
            'depends' => 'ProductoTipoUno',
            'ajax' => true,
            'add_empty' => 'Selecciona subsector'));

        $this->widgetSchema['producto_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProductoTipoTres',
            'depends' => 'ProductoTipoDos',
            'ajax' => true,
            'add_empty' => 'Selecciona tipo de producto'));

        $this->widgetSchema['lista'] = new sfWidgetFormChoice(array(
            'choices' => sfConfig::get('app_listas_tipos')
        ));
        if (sfContext::getInstance()->getRequest()->getParameter('module') == "productoListaBlanca" && (sfContext::getInstance()->getRequest()->getParameter('action') == "new" || sfContext::getInstance()->getRequest()->getParameter('action') == "create")) {
            $this->widgetSchema['lista']->setDefault('lb');
        } else if (sfContext::getInstance()->getRequest()->getParameter('module') == "listaNegraProducto" && (sfContext::getInstance()->getRequest()->getParameter('action') == "new" || sfContext::getInstance()->getRequest()->getParameter('action') == "create")) {
            $this->widgetSchema['lista']->setDefault('ln');
        }

        // @author Joan Teixidó Yo esto no lo pondría aquí pero alguien lo metió aquí o sea que aquí se queda.
        $choices = array(0 => 'Pendiente de revisar', 1 => 'Revisada');
        $this->widgetSchema['featured_order'] = new sfWidgetFormInputText(array(), array('maxlength' => 2, 'class' => 'tamano_2_c'));

        $this->widgetSchema['valida'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->validatorSchema['valida'] = new sfValidatorChoice(array('choices' => array_keys($choices)));
        $this->widgetSchema['telefono']->setAttribute('maxlength', 9);
        $this->widgetSchema["name"]->setAttribute('class', "anchotexto");
        $this->widgetSchema["marca"]->setAttribute('class', "anchotexto");
        $this->widgetSchema["modelo"]->setAttribute('class', "anchotexto");
        $this->widgetSchema['comentario_inicial'] = new sfWidgetFormTextareaCKEditor(array('width'=>600, 'height' => 200, 'err_id' => 'error_max_length', 'max_length' => 3000));
        $this->widgetSchema['texto_lista_negra'] = new sfWidgetFormTextareaCKEditor(array('width'=>600, 'height' => 200, 'err_id' => 'error_max_length', 'max_length' => 3000));
        $this->widgetSchema['concurso_id']->setOption('query', ConcursoTable::getConcursosCerradosQuery($this->getObject()));
        $this->widgetSchema['featured'] = new sfWidgetFormInputCheckbox();

        $this->widgetSchema['name'] = new audWidgetFormJQueryAutocompleterInField(array(
            'url' => url_for('@producto_autocomplete?field=name')
        ));
        $this->widgetSchema['marca'] = new audWidgetFormJQueryAutocompleterInField(array(
            'url' => url_for('@producto_autocomplete?field=marca')
        ));
        $this->widgetSchema['modelo'] = new audWidgetFormJQueryAutocompleterInField(array(
            'url' => url_for('@producto_autocomplete?field=modelo')
        ));

        $this->widgetSchema['lista_cuestionario_id'] = new sfWidgetFormDoctrineChoiceEdit(array(
            'label' => 'Cuestionario asociado',
            'model' => $this->getRelatedModelName('Cuestionario'),
            'add_empty' => 'Selecciona un cuestionario',
            'url' => '@cuestionario_producto_edit',
            'table_method' => 'getCuestionariosForProducto'
        ));

        $this->validatorSchema['lista'] = new sfValidatorChoice(array(
            'choices' => array_keys(sfConfig::get('app_listas_tipos'))
        ));

        $this->validatorSchema['marca']->setOption('required', true);
        $this->validatorSchema['producto_tipo_uno_id']->setOption('required', true);
        $this->validatorSchema['producto_tipo_dos_id']->setOption('required', true);
        //     $this->validatorSchema['producto_tipo_tres_id']->setOption('required', true);
        $this->validatorSchema['featured'] = new sfValidatorBoolean(array('required' => false));
        $this->validatorSchema['featured_order'] = new sfValidatorInteger(array('required' => false));
        $this->validatorSchema['texto_lista_negra'] = new sfValidatorString(array('required' => false), array(
            'required' => 'Necesitas incluir las razones por las que el producto está en la lista negra.'
        ));

        $this->setValidator('name', new sfValidatorAnd(array(
            new sfValidatorString(array(
                'required' => true,
                'trim' => false,
                'min_length' => 1,
                'max_length' => 70
                    ), array('required' => __('No has incluido un producto.'))),
            new sfValidatorNombres(array('caracteres_no_validos' => 'caracteres_no_validos_nombre', 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')), array('invalid' => __('Ese producto no es válido.')))
                ), array(), array('required' => __('No has incluido un producto.')))
        );




        $this->validatorSchema['marca'] = new sfValidatorAnd(array(
            new sfValidatorString(array(
                'required' => true,
                'trim' => false,
                'min_length' => 1,
                'max_length' => 70
                    ), array('required' => __('No has incluido una marca.'))
            ),
            new sfValidatorNombres(array(
                'caracteres_no_validos' => 'caracteres_no_validos_producto'
                    ), array('invalid' => __('Esa marca no es válida.'))
            )
                ), array(), array('required' => __('No has incluido una marca.'),
            'invalid' => __('Esa marca no es válida.')
                )
        );

        $this->validatorSchema['modelo'] = new sfValidatorAnd(array(
            new sfValidatorString(array(
                'required' => false,
                'trim' => false,
                'min_length' => 1,
                'max_length' => 70
                    )
            ),
            new sfValidatorNombres(array(
                'caracteres_no_validos' => 'caracteres_no_validos_producto'
                    ), array('invalid' => __('Ese modelo no es válido.'))
            )
                ), array('required' => false), array('required' => __('No has incluido un modelo.'),
            'invalid' => __('Ese modelo no es válido.'))
        );

        $this->validatorSchema['producto_tipo_uno_id']->setMessage('required', 'No has seleccionado un sector.');
        $this->validatorSchema['producto_tipo_dos_id']->setMessage('required', 'No has seleccionado un subsector.');
        $this->validatorSchema['producto_tipo_tres_id']->setMessage('required', 'No has seleccionado un tipo de producto.');
        $this->validatorSchema['lista_cuestionario_id']->setMessage('required', 'Para publicar un producto en la lista blanca has de seleccionar un cuestionario.');
        $this->validatorSchema['dividendo']->setMessage('min', 'Para publicar un producto en la lista blanca necesitas incluir los puntos totales.');
        $this->validatorSchema['dividendo']->setMessage('required', 'Para publicar un producto en la lista blanca necesitas incluir los puntos totales.');
        $this->validatorSchema['dividendo']->setMessage('invalid', 'Ese número no es válido.');
        $this->validatorSchema['divisor']->setMessage('required', 'Para publicar un producto en la lista blanca necesitas incluir las auditorías realizadas.');
        $this->validatorSchema['divisor']->setMessage('min', 'Para publicar un producto en la lista blanca necesitas incluir las auditorías realizadas.');
        $this->validatorSchema['divisor']->setMessage('invalid', 'Ese número no es válido.');
        $this->validatorSchema['comentario_inicial'] = new sfValidatorString(
                array('required' => false), array('required' => 'Para publicar un producto en la lista blanca has de incluir un comentario inicial.')
        );

        $this->validatorSchema['persona_contacto'] = new sfValidatorAnd(array(
            new sfValidatorString(array('max_length' => 70, 'min_length' => 2, 'required' => false), array('invalid' => __('Esa persona de contacto no es válida.'))),
            new sfValidatorNombres(array('required' => false, 'caracteres_no_validos' => 'caracteres_no_validos_nombre', 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                ), array('required' => false), array('invalid' => __('Esa persona de contacto no es válida.')));

        $this->validatorSchema['telefono'] = new sfValidatorRegex(array(
            'pattern' => '#^(\d{9})$#',
            'required' => false
                ), array('invalid' => 'Ese teléfono no es válido')
        );
        $this->validatorSchema['email'] = new sfValidatorEmail(array(
            'required' => false,
            'trim' => true
                ), array(
            'invalid' => 'Ese correo electrónico no es válido'
        ));

        //$this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'featuredCallback'))));

        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkLista')))
        );

        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkActividad')))
        );
        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkDestacados')))
        );

        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'featuredCallback')))
        );
        
        $this->mergePostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'Producto', 'primary_key' => 'id', 'column' => array("name", "marca", "modelo")), array('invalid' => 'Ya existe un profesional con esas características. Por favor revísalo.'))
        );

        $this->widgetSchema->setPositions(array(
            'name', 'marca', 'modelo', 'valida', 'persona_contacto', 'email', 'telefono', 'producto_tipo_uno_id', 'producto_tipo_dos_id', 'producto_tipo_tres_id',
            'lista', 'dividendo', 'divisor', 'lista_cuestionario_id', 'comentario_inicial', 'texto_lista_negra',
            'concurso_id', 'id', 'featured', 'featured_order'
        ));

        $this->widgetSchema->setLabels(array(
            'name' => 'Producto',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'producto_tipo_uno_id' => 'Selecciona sector',
            'producto_tipo_dos_id' => 'Selecciona subsector',
            'producto_tipo_tres_id' => 'Tipo de producto',
            'dividendo' => 'Puntos totales',
            'divisor' => 'Auditorías realizadas',
            'texto_lista_negra' => '<strong>Lista negra: por qué aparece aquí</strong>',
            'email' => 'Correo electrónico',
            'persona_contacto' => 'Persona de contacto',
            'telefono' => 'Teléfono',
            'valida' => 'Validación',
            'concurso_id' => 'Concurso asociado'
        ));

        $this->widgetSchema['name']->setAttributes(array('maxlength' => 70, 'style' => 'width:225px;'));
        $this->widgetSchema['marca']->setAttributes(array('maxlength' => 70, 'style' => 'width:225px;'));
        $this->widgetSchema['persona_contacto']->setAttributes(array('maxlength' => 70, 'style' => 'width:225px;'));
        $this->widgetSchema['email']->setAttributes(array('maxlength' => 70, 'style' => 'width:225px;'));
        $this->widgetSchema['modelo']->setAttributes(array('maxlength' => 20, 'style' => 'width:141px;'));
        $this->widgetSchema['telefono']->setAttributes(array('maxlength' => 9, 'style' => 'width:64px;'));
        $this->widgetSchema['dividendo']->setAttributes(array('maxlength' => 10, 'style' => 'width:71px;'));
        $this->widgetSchema['divisor']->setAttributes(array('maxlength' => 10, 'style' => 'width:71px;'));
    }

    public function checkActividad($validator, $values) {
        $errorSchema = new sfValidatorErrorSchema($validator);
        if (!empty($values['producto_tipo_tres_id'])) {
            return $values;
        }
        if (empty($values['producto_tipo_dos_id'])) {
            $this->validatorSchema['producto_tipo_tres_id']->setOption('required', true);
            try {
                $this->validatorSchema['producto_tipo_tres_id']->clean($values['producto_tipo_tres_id']);
            } catch (sfValidatorErrorSchema $e) {
                $errorSchema->addErrors($e);
            } catch (sfValidatorError $e) {
                $errorSchema->addError($e, 'producto_tipo_tres_id');
            }
        }
        if (count($errorSchema)) {
            throw $errorSchema;
        }

        if (ProductoTipoDosTable::hasActividad($values['producto_tipo_dos_id'])) {
            $this->validatorSchema['producto_tipo_tres_id']->setOption('required', true);
            try {
                $this->validatorSchema['producto_tipo_tres_id']->clean($values['producto_tipo_tres_id']);
            } catch (sfValidatorErrorSchema $e) {
                $errorSchema->addErrors($e);
            } catch (sfValidatorError $e) {
                $errorSchema->addError($e, 'producto_tipo_tres_id');
            }
        }

        if (count($errorSchema)) {
            throw $errorSchema;
        }
        return $values;
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


        if ($values['lista'] == 'ln' && !empty($values['lista_cuestionario_id'])) {
            $error = new sfValidatorError($validator, 'Si el producto está en la lista negra no puede tener un cuestionario asociado');
            $errorSchema->addError($error, 'lista_cuestionario_id');
        }

        if (count($errorSchema)) {
            throw $errorSchema;
        }
        return $values;
    }

    public function checkDestacados($validator, $values) {
        $newValues = $this->getTaintedValues();
        $defaultValues = $this->getDefaults();
        $producto = $this->getObject();
        if ($newValues['name'] != $defaultValues['name']) {
            if ($producto->isDestacadoPorProducto()) {
                $invalid = new sfValidatorError($validator, 'Para editar el nombre de este producto, necesitas antes quitarlo como destacado.');
                throw new sfValidatorErrorSchema($validator, array($invalid));
            }
        }

        if ($newValues['marca'] != $defaultValues['marca']) {
            if ($producto->isDestacadoPorMarca() || $producto->isDestacadoPorMarcaAndTipo()) {
                $invalid = new sfValidatorError($validator, 'Para editar la marca de este producto, necesitas antes quitarlo como destacado.');
                throw new sfValidatorErrorSchema($validator, array($invalid));
            }
        }
        if (($newValues['producto_tipo_dos_id'] != $defaultValues['producto_tipo_dos_id']) || (isset($newValues['producto_tipo_tres_id']) && ($newValues['producto_tipo_tres_id'] != $defaultValues['producto_tipo_tres_id']))) {
            if ($producto->isDestacadoPorTipo() || $producto->isDestacadoPorMarcaAndTipo()) {
                $invalid = new sfValidatorError($validator, 'Para editar el tipo de este producto, necesitas antes quitarlo como destacado.');
                throw new sfValidatorErrorSchema($validator, array($invalid));
            }
        }

        if (($newValues['producto_tipo_dos_id'] != $defaultValues['producto_tipo_dos_id']) || (isset($newValues['producto_tipo_tres_id']) && ($newValues['producto_tipo_tres_id'] != $defaultValues['producto_tipo_tres_id']))) {
            if ($producto->isDestacadoPorTipo() || $producto->isDestacadoPorMarcaAndTipo()) {
                $invalid = new sfValidatorError($validator, 'Para editar el tipo de este producto, necesitas antes quitarlo como destacado.');
                throw new sfValidatorErrorSchema($validator, array($invalid));
            }
        }

        if ($newValues['lista'] != $defaultValues['lista']) {
            if ($producto->isDestacado() != '') {
                $invalid = new sfValidatorError($validator, 'Para pasar este producto a la lista negra necesitas primero quitarlo como destacado.');
                throw new sfValidatorErrorSchema($validator, array($invalid));
            }
        }

        return $values;
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
            $featured_limit = Doctrine::getTable('Producto')->getFeatreudLimit($values['lista']);

            //if featured limit is more then 10 then show error message
            if ($featured_limit[0]['product_limit'] >= 10) {
                $invalid = new sfValidatorError($validator, 'No puedes destacar más de 10 productos de la Lista blanca en la Home.');
                throw new sfValidatorErrorSchema($validator, array('featured' => $invalid));
            }
        }
        return $values;
    }

}