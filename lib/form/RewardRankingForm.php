<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class RewardRankingForm extends BaseForm {

  public function configure() {
    parent::configure();
    $rank_options = array(
        '' => 'Cualquier cantidad',
        '1' => 'Entre 1 y 30 Euros',
        '2' => 'Entre 31 y 100 Euros',
        '3' => 'Entre 101 y 300 Euros',
        '4' => 'Entre 301 y 1.000 Euros',
        '5' => 'Entre 1.001 and 6.000 Euros',
        '6' => 'Más de 6.000 Euros');
    $this->setWidgets(array(
        'user' => new sfWidgetFormInputText(array(),array('maxlength'=>70)),
        'rank' => new sfWidgetFormChoice(array('choices' => $rank_options))
    ));

    $this->setValidators(array(
        'user' => new sfValidatorPass(),
        'rank' => new sfValidatorPass(),
    ));

    $this->widgetSchema->setNameFormat('rewar_ranking[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    

    parent::setup();
  }

}
