<?php

class BaseChangeCajaBackendForm extends BaseForm
{
  public function configure()
  {  	  
  	parent::configure();
        
        
        $this->widgetSchema['cantidad'] = new sfWidgetFormInputText();
        $this->validatorSchema['cantidad'] = new sfValidatorCaja(array('required' => true),array('required' => 'Necesitas introducir una cantidad asignada.','invalid' => 'Necesitas introducir una cantidad asignada.'));
        
        $this->widgetSchema['accion'] = new sfWidgetFormChoice(array('choices' => array(1=>'Sumar',2=>'Restar')));
        $this->validatorSchema['accion'] = new sfValidatorInteger(array('required' => true));
        
        $this->widgetSchema['comentario'] = new sfWidgetFormInputText();
        $this->validatorSchema['comentario'] = new sfValidatorString(array('max_length' => 500,'required'=>true),array('required' => 'Necesitas incluir un comentario.'));
        
        
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidate'))));
        $this->widgetSchema->setNameFormat('changecaja_backend[%s]');                
  }

    public function postValidate($validator, $values) {

//        echo "<pre>";print_r($values);exit;
        $cash = trim($values['cantidad']);

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
                $error['cantidad'] = new sfValidatorError($validator, $errorMessage);
                throw new sfValidatorErrorSchema($validator, $error);
              }
            }
        }

        return $values;
    }
}