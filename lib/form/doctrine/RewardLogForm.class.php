<?php

/**
 * RewardLog form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RewardLogForm extends BaseRewardLogForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        parent::configure();
        
        $this->widgetSchema['cash'] = new sfWidgetFormInputText(array(), array('maxlength' => 10, 'class' => 'tamano_10_c', 'onkeypress'=>"return checkValue(event);"));
        $this->widgetSchema['gift'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_40_c'));
        $this->widgetSchema['descroption'] = new sfWidgetFormInputText(array(), array('maxlength' => 40, 'class' => 'tamano_32_c'));        
        $this->widgetSchema['hierarchy'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Jerarquia')));
        $this->widgetSchema['created_at'] = new sfWidgetFormDate(array('format' => '%day% / %month% / %year%'));

        //username
        
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden(array(), array('id' => 'concurso_user_id'));
        
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array('label' => 'Usuario/Alias'), array('id' => 'concurso_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->validatorSchema['user_name'] = new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser', 'column' => 'username'), array('required' => 'Necesitas seleccionar un Usuario.', 'invalid' => 'Ese Usuario no es válido.'));


        $this->validatorSchema['descroption'] = new sfValidatorString(array('required' => true), array('required' => __('Necesitas incluir una descripción.')));
        $this->validatorSchema['hierarchy'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Jerarquia'), 'required' => true));
        $this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false), array('required' => __('Necesitas seleccionar un Usuario.'), 'invalid' => __('Ese Usuario no es válido.')));
        $this->validatorSchema['gift'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['created_at'] = new sfValidatorDateTime(array('required' => false));

        $this->setDefault('hierarchy', 1);        

        
        
        $this->validatorSchema['gift']->setOption('required',  false);
        $this->validatorSchema['cash']->setOption('required',  false);
        

        $this->widgetSchema->setLabels(array(
            'gift' => __('Regalo'),
            'descroption' => __('Descripción'),
        ));

        
        $this->validatorSchema['cash'] = new sfValidatorRegex(
                        array('pattern' => '/^[0-9,,.]*$/', 'trim' => 'both', 'required' => false),
                        array('invalid' => 'Necesitas introducir una cantidad asignada.')
        );

        if(! $this->isNew())
        {
          $this->setDefault('user_name', $this->getObject()->getUser()->getUsername());
        }
        
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidate'))));
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null)
    {
      if(trim($taintedValues['gift']) != "")
      {
        //$this->validatorSchema['cash']->setOption('required',  false);
      }else
      {
        // $this->validatorSchema['cash']->setOption('required',  true);
      }
      
      parent::bind($taintedValues, $taintedFiles);
    }

    public function postValidate($validator, $values) {

//        echo "<pre>";print_r($values);exit;
        $cash = trim($values['cash']);
        $gift =trim($values['gift']);
        
        if($cash == "" && $gift == "")
        {
          $error['cash'] = new sfValidatorError($validator, "Necesitas introducir una cantidad asignada o un regalo.");
          $error['gift'] = new sfValidatorError($validator, "Necesitas introducir una cantidad asignada o un regalo.");
          
          throw new sfValidatorErrorSchema($validator, $error);          
        }

        if($cash != "" && $cash != 0)
        {
            $points =  $cash;
            // for check minimum and maximum value
            $val = str_replace('.', '', $points);
            $val = str_replace(',', '.', $val);

            $val=floatval($val);

            //check decimal point length
            $isPoint = strpos($points, '.');
            $isComma = strpos($points, ',');

            $isValidDecimal = 1;

            if($isComma)
            {
              $decimalCount= strlen(substr($points, $isComma+1));

              if($decimalCount > 4)
              {
                $isValidDecimal = 0;
              }
              
              foreach (count_chars($points, 1) as $i => $val)
              {
                  if(chr($i) == "," && $val > 1)
                  {
                    $invalidString = 0;
                  }
              }
            }

            $errorCount = 0;
            $errorMessage = '';

            // check value is negative or postive
            $sign = ($val > 0) ? 1:0 ;



            if($points != "")
            {
              if($val == 0)
              {
                $errorMessage = 'Necesitas introducir una cantidad asignada.';
                $errorCount++;
              }
              else if(($sign) && ($val > 10000000))
              {
                $errorMessage = 'No puedes asignar una caja superior a 10.000.000.';
                $errorCount++;
              }else if($isValidDecimal === 0)
              {
                $errorMessage = 'No puedes asignar más de cuatro decimales.';
                $errorCount++;
              }
              else if(! $isPoint && $val >= 1000)
              {
                $errorMessage = 'Necesitas introducir una cantidad asignada.';
                $errorCount++;
              }
              else if(isset($invalidString) && $invalidString == 0)
              {
                $errorMessage = 'Necesitas introducir una cantidad asignada.';
                $errorCount++;
              }

              if($errorCount > 0)
              {
                $error['cash'] = new sfValidatorError($validator, $errorMessage);
                throw new sfValidatorErrorSchema($validator, $error);
              }
            }            
        }

        return $values;
    }
    public function updateObject($values = null)
    {
      $values = $this->values;

      if($values['cash'] == "" || $values['cash'] == null)
      {
        $values['cash'] = null;
      }else
      {
        $puntos = $values['cash'];
        $puntos = str_replace('.', '', $puntos);
        $puntos = str_replace(',', '.', $puntos);
        $values['cash'] = $puntos;        
      }
      
      parent::updateObject($values);
    }

}
