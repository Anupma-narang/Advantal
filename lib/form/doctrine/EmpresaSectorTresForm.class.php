<?php

/**
 * EmpresaSectorTres form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EmpresaSectorTresForm extends BaseEmpresaSectorTresForm {

    public function configure() {
        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'style' => 'width:495px'));
        $this->widgetSchema['orden'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'class' => 'tamano_3_c'));
        $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('EmpresaSectorUno'),
            'order_by' => array('orden', 'asc'),
            'add_empty' => 'Selecciona sector',
        ));

        $this->widgetSchema['empresa_sector_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'EmpresaSectorDos',
            'depends' => 'EmpresaSectorUno',
            'ajax' => true,
            'add_empty' => 'Selecciona subsector'));

        $this->widgetSchema['empresa_sector_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'EmpresaSectorTres',
            //'table_method' => 'getSectoresTresOrderByOrden',
            'depends' => 'EmpresaSectorDos',
            'ajax' => true,
            'add_empty' => 'Selecciona actividad '));

        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

        $this->validatorSchema['orden'] = new sfValidatorAnd(array(
                ), array(), array('required' => __('Necesitas incluir un orden.'), 'invalid' => __('Necesitas incluir un orden.')));

        $this->validatorSchema['name'] = new sfValidatorAnd(array(
                ), array(), array('required' => __('Necesitas incluir una actividad.'), 'invalid' => __('Necesitas incluir una actividad.')));

        $this->validatorSchema['value'] = new sfValidatorString(array('required' => false));

        $this->validatorSchema['empresa_sector_uno_id'] = new sfValidatorDoctrineChoice(array('model' => 'EmpresaSectorTres', 'required' => true), array('required' => __('Necesitas seleccionar un sector.')));

        $this->validatorSchema['empresa_sector_dos_id'] = new sfValidatorDoctrineChoice(array('model' => 'EmpresaSectorTres', 'required' => true), array('required' => __('Necesitas seleccionar un subsector.')));


        $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
            'file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/'
            . basename(sfConfig::get('sf_thumbnail_dir')) . '/' .
            $this->getObject()->getImage(),
            'is_image' => true,
            'edit_mode' => strlen($this->getObject()->getImage()) > 0,
            'template' => '
            <div id=remove>
                %file%
                %input%<br/>
                %delete% %delete_label%
            </div>'));

        $this->widgetSchema->setLabels(array("image" => "Imagen"));
        $this->validatorSchema['image'] = new sfValidatorFile(array(
            'required' => false,
            'mime_types' => 'web_images'));

        $this->validatorSchema['image_delete'] = new sfValidatorPass();
        //$this->validatorSchema['web'] = new sfValidatorUrl();
        //$this->validatorSchema['email'] = new sfValidatorEmail();
    }

    protected function doSave($con = null) {
        $upload = $this->getValue('image');
        $delete = $this->getValue('image_delete');

        if ($upload) {

            $filename = sha1($upload->getOriginalName() . microtime() . rand()) . $upload->getExtension($upload->getOriginalExtension());

            $thumbnailImagen = new sfThumbnail(340, 225, true, false, 75, 'sfGDAdapter');

            $filepath = sfConfig::get('sf_images_dir') . '/' . $filename;

            $upload->save(sfConfig::get('sf_images_dir') . '/' . $filename);
            $thumbnailImagen->loadFile($filepath);
            $thumbnailImagen->save($filepath);

            //Configurar directorios de carga de la image(2º parte)

            $thumbnailpath = sfConfig::get('sf_thumbnail_dir') . '/' . $filename;
            $oldfilepath = sfConfig::get('sf_images_dir') . '/' . $this->getObject()->getImage();

            if (file_exists($oldfilepath)) {

                @unlink($oldfilepath);
            }
            $oldthumbnailpath = sfConfig::get('sf_thumbnail_dir') . '/' . $this->getObject()->getImage();

            if (file_exists($oldthumbnailpath)) {
                @unlink($oldthumbnailpath);
            }
            $thumbnail = new sfThumbnail(150, 100, true, false, 75, 'sfGDAdapter');
            $thumbnail->loadFile($filepath);
            $thumbnail->save($thumbnailpath);
            //$upload->save($filepath);
        } else if ($delete) {

            $filename = $this->getObject()->getImage();
            $filepath = sfConfig::get('sf_images_dir') . '/' . $filename;
            @unlink($filepath);
            $thumbnailpath = sfConfig::get('sf_thumbnail_dir') . '/' . $filename;
            @unlink($thumbnailpath);
            $this->getObject()->setImage(null);
        }

        return parent::doSave($con);
    }

    public function updateObject($values = null) {
        $object = parent::updateObject($values);
        $object->setImage(str_replace(sfConfig::get('sf_images_dir') . '/', '', $object->getImage()));
        return $object;
    }

}