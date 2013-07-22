<?php

/**
 * ContribucionCpArchivo form base class.
 *
 * @method ContribucionCpArchivo getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContribucionCpArchivoForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'contribucion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContribucionCp'), 'add_empty' => false)),
            'file' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'contribucion_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ContribucionCp'))),
            'file' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('contribucion_cp_archivo[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ContribucionCpArchivo';
    }

}
