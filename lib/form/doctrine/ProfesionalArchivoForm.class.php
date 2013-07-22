<?php

/**
 * ProfesionalArchivo form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Alpesh
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfesionalArchivoForm extends BaseProfesionalArchivoForm {

    public function configure() {
        $this->disableCSRFProtection();
        $this->widgetSchema['profesional_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['file'] = new pkWidgetFormInputFilePersistent(array('existing-html' => '<p>Ya has subido uno o varios ficheros.<br />Si desea reemplazar el fichero use el bot�n Examinar.</p>'));
        $this->widgetSchema['status'] = new sfWidgetFormInputCheckbox();

        $this->validatorSchema['profesional_id'] = new sfValidatorPass(array('required' => false));
        $this->validatorSchema['file'] = new pkValidatorFilePersistent(array('required' => false, 'mime_type_guessers' => array(array('fakemime', 'detect'))));
        $this->validatorSchema['status'] = new sfValidatorBoolean(array('required' => false));

        $this->setDefault('status', 1);
    }

}
