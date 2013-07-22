<?php

/**
 * ComentarioListaNegra form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ComentarioListaNegraForm extends BaseComentarioListaNegraForm {

    public function configure() {
        unset($this['updated_at'], $this['created_at'], $this['sf_guard_user_id'], $this['producto_id'], $this['empresa_id']);
        $this->widgetSchema['comentario'] = new sfWidgetFormTextareaCKEditor(array('width' => ((sfConfig::get("sf_app") == "backend") ? 600 : 510), 'height' => 200, 'err_id' => 'error_max_length', 'max_length' => 3000));
        $this->validatorSchema['comentario'] = new sfValidatorString(array('min_length' => 0, 'required' => true));
        $this->validatorSchema['comentario']->setMessage('required', 'Necesitas introducir un comentario.');
    }

}
