<?php

/**
 * ConcursoArchivo form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfesionalArchivoFormBackend extends BaseProfesionalArchivoForm {

    public function configure() {
        $this->useFields(array("file"));

        $this->widgetSchema['file'] = new sfWidgetFormInputFileEditable(array(
            'file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/'
            . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getFile(),
            'is_image' => false,
            'edit_mode' => strlen($this->getObject()->getFile()) > 0,
            'template' => '
           <div id=remove>
               %input%
           </div>  '
                ), array('style' => 'width:500px;'));
        $this->widgetSchema->setLabels(array("file" => "Archivo"));
        $this->validatorSchema['file'] = new sfValidatorFile(array(
            'required' => false,
            'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/',
            'mime_type_guessers' => array(),
            'mime_types' => array(
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-excel',
                'application/pdf',
                'application/x-pdf',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'application/vnd.ms-powerpoint',
                'application/zip',
                'application/x-zip-compressed',
                'application/rar',
                'application/x-rar',
                'application/x-rar-compressed'
            )
                //'mime_types' => sfConfig::get('app_allowed_mime_types_uploads','all')
        ));
    }

}

//<a href="/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'. $this->getObject()->getFile() . '">