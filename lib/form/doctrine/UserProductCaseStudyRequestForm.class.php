<?php

/**
 * UserProductCaseStudyRequest form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));

class UserProductCaseStudyRequestForm extends BaseUserProductCaseStudyRequestForm {

    public function configure() {
        //set status array
        $status_array = array('1' => 'Revista ', '2' => 'Tramitado', '3' => 'Cerrado');

        $caracteres_no_validos_name = array(
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '@', '#', '+', '|', '£', '¥', '§', '©', '®', '±', '²', '³', 'µ', '¶',
            '¼', '½', '¾', 'Ø', 'Γ', 'Δ', 'Θ', 'Λ', 'Π', 'Σ', 'Φ', 'Ψ', 'Ω', 'ά', 'έ', 'ή', 'ί', 'ΰ', 'α', 'β', 'γ', 'δ', 'ε', 'ζ',
            'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'ς', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω', 'ϊ', 'ϋ', 'ύ', 'ώ', 'Б',
            'Г', 'Д', 'Ж', 'И', 'Й', 'Л', 'П', 'Ф', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'д', 'ж', 'и', 'й', 'л', 'п',
            'ф', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'э', 'ю', 'я', 'ђ', 'ѓ', 'є', 'љ', 'њ', 'ћ', 'ќ', 'ѝ', 'ў', 'џ', 'Ѣ', 'ѣ', 'Ѳ', 'ѳ',
            'Ѵ', 'ѵ', 'Ґ', 'ґ', 'Ẁ', 'ẁ', 'Ẃ', 'ẃ', 'Ẅ', '‰', '•', '‡', '†', '‹', '›', '‽', '℅', 'ℓ', '№', '℮', '⅓', '⅔', '⅕', '⅖',
            '⅗', '⅘', '⅙', '⅚', '⅛', '⅜', '⅝', '⅞', '⅟', '←', '↑', '→', '↓', '↔', '↕', '↖', '↗', '↘', '↙', '∂', '∆', '∏', '∑', '−',
            '√', '∞', '∫', '≈', '≠', '≤', '≥', '◊', '/', '\\', '^', '$', '€', '¿?', '?', '.', ',', '¡', '!', '%', '&', '(', ')', '=',
            '*', '[', ']', '{', '}', ';', ':', '_', 'ª', 'º', '"', '>', '<', '¬', '·', '¿');

        //fetch username array
        $username_array = Doctrine::getTable('sfGuardUser')->getUsernames();

        $usuario = $this->getOption('usuario');
        $usuari = false;
        if (isset($usuario))
            if ($usuario->isAuthenticated())
                $usuari = true;

        //$this->widgetSchema['user_name'] = new sfWidgetFormInputText(array('default' => ($usuari) ? $usuario : ''), array('maxlength' => 25, 'style' => 'width:176px;'));
        $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => $status_array));
        $this->widgetSchema['name'] = new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['marca'] = new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['modelo'] = new sfWidgetFormInput(array(), array('maxlength' => 20, 'class' => 'tamano_20_c'));
        $this->widgetSchema['description'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'error_max_length', 'max_length' => 43000));
        $this->widgetSchema['homepage'] = new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['summary'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'error_max_length_summary', 'max_length' => 12300));
        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoUno',
                    'add_empty' => 'Selecciona sector',
                    'order_by' => array('orden', 'asc')), array('style' => 'width:265px'));

        $this->widgetSchema['producto_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoDos',
                    'depends' => 'ProductoTipoUno',
                    'ajax' => true,
                    'add_empty' => 'Selecciona subsector'), array('style' => 'width:265px'));

        $this->widgetSchema['producto_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'ProductoTipoTres',
                    'depends' => 'ProductoTipoDos',
                    'ajax' => true,
                    'add_empty' => 'Selecciona tipo de producto'), array('style' => 'width:265px'));

        /*     $this->widgetSchema['file1'] = new sfWidgetFormInputFileEditable(array('file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getFile1(),
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
                            //'mime_types' => functions::$mime_types,
                            //'mime_type_guessers' => array()
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

// @author Joan Teixidó Yo esto no lo pondría aquí pero alguien lo metió aquí o sea que aquí se queda.
        $choices = array(0 => 'Pendiente de revisar', 1 => 'Revisada');
        $this->validatorSchema['status'] = new sfValidatorChoice(array('choices' => array(1, 2, 3), 'required' => false));
        $this->validatorSchema['marca']->setOption('required', true);
        /*   $this->setValidator('name', new sfValidatorAnd(array(
          new sfValidatorString(array(
          'required' => true,
          'trim' => false,
          'min_length' => 2,
          'max_length' => 70
          )
          , array('required' => __('No has incluido un producto.'), array('invalid' => __('Ese producto no es válido.')))),
          new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_name, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
          ), array(), array('required' => __('No has incluido un producto.'), array('invalid' => __('Ese producto no es válido.')))));
         */

        $this->validatorSchema['name'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('trim' => false, 'max_length' => 70, 'min_length' => 2, 'required' => true), array('required' => __('Necesitas incluir un producto.'), 'invalid' => __('Ese producto no es válido.'))),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_name, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array(), array('required' => __('Necesitas incluir un producto.'), 'invalid' => __('Ese producto no es válido.')));

        //$this->validatorSchema['user_name'] = new sfValidatorChoice(array('choices' => $username_array, 'required' => true), array('required' => 'Necesitas incluir un Usuario.'));

        $this->validatorSchema['homepage'] = new sfValidatorRegex(array('pattern' => "/\b(?:(?:https?|ftpppppxpxpxpxp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", 'required' => false), array('invalid' => __('Esa página web no es correcta.')));

        /*   $this->setValidator('name', new sfValidatorAnd(array(
          new sfValidatorString(
          array('required' => true, 'trim' => false, 'min_length' => 1, 'max_length' => 70), array('required' => __('No has incluido un producto.'), 'min_length' => __('La empresa o entidad debe tener entre 1 y 70 caracteres, con espacios en blanco.'), 'max_length' => __('La empresa o entidad debe tener entre 1 y 70 caracteres, con espacios en blanco.'))
          ),
          new sfValidatorNombres(array('caracteres_no_validos' => 'caracteres_no_validos_empresa'), array('invalid' => __('Ese producto no es válido.')))
          ), array(), array('required' => __('No has incluido un producto.'))));
         */
        $this->validatorSchema['marca'] = new sfValidatorAnd(array(
                    new sfValidatorString(array(
                        'required' => true,
                        'trim' => false,
                        'min_length' => 1,
                        'max_length' => 70
                            ), array('required' => __('Necesitas incluir una marca.'))
                    ),
                    new sfValidatorNombres(array(
                        'caracteres_no_validos' => 'caracteres_no_validos_producto'
                            ), array('invalid' => __('Esa marca no es válida.'))
                    )
                        ), array(), array('required' => __('Necesitas incluir una marca.'),
                    'invalid' => __('Esa marca no es válida.')
                        )
        );
        $this->validatorSchema['description'] = new sfValidatorString(array('required' => true), array(
                    'required' => (sfConfig::get("sf_app") == "frontend") ? 'Necesitas incluir tu
caso de éxito.' : 'No has incluido una descripción del caso de éxito.',
                    'invalid' => __('Has superado el espacio permitido para la descripción del caso de éxito.'))
        );
        $this->validatorSchema['summary'] = new sfValidatorString(array('required' => true), array(
                    'required' => (sfConfig::get("sf_app") == "frontend") ? 'Necesitas incluir el
resumen de tu caso de éxito.' : 'No has incluido un resumen del caso de éxito.',
                    'invalid' => __('Has superado el espacio permitido para el resumen del caso de éxito.'))
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


        $this->validatorSchema['producto_tipo_uno_id']->setOption('required', true);
        $this->validatorSchema['producto_tipo_dos_id']->setOption('required', true);
        $this->validatorSchema['producto_tipo_uno_id']->setMessage('required', 'Necesitas seleccionar un sector.');
        $this->validatorSchema['producto_tipo_dos_id']->setMessage('required', 'Necesitas seleccionar un subsector.');
        $this->validatorSchema['producto_tipo_tres_id']->setMessage('required', 'Necesitas seleccionar un tipo de producto.');
        /* $this->mergePostValidator(
          new sfValidatorCallback(array('callback' => array($this, 'checkLista')))
          ); */

        //username
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        //$this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User')));
        $this->validatorSchema['user_id']->setOption('required', false);
        //username
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array("default" => (!$this->isNew() ? $this->getObject()->getUser()->getUsername() : "")), array('id' => 'user_product_case_study_request_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->validatorSchema['user_name']->setOption('required', false);


        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkActividad')))
        );
        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkUserNameValide')))
        );
        /*    $this->mergePostValidator(
          new sfValidatorCallback(array('callback' => array($this, 'checkDestacados')))
          );
         */


        $this->widgetSchema->setLabels(array(
            'name' => 'Producto*',
            'marca' => 'Marca*',
            'modelo' => 'Modelo',
            'homepage' => 'Página web del fabricante',
            'user_name' => 'Tu Usuario/Alias',
            'file1' => 'Archivo 1',
            'file2' => 'Archivo 2',
            'file3' => 'Archivo 3',
            'file4' => 'Archivo 4',
            'logo' => 'Añadir logo',
        ));
        $this->widgetSchema->setNameFormat('user_product_case_study_request[%s]');

        if (sfConfig::get("sf_app") == "frontend") {
            $this->widgetSchema->setLabels(array(
                'producto_tipo_uno_id' => 'Sector del producto',
                'producto_tipo_dos_id' => 'Subsector del producto',
                'producto_tipo_tres_id' => 'Tipo de producto'
            ));
        }
        unset($this["created_at"], $this["updated_at"]);
        $this->validatorSchema['user_name']->setMessages(array('required' => __("Necesitas seleccionar un Usuario"), 'invalid' => __('Ese Usuario no es válido')));
        $this->validatorSchema['user_id']->setMessages(array('required' => __("Necesitas seleccionar un Usuario"), 'invalid' => __('Ese Usuario no es válido')));
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

}