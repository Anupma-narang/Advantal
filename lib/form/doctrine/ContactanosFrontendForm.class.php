<?php

/**
 * Contactanos form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));

class ContactanosFrontendForm extends BaseContactanosForm {

    public function configure() {

        $usuario = $this->getOption('usuario');
        $usuari = false;
        if (isset($usuario))
            if ($usuario->isAuthenticated())
                $usuari = true;


        $contact_us_status = array('1' => 'Revista ', '2' => 'Tramitado', '3' => 'Cerrado');
        $this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('default' => ($usuari) ? $usuario->getGuardUser()->getId() : '', 'model' => 'sfGuardUser', 'add_empty' => 'Selecciona Usuario'));
        $this->widgetSchema['nombre'] = new sfWidgetFormInputText(array('default' => ($usuari) ? $usuario : ''), array('maxlength' => 70, 'class' => 'tamano_32_c ' . ($usuari ? 'cgr1-color' : ''), 'readonly' => ($usuari ? 'readonly' : '')));
        $this->widgetSchema['apellido1'] = new sfWidgetFormInputText(array('default' => ($usuari) ? $usuario->getProfile()->getSurname1() : ''), array('maxlength' => 70, 'class' => 'tamano_32_c ' . ($usuari ? 'cgr1-color' : ''), 'readonly' => ($usuari ? 'readonly' : '')));
        $this->widgetSchema['apellido2'] = new sfWidgetFormInputText(array('default' => ($usuari) ? $usuario->getProfile()->getSurname2() : ''), array('maxlength' => 70, 'class' => 'tamano_32_c ' . ($usuari ? 'cgr1-color' : ''), 'readonly' => ($usuari ? 'readonly' : '')));
        $this->widgetSchema['email'] = new sfWidgetFormInputText(array('default' => ($usuari) ? $usuario->getGuardUser()->getEmailAddress() : ''), array('maxlength' => 70, 'class' => 'tamano_32_c ' . ($usuari ? 'cgr1-color' : ''), 'readonly' => ($usuari ? 'readonly' : '')));
        $this->widgetSchema['phone'] = new sfWidgetFormInputText(array(), array('maxlength' => 9, 'class' => 'tamano_9_c'));
        $this->widgetSchema['created_at'] = new sfWidgetFormDateTime();
        $this->widgetSchema['comentario'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'error_max_length', 'max_length' => 12300));
        $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => $contact_us_status));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'nombre' => new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 70, 'min_length' => 2, 'required' => true), array('required' => __('Necesitas incluir tu nombre.'), 'invalid' => __('Ese nombre no es válido.'))),
                new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array(), array('required' => __('Necesitas incluir tu nombre.'), 'invalid' => __('Ese nombre no es válido.'))),
            'apellido1' => new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 70, 'min_length' => 2), array('required' => 'Necesitas incluir tu primer apellido.', 'invalid' => 'Ese apellido no es válido.')),
                new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', "ñ", 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array(), array('required' => __('Necesitas incluir tu primer apellido.'), 'invalid' => __('Ese apellido no es válido.'))),
            'apellido2' => new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 70, 'min_length' => 2), array('required' => 'Necesitas incluir tu segundo apellido.', 'invalid' => 'Ese apellido no es válido.')),
                new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_nombre, 'inicio' => "/^[a-z\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', "ñ", 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                    ), array(), array('required' => __('Necesitas incluir tu segundo apellido.'), 'invalid' => __('Ese apellido no es válido.'))),
            'email' => new sfValidatorEmail(array('required' => true), array('required' => 'Necesitas incluir tu correo electrónico.',
                'invalid' => 'Ese correo electrónico no es válido.')),
            'phone' => new sfValidatorRegex(array(
                'pattern' => '#^(\d{9})$#',
                'required' => false
                    ), array('invalid' => 'Necesitas introducir 9 números sin espacios.')
            ),
            'comentario' => new mySfValidatorString(array('min_length' => 2, 'required' => true), array('required' => __('Necesitas incluir tu comentario.'),
                'invalid' => __('Ese comentario no es válido.'),
            )),
            'logo' => new sfValidatorFile(array('required' => false, 'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/')),
            'status' => new sfValidatorChoice(array('choices' => array(1, 2, 3), 'required' => false)),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => ('sfGuardUser'), 'required' => false), array('required' => 'Necesitas seleccionar un Usuario.')),
        ));
        $this->widgetSchema->setLabels(array(
            'nombre' => 'Tu nombre*',
            'apellido1' => 'Tu apellido 1*',
            'apellido2' => 'Tu apellido 2*',
            'email' => 'Tu correo electrónico*',
            'phone' => 'Tu teléfono',
            'comentario' => 'Tus ideas, comentarios o sugerencias*',
            'fichero1' => 'Archivo 1',
            'fichero2' => 'Archivo 2',
            'fichero3' => 'Archivo 3',
            'fichero4' => 'Archivo 4',
            'fichero5' => 'Archivo 5',
            'status' => 'Estado'
        ));

        for ($i = 1; $i <= 5; $i++) {
            $this->widgetSchema['fichero' . $i] = new pkWidgetFormInputFilePersistentcontact(array('existing-html' => '<p>Ya has subido uno o varios ficheros.<br />Si desea reemplazar el fichero use el botón Examinar.</p>'));
            $this->validatorSchema['fichero' . $i] = new pkValidatorFilePersistent(array(
                        'required' => false,
                        'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/',
                        'max_size' => 10240000,
                        //'mime_types' => functions::$mime_types,
                        'mime_type_guessers' => array(array('fakemime', 'detect')),
                            //'mime_type_guessers' => array()
                            ), array('max_size' => 'Puedes incluir hasta 10 MB de archivos por mensaje.'));

            /* $this->validatorSchema['filename'] = new sfValidatorFile(array(
              'required' => false,
              'path' => sfConfig::get('sf_upload_dir'),
              'mime_categories' => array(
              'application' => array('application/pdf'),
              'web_images' => array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif'),
              ),
              'mime_types' => array('application' 'web_images')
              )); */
        }

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->validatorSchema->setOption('filter_extra_fields', false);
        unset($this["updated_at"]);
    }

}
