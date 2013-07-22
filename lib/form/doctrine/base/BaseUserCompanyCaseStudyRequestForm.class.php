<?php

/**
 * UserCompanyCaseStudyRequest form base class.
 *
 * @method UserCompanyCaseStudyRequest getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUserCompanyCaseStudyRequestForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'status' => new sfWidgetFormInputText(),
            'user_name' => new sfWidgetFormInputText(),
            'user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
            'name' => new sfWidgetFormInputText(),
            'homepage' => new sfWidgetFormInputText(),
            'road_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'add_empty' => true)),
            'direccion' => new sfWidgetFormInputText(),
            'numero' => new sfWidgetFormInputText(),
            'piso' => new sfWidgetFormInputText(),
            'puerta' => new sfWidgetFormInputText(),
            'states_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => true)),
            'city_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'add_empty' => true)),
            'cp' => new sfWidgetFormInputText(),
            'empresa_sector_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorUno'), 'add_empty' => true)),
            'empresa_sector_dos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorDos'), 'add_empty' => true)),
            'empresa_sector_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorTres'), 'add_empty' => true)),
            'description' => new sfWidgetFormInputText(),
            'summary' => new sfWidgetFormInputText(),
            'file1' => new sfWidgetFormInputText(),
            'file2' => new sfWidgetFormInputText(),
            'file3' => new sfWidgetFormInputText(),
            'file4' => new sfWidgetFormInputText(),
            'logo' => new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'status' => new sfValidatorInteger(array('required' => false)),
            'user_name' => new sfValidatorString(array('max_length' => 50)),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
            'name' => new sfValidatorString(array('max_length' => 50)),
            'homepage' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'road_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'required' => false)),
            'direccion' => new sfValidatorString(array('max_length' => 70, 'required' => false)),
            'numero' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'piso' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'puerta' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'states_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'required' => false)),
            'city_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'required' => false)),
            'cp' => new sfValidatorString(array('max_length' => 5, 'required' => false)),
            'empresa_sector_uno_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorUno'), 'required' => false)),
            'empresa_sector_dos_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorDos'), 'required' => false)),
            'empresa_sector_tres_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorTres'), 'required' => false)),
            'description' => new sfValidatorPass(array('required' => false)),
            'summary' => new sfValidatorPass(array('required' => false)),
            'file1' => new sfValidatorPass(array('required' => false)),
            'file2' => new sfValidatorPass(array('required' => false)),
            'file3' => new sfValidatorPass(array('required' => false)),
            'file4' => new sfValidatorPass(array('required' => false)),
            'logo' => new sfValidatorPass(array('required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->widgetSchema->setNameFormat('user_company_case_study_request[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'UserCompanyCaseStudyRequest';
    }

}
