<?php

/**
 * ListaCuestionarioPregunta form base class.
 *
 * @method ListaCuestionarioPregunta getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseListaCuestionarioPreguntaForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'pregunta' => new sfWidgetFormInputText(),
            'tipo' => new sfWidgetFormInputText(),
            'lista_cuestionario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cuestionario'), 'add_empty' => true)),
            'kpi_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Kpi'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'pregunta' => new sfValidatorString(array('max_length' => 255)),
            'tipo' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'lista_cuestionario_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cuestionario'), 'required' => false)),
            'kpi_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Kpi'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('lista_cuestionario_pregunta[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ListaCuestionarioPregunta';
    }

}
