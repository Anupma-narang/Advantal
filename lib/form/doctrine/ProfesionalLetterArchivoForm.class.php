<?php

/**
 * ProfesionalLetterArchivo form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfesionalLetterArchivoForm extends BaseProfesionalLetterArchivoForm {

    public function configure() {
        $this->disableCSRFProtection();
        $this->widgetSchema['profesional_letter_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['file'] = new pkWidgetFormInputFilePersistent(array('existing-html' => '<p>Ya has subido uno o varios ficheros.<br />Si desea reemplazar el fichero use el botón Examinar.</p>'));
        $this->widgetSchema['status'] = new sfWidgetFormInputCheckbox();

        $this->validatorSchema['profesional_letter_id'] = new sfValidatorPass(array('required' => false));
        //$this->validatorSchema['file'] = new pkValidatorFilePersistent(array('required' => false, 'mime_type_guessers' => array(array('fakemime', 'detect'))));

        $this->validatorSchema['file'] = new pkValidatorFilePersistent(array(
            'required' => false,
            'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/',
            'max_size' => 2097152,
                ), array('max_size' => 'Puedes incluir hasta 2 MB de archivos por mensaje.'));
        $this->validatorSchema['status'] = new sfValidatorBoolean(array('required' => false));

        $this->setDefault('status', 1);
    }

}
