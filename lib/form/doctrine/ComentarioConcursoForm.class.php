<?php

/**
 * ComentarioConcurso form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ComentarioConcursoForm extends BaseComentarioConcursoForm {

    public function configure() {
        unset($this['created_at'], $this['updated_at'], $this['user_id'], $this['concurso_id']);

        //$this->widgetSchema['mensaje']  = new sfWidgetFormTextarea(array(),array('rows' => 20, 'cols' => 40));

        $this->widgetSchema['mensaje'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_mensaje', 'max_length' => 12300));
        $this->validatorSchema['mensaje'] = new sfValidatorString(array('max_length' => 12300), array('max_length' => 'Has superado el espacio permitido.'));
        $this->validatorSchema["mensaje"]->setMessage("required", 'No has incluido un comentario.');

        //$this->validatorSchema['mensaje'] = new sfValidatorString(array('required' => true),array('required' => 'Debes indicar un mensaje.'));

        $this->getObject()->setUserId($this->getOption('user_id'));
        $this->getObject()->setConcursoId($this->getOption('concurso_id'));
    }

}
