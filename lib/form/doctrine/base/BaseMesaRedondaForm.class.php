<?php

/**
 * MesaRedonda form base class.
 *
 * @method MesaRedonda getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMesaRedondaForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'fecha_activacion' => new sfWidgetFormDate(),
            'mesaredonda_estado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesaredondaEstado'), 'add_empty' => true)),
            'fecha_referendum' => new sfWidgetFormDate(),
            'mesaredonda_categoria_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesaredondaCategoria'), 'add_empty' => false)),
            'plan_accion' => new sfWidgetFormTextarea(),
            'resumen' => new sfWidgetFormTextarea(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
            'slug' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 100)),
            'fecha_activacion' => new sfValidatorDate(array('required' => false)),
            'mesaredonda_estado_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MesaredondaEstado'), 'required' => false)),
            'fecha_referendum' => new sfValidatorDate(array('required' => false)),
            'mesaredonda_categoria_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MesaredondaCategoria'))),
            'plan_accion' => new sfValidatorString(array('max_length' => 2147483647)),
            'resumen' => new sfValidatorString(array('max_length' => 2147483647)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
            'slug' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'MesaRedonda', 'column' => array('slug', 'id', 'name')))
        );

        $this->widgetSchema->setNameFormat('mesa_redonda[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'MesaRedonda';
    }

}
