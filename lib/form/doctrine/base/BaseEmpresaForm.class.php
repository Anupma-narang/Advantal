<?php

/**
 * Empresa form base class.
 *
 * @method Empresa getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEmpresaForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'road_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'add_empty' => true)),
            'direccion' => new sfWidgetFormInputText(),
            'numero' => new sfWidgetFormInputText(),
            'piso' => new sfWidgetFormInputText(),
            'puerta' => new sfWidgetFormInputText(),
            'localidad_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'add_empty' => true)),
            'codigopostal' => new sfWidgetFormInputText(),
            'dividendo' => new sfWidgetFormInputText(),
            'divisor' => new sfWidgetFormInputText(),
            'comentario_inicial' => new sfWidgetFormTextarea(),
            'texto_lista_negra' => new sfWidgetFormInputText(),
            'lista' => new sfWidgetFormInputText(),
            'valida' => new sfWidgetFormInputText(),
            'persona_contacto' => new sfWidgetFormInputText(),
            'telefono' => new sfWidgetFormInputText(),
            'email' => new sfWidgetFormInputText(),
            'states_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => true)),
            'lista_cuestionario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cuestionario'), 'add_empty' => true)),
            'empresa_sector_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorUno'), 'add_empty' => true)),
            'empresa_sector_dos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorDos'), 'add_empty' => true)),
            'empresa_sector_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorTres'), 'add_empty' => true)),
            'user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
            'concurso_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('concursoDestacado'), 'add_empty' => true)),
            'featured' => new sfWidgetFormInputCheckbox(),
            'featured_order' => new sfWidgetFormInputText(),
            'slug' => new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 100)),
            'road_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'required' => false)),
            'direccion' => new sfValidatorString(array('max_length' => 70, 'required' => false)),
            'numero' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'piso' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'puerta' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'localidad_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'required' => false)),
            'codigopostal' => new sfValidatorString(array('max_length' => 10, 'required' => false)),
            'dividendo' => new sfValidatorInteger(array('required' => false)),
            'divisor' => new sfValidatorInteger(array('required' => false)),
            'comentario_inicial' => new sfValidatorString(array('required' => false)),
            'texto_lista_negra' => new sfValidatorPass(array('required' => false)),
            'lista' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'valida' => new sfValidatorInteger(array('required' => false)),
            'persona_contacto' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'telefono' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'email' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'states_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'required' => false)),
            'lista_cuestionario_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cuestionario'), 'required' => false)),
            'empresa_sector_uno_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorUno'), 'required' => false)),
            'empresa_sector_dos_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorDos'), 'required' => false)),
            'empresa_sector_tres_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorTres'), 'required' => false)),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'required' => false)),
            'concurso_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('concursoDestacado'), 'required' => false)),
            'featured' => new sfValidatorBoolean(array('required' => false)),
            'featured_order' => new sfValidatorInteger(array('required' => false)),
            'slug' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'Empresa', 'column' => array('slug')))
        );

        $this->widgetSchema->setNameFormat('empresa[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Empresa';
    }

}
