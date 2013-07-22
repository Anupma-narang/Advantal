<?php

/**
 * UserProductCaseStudy form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserProductCaseStudyForm extends BaseUserProductCaseStudyForm {

    public function configure() {        
        sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));

        unset($this["created_at"], $this["updated_at"]);
        $status_array = array('1' => 'Revista ', '2' => 'Tramitado', '3' => 'Cerrado');

        $product_names_array = Doctrine::getTable('Producto')->getAllProductNames();
        $product_marca_array = Doctrine::getTable('Producto')->getMarcaRecords();
        $product_modelo_array = Doctrine::getTable('Producto')->getModeloRecords();

        //set widgets
        $this->widgetSchema['name'] = new audWidgetFormJQueryAutocompleterInField(array('url' => url_for('@empresa_autocomplete_name')), array('maxlength' => 70, 'class' => 'tamano_32_c'));

        //new sfWidgetFormChoice(array('choices' => $product_names_array));
        $this->widgetSchema['description'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'max_length' => 43000, 'err_id' => 'error_max_length'));
        $this->widgetSchema['summary'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'max_length' => 1000, 'err_id' => 'error_max_length_summary'));
        $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => $status_array));
        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'ProductoTipoUno',
                    'order_by' => array('orden', 'asc'),
                    'add_empty' => 'Selecciona sector'));


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

        $this->widgetSchema['file1'] = new sfWidgetFormInputFileEditable(array('file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getFile1(),
                    'is_image' => false,
                    'edit_mode' => true,
                    'label' => 'Archivo',
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

        $this->widgetSchema['marca'] = new sfWidgetFormInputText(array(), array("class" => "tamano_32_c", "maxlength" => 70));
        $this->widgetSchema['modelo'] = new sfWidgetFormInputText(array(), array("class" => "tamano_20_c", "maxlength" => 20));



        //set validation
        $this->validatorSchema['marca']->setOption('required', true);
        $this->validatorSchema['producto_tipo_uno_id']->setOption('required', true);
        $this->validatorSchema['producto_tipo_dos_id']->setOption('required', true);
        $this->validatorSchema['producto_tipo_tres_id']->setOption('required', false);
        $this->validatorSchema['status'] = new sfValidatorChoice(array('choices' => array(1, 2, 3), 'required' => false));
        $this->validatorSchema['name'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 70, 'min_length' => 2, 'required' => true), array('required' => __('No has incluido un producto.'), 'invalid' => __('Ese producto no es válido.'))),
                    new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ), array(), array('required' => __('No has incluido un producto.'), 'invalid' => __('Ese producto no es válido.')));

        $this->validatorSchema['marca'] = new sfValidatorString(array('required' => true, 'max_length' => 70), array('required' => __('No has incluido una marca.')));
        $this->validatorSchema['modelo'] = new sfValidatorString(array('required' => false, 'max_length' => 20));

        $this->validatorSchema['description'] = new sfValidatorString(array('required' => true), array('invalid' => __('Ese caso de éxito no es válido.'), 'required' => __('No has incluido una descripción del caso de éxito.')));
        $this->validatorSchema['summary'] = new sfValidatorString(array('required' => true), array('invalid' => __('Ese resumen de tu caso de éxito no es válido.'), 'required' => __('No has incluido un resumen del caso de éxito.')));

        $this->validatorSchema['producto_tipo_uno_id']->setMessage('required', 'No has seleccionado un sector del producto.');
        $this->validatorSchema['producto_tipo_dos_id']->setMessage('required', 'No has seleccionado un subsector del producto.');
        $this->validatorSchema['producto_tipo_tres_id']->setMessage('required', 'No has seleccionado un tipo de producto.');
        $this->validatorSchema['file1'] = new sfValidatorFile(array('required' => false, 'mime_type_guessers' => array(array('fakemime', 'detect')), 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
        $this->validatorSchema['file2'] = new sfValidatorFile(array('required' => false, 'mime_type_guessers' => array(array('fakemime', 'detect')), 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
        $this->validatorSchema['file3'] = new sfValidatorFile(array('required' => false, 'mime_type_guessers' => array(array('fakemime', 'detect')), 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
        $this->validatorSchema['file4'] = new sfValidatorFile(array('required' => false, 'mime_type_guessers' => array(array('fakemime', 'detect')), 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
        $this->validatorSchema['logo'] = new sfValidatorFile(array('required' => false, 'mime_type_guessers' => array(array('fakemime', 'detect')), 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));

        //user_id
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        //$this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User')));
        $this->validatorSchema['user_id']->setOption('required', false);
        //username
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array("default" => (!$this->isNew() ? $this->getObject()->getUser()->getUsername() : "")), array('id' => 'user_product_case_study_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        
        $this->validatorSchema['user_name']->setOption('required', false);

        $this->widgetSchema->setLabels(array(
            'name' => 'Producto',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'producto_tipo_uno_id' => 'Sector del producto',
            'producto_tipo_dos_id' => 'Subsector del producto',
            'producto_tipo_tres_id' => 'Tipo de producto',
        ));

        unset($this['file2'], $this['file3'], $this['file4']);

        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkActividad')))
        );

        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkUserNameValide')))
        );

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