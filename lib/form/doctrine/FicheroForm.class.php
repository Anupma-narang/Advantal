<?php

/**
 * Fichero form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FicheroForm extends BaseFicheroForm {

    public function configure() {
        unset($this["created_at"], $this["updated_at"]);


        $contribucionid = sfContext::getInstance()->getRequest()->getParameter("contribucion_id");
        $this->setDefault("contribucion_id", $contribucionid);
        $this->widgetSchema["contribucion_id"] = new sfWidgetFormInputHidden();
        $this->setDefault("user_id", sfContext::getInstance()->getUser()->getGuardUser()->getId());

        $this->widgetSchema['file'] = new sfWidgetFormInputFileEditable(array(
            'file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/'
            . basename(sfConfig::get('sf_documents_dir')) . '/' . $this->getObject()->getFile(),
            'is_image' => false,
            'edit_mode' => strlen($this->getObject()->getFile()) > 0,
            'template' => '
           <div id=remove>
               <a href="/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/'
            . $this->getObject()->getFile() . '">
               %input%
           </div>  '
        ));
        $this->widgetSchema->setLabels(array("file" => "Archivo"));
        $this->validatorSchema['file'] = new sfValidatorFile(array(
            'required' => false,
            'path' => sfConfig::get('sf_documents_dir'),
            'mime_types' => sfConfig::get('app_allowed_mime_types_uploads')
        ));
    }

}