<?php

/**
 * ProductCaseStudy form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductCaseStudyForm extends BaseProductCaseStudyForm {

    public function configure() {
        sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));

        unset($this["created_at"], $this["updated_at"]);
        //set status array
        $status_array = array('1' => 'Revista ',
            '2' => 'Tramitado',
            '3' => 'Cerrado');
        //get product names
        $product_names_array = Doctrine::getTable('Producto')->getAllProductNames();
        //get marca records
        $product_marca_array = Doctrine::getTable('Producto')->getMarcaRecords();
        //get modelo records
        $product_modelo_array = Doctrine::getTable('Producto')->getModeloRecords();

        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->widgetSchema['description'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'error_max_length', 'max_length' => 43000));
        $this->widgetSchema['summary'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'error_max_length_summary', 'max_length' => 1000));
        $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => $status_array, 'label' => 'Estado'));
        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
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

        $this->widgetSchema['file1'] = new pkWidgetFormInputFilePersistentCasestudy(array('file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getFile1(),
                    'is_image' => false,
                    'label' => 'Archivo 1',
                    'edit_mode' => true,
                    'template' => '<div><strong>' . $this->getObject()->getFile1() . '</strong></div>%input%'));
        $this->widgetSchema['file2'] = new pkWidgetFormInputFilePersistentCasestudy(array('file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getFile2(),
                    'label' => 'Archivo 2',
                    'is_image' => false,
                    'edit_mode' => true,
                    'template' => '<div><strong>' . $this->getObject()->getFile2() . '</strong></div>%input%'));
        $this->widgetSchema['file3'] = new pkWidgetFormInputFilePersistentCasestudy(array('file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getFile3(),
                    'label' => 'Archivo 3',
                    'is_image' => false,
                    'edit_mode' => true,
                    'template' => '<div><strong>' . $this->getObject()->getFile3() . '</strong></div>%input%'));
        $this->widgetSchema['file4'] = new pkWidgetFormInputFilePersistentCasestudy(array('file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getFile4(),
                    'label' => 'Archivo 4',
                    'is_image' => false,
                    'edit_mode' => true,
                    'template' => '<div><strong>' . $this->getObject()->getFile4() . '</strong></div>%input%'));

        $this->widgetSchema['logo'] = new pkWidgetFormInputFilePersistentlogo(array('file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getLogo(),
                    'is_image' => false,
                    'label' => 'Añadir logo',
                    'edit_mode' => true,
                    'template' => '<div><strong>' . $this->getObject()->getLogo() . '</strong></div>%input%'));
// @author Joan Teixidó Yo esto no lo pondría aquí pero alguien lo metió aquí o sea que aquí se queda.
        $choices = array(0 => 'Pendiente de revisar', 1 => 'Revisada');

        $this->widgetSchema['marca'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_32_c', 'maxlength' => 70));
        $this->widgetSchema['modelo'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_20_c', 'maxlength' => 20));

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

        //new sfValidatorString(array('required' => true, 'max_length' => 70), array('required' => __('No has incluido el nombre del producto.'), 'max_length' => __('Ese producto no es válido.')));
        $this->validatorSchema['marca'] = new sfValidatorString(array('required' => true, 'max_length' => 70), array('required' => __('No has incluido una marca.'), 'max_length' => __('Esa marca no es válida.')));
        $this->validatorSchema['modelo'] = new sfValidatorString(array('required' => false, 'max_length' => 20), array('required' => __('No has incluido un modelo.'), 'max_length' => __('Ese modelo no es válido.')));

        /* $this->validatorSchema['description'] = new sfValidatorString(array('required' => true, 'max_length' => 43000),
          array('invalid' => __('Ese caso de éxito no es válido.'),
          'required' => __('No has incluido una descripción del caso de éxito.'),
          'max_length' => __('Has superado el espacio permitido para la descripción del caso de éxito.')));
          $this->validatorSchema['summary'] = new sfValidatorString(array('required' => true, 'max_length' => 1000),
          array('invalid' => __('Ese resumen de tu caso de éxito no es válido.'),
          'required' => __('No has incluido un resumen del caso de éxito.'),
          'max_length' => __('Has superado el espacio permitido para el resumen del caso de éxito.'))); */

        $this->validatorSchema['description'] = new sfValidatorString(array('required' => true), array('invalid' => __('Ese caso de éxito no es válido.'),
                    'required' => __('No has incluido una descripción del caso de éxito.'),
                ));
        $this->validatorSchema['summary'] = new sfValidatorString(array('required' => true), array('invalid' => __('Ese resumen de tu caso de éxito no es válido.'),
                    'required' => __('No has incluido un resumen del caso de éxito.'),
                ));

        $this->validatorSchema['producto_tipo_uno_id']->setMessage('required', 'No has seleccionado un sector del producto.');
        $this->validatorSchema['producto_tipo_dos_id']->setMessage('required', 'No has seleccionado un subsector del producto.');
        $this->validatorSchema['producto_tipo_tres_id']->setMessage('required', 'No has seleccionado un tipo de producto.');

        $this->validatorSchema['file1'] = new pkValidatorFilePersistent(array('required' => false, 'mime_type_guessers' => array(array('fakemime', 'detect')), 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
        $this->validatorSchema['file2'] = new pkValidatorFilePersistent(array('required' => false, 'mime_type_guessers' => array(array('fakemime', 'detect')), 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
        $this->validatorSchema['file3'] = new pkValidatorFilePersistent(array('required' => false, 'mime_type_guessers' => array(array('fakemime', 'detect')), 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
        $this->validatorSchema['file4'] = new pkValidatorFilePersistent(array('required' => false, 'mime_type_guessers' => array(array('fakemime', 'detect')), 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
        $this->validatorSchema['logo'] = new pkValidatorFilePersistent(array('required' => false, 'mime_type_guessers' => array(array('fakemime', 'detect')), 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'));
        /* $this->mergePostValidator(
          new sfValidatorCallback(array('callback' => array($this, 'checkLista')))
          );


          $this->mergePostValidator(
          new sfValidatorCallback(array('callback' => array($this, 'checkDestacados')))
          );
         */

        $this->mergePostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkActividad')))
        );
        unset($this->validatorSchema['file2']);
        unset($this->validatorSchema['file3']);
        unset($this->validatorSchema['file4']);
        unset($this->widgetSchema['file2']);
        unset($this->widgetSchema['file3']);
        unset($this->widgetSchema['file4']);


        $this->widgetSchema->setLabels(array(
            'name' => 'Producto',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'producto_tipo_uno_id' => 'Sector del producto',
            'producto_tipo_dos_id' => 'Subsector del producto',
            'producto_tipo_tres_id' => 'Tipo de producto',
            'file1' => 'Archivo',
            'file2' => 'Archivo 2',
            'file3' => 'Archivo 3',
            'file4' => 'Archivo 4',
            'logo' => 'Añadir logo',
        ));
        $this->widgetSchema->setNameFormat('product_case_study[%s]');
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

}