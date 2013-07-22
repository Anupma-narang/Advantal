<?php

/**
 * MesaredondaPonencia form base class.
 *
 * @method MesaredondaPonencia getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMesaredondaPonenciaForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'asunto' => new sfWidgetFormInputText(),
            'mesa_redonda_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesaRedonda'), 'add_empty' => false)),
            'plan_accion' => new sfWidgetFormTextarea(),
            'resumen' => new sfWidgetFormTextarea(),
            'fecha_alta' => new sfWidgetFormDate(),
            'mesaredonda_estado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesaredondaEstado'), 'add_empty' => false)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 100)),
            'asunto' => new sfValidatorString(array('max_length' => 200)),
            'mesa_redonda_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MesaRedonda'))),
            'plan_accion' => new sfValidatorString(array('max_length' => 2147483647)),
            'resumen' => new sfValidatorString(array('max_length' => 2147483647)),
            'fecha_alta' => new sfValidatorDate(array('required' => false)),
            'mesaredonda_estado_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MesaredondaEstado'))),
        ));

        $this->widgetSchema->setNameFormat('mesaredonda_ponencia[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'MesaredondaPonencia';
    }

}
