<?php

/**
 * Informa form base class.
 *
 * @method Informa getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInformaForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
            'se_crea_un_concurso_para_producto' => new sfWidgetFormInputText(),
            'se_crea_un_concurso_para_empresa' => new sfWidgetFormInputText(),
            'un_concurso_en_el_que_contribuyes_finaliza_en_3_dias' => new sfWidgetFormInputText(),
            'una_mesa_redonda_en_el_que_contribuyes_finaliza_en_3_dias' => new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
            'se_crea_un_concurso_para_producto' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'se_crea_un_concurso_para_empresa' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'un_concurso_en_el_que_contribuyes_finaliza_en_3_dias' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'una_mesa_redonda_en_el_que_contribuyes_finaliza_en_3_dias' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->widgetSchema->setNameFormat('informa[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Informa';
    }

}
