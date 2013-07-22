<?php

class ContribucionArchivoForm extends BaseContribucionArchivoForm {

    public function configure() {
        $this->disableCSRFProtection();


        $this->disableCSRFProtection();
        $this->useFields(array('file'));

        $path = '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/';
        $edit_mode = strlen($this->getObject()->getFile()) > 0;
        $file_src = $edit_mode ? $path . $this->getObject()->getFile() : '';
        $this->widgetSchema->setLabels(array('file' => 'Archivo'));
        $this->widgetSchema['status'] = new sfWidgetFormInputCheckbox();


        $this->widgetSchema['file'] = new sfWidgetFormInputFileEditable(array(
                    'file_src' => $this->getObject()->getFile(),
                    'is_image' => false,
                    'edit_mode' => ($this->getObject()->getFile()),
                    'template' => '<div id="remove"><strong>%file%</strong><br/>%input%</div>'
                ));
        $this->validatorSchema['file'] = new sfValidatorFile(array(
                    'required' => false,
                    'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/',
                    'mime_type_guessers' => array(array('fakemime', 'detect'))
                ));
        /* $this->widgetSchema['file'] = new pkWidgetFormInputFilePersistentContribucion(array('existing-html' => '<p>Ya has subido uno o varios ficheros.<br />Si desea reemplazar el fichero use el botón Examinar.</p>'));
          $this->validatorSchema['file'] = new pkValidatorFilePersistent(array('required' => false, 'mime_type_guessers' => array(array('fakemime', 'detect'))));
          $this->widgetSchema['contribucion_id'] = new sfWidgetFormInputHidden();
          $this->validatorSchema['contribucion_id'] = new sfValidatorPass(array('required' => false));
          $this->validatorSchema['status'] = new sfValidatorBoolean(array('required' => false));
          $this->widgetSchema->setLabels(array('file' => 'Archivo')); */
        //$this->setDefault('status', 1);
    }

}
