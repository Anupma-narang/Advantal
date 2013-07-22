<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class HierarchyRankingForm extends BaseForm {

  public function configure() {
    parent::configure();
    
    $this->setWidgets(array(
        'user' => new sfWidgetFormInputText(array(), array('maxlength' => 70 , 'class' => 'tamano_32_c ac_input')),
        'hierarchy' => new sfWidgetFormDoctrineChoice(array('model' => 'Jerarquia', 'add_empty' => 'Todas'))
    ));

    $this->setValidators(array(
        'user' => new sfValidatorPass(),
        'hierarchy' => new sfValidatorPass(),
    ));

    $this->widgetSchema->setNameFormat('hierarchy_ranking[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    

    parent::setup();
  }

}
