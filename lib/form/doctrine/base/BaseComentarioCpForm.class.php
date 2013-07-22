<?php

/**
 * ComentarioCp form base class.
 *
 * @method ComentarioCp getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseComentarioCpForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'contenido' => new sfWidgetFormTextarea(),
            'user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
            'concurso_cp_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCp'), 'add_empty' => false)),
            'contribucion_cp_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContribucionCp'), 'add_empty' => false)),
            'parent_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Parent'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 255)),
            'contenido' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
            'concurso_cp_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCp'))),
            'contribucion_cp_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ContribucionCp'))),
            'parent_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Parent'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('comentario_cp[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ComentarioCp';
    }

}
