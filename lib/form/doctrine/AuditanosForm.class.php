<?php

/**
 * Auditanos form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AuditanosForm extends BaseAuditanosForm {

    public function configure() {
        $usuario = $this->getOption('usuario');
        $usuari = false;
        if (isset($usuario))
            if ($usuario->isAuthenticated())
                $usuari = true;

        $audit_status = array('1' => 'Revista ', '2' => 'Tramitado', '3' => 'Cerrado');

        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['usuario'] = new sfWidgetFormInputText(array("default" => (!$this->isNew() ? $this->getObject()->getSfGuardUser()->getUsername() : "")), array('id' => 'auditanos_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->widgetSchema['email'] = new sfWidgetFormInputText(array('default' => ($usuari) ? $usuario->getGuardUser()->getEmailAddress() : ''), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['plan'] = new sfWidgetFormTextareaCKEditor(array('width' => ((sfConfig::get("sf_app") == "backend") ? 600 : 585), 'height' => 200, 'err_id' => 'error_max_length', 'max_length' => 12300), array());
        $this->widgetSchema['phone'] = new sfWidgetFormInputText(array(), array('maxlength' => 9, 'class' => 'tamano_9_c'));
        $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => $audit_status));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'usuario' => new sfValidatorDoctrineChoice(array('required' => true, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'username'), array('required' => 'Necesitas seleccionar un Usuario.', 'invalid' => 'Ese Usuario no es válido.')),
            'user_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'))),
            'email' => new sfValidatorEmail(array('max_length' => 70), array('required' => 'Necesitas incluir tu correo electrónico.', 'invalid' => 'Ese correo electrónico no es válido.')),
            'plan' => new sfValidatorString(array(), array('required' => 'Necesitas incluir tu Plan de acción.',
                    // 'max_length' => 'Has superado el espacio permitido para tu Plan de acción.'
            )),
            'phone' => new sfValidatorRegex(array(
                'pattern' => '#^(\d{9})$#',
                'required' => false
                    ), array('invalid' => 'Necesitas introducir 9 números sin espacios.
')
            ),
            'created_at' => new sfValidatorDateTime(array('required' => false)),
            'updated_at' => new sfValidatorDateTime(array('required' => false)),
            'status' => new sfValidatorChoice(array('choices' => array(1, 2, 3), 'required' => false))
        ));

        for ($i = 1; $i <= 5; $i++) {
            $this->widgetSchema['fichero' . $i] = new pkWidgetFormInputFilePersistentcontact(array('existing-html' => '<p>Ya has subido uno o varios ficheros.<br />Si desea reemplazar el fichero use el botón Examinar.</p>'));
            $this->validatorSchema['fichero' . $i] = new pkValidatorFilePersistent(array(
                        'required' => false,
                        'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/',
                        'max_size' => 10240000,
                        //'mime_types' => functions::$mime_types,
                        //'mime_type_guessers' => array()
                        'mime_type_guessers' => array(array('fakemime', 'detect')),
                            ), array('max_size' => 'Puedes incluir hasta 10 MB de archivos por mensaje.'));
        }
        $this->widgetSchema->setLabels(array(
            'user_id' => 'Usuario',
            'usuario' => 'Usuario',
            'email' => 'Correo electrónico',
            'plan' => 'PLAN DE ACCIÓN',
            'fichero1' => 'Archivo 1',
            'fichero2' => 'Archivo 2',
            'fichero3' => 'Archivo 3',
            'fichero4' => 'Archivo 4',
            'fichero5' => 'Archivo 5',
            'phone' => 'Teléfono de contacto',
            'status' => 'Estado'
        ));
        $this->widgetSchema->setNameFormat('auditanos[%s]');
        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->validatorSchema->setOption('filter_extra_fields', false);

        unset($this["updated_at"], $this['created_at']);
    }

}
