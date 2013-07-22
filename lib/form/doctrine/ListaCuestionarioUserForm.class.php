<?php

/**
 * ListaCuestionarioUser form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ListaCuestionarioUserForm extends BaseListaCuestionarioUserForm {

    public function configure() {
        unset($this['user_id'], $this['empresa_id'], $this['producto_id'], $this['lista_cuestionario_id'], $this['created_at'], $this['updated_at']);
        $subform = new sfForm();
        foreach ($this->getObject()->getCuestionario()->getListaCuestionarioPregunta() as $pregunta) {
            $listaCuestionarioRespuesta = new ListaCuestionarioRespuesta();
            $list_reply = Doctrine::getTable('ListaCuestionarioRespuesta')->getRecordByListQuestionUserId($this->getObject()->getId(), $pregunta->getId());
            $listaCuestionarioRespuesta->setRespuesta($list_reply);
            $listaCuestionarioRespuesta->setPregunta($pregunta);
            $listaCuestionarioRespuesta->setListaCuestionarioPreguntaId($pregunta->getId());
            $listaCuestionarioRespuesta->setListaCuestionarioUser($this->getObject());

            $pregunta_form = new ListaCuestionarioUserRespuestaForm($listaCuestionarioRespuesta, array('pregunta' => $pregunta));
            $subform->embedForm('respuesta' . $pregunta->getId(), $pregunta_form);
        }
        $this->embedForm('Preguntas', $subform);
    }

}
