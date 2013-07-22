<?php

/**
 * ColaboradorPuntosHistorico form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ColaboradorPuntosHistoricoForm extends BaseColaboradorPuntosHistoricoForm {

    public function configure() {
        $caracteres_no_validos_puntos = sfApplyForm2::$caracteres_no_validos_direccion;
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        unset($this['objeto'], $this['objeto_id'], $this['created_at'], $this['updated_at'], $this['parametros']);

        $this->widgetSchema['puntos'] = new sfWidgetFormInputText(array(), array('maxlength' => 10, 'class' => 'tamano_10_c', 'id' => 'points', 'onkeypress'=>"return checkValue(event);"));

        $this->validatorSchema['puntos'] = new sfValidatorString(
                array('required' => true),
                array('required' => 'Necesitas introducir el número de puntos.')
                );

                
        $this->widgetSchema['descripcion'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_40_c'));
        $this->widgetSchema['tipo_punto'] = new sfWidgetFormInputText(array(), array('maxlength' => 40, 'class' => 'tamano_20_c'));

        



        $this->validatorSchema['tipo_punto'] = new sfValidatorAnd(array(
                ), array(), array('required' => __('Necesitas incluir el tipo de puntos.'), 'invalid' => __('Necesitas incluir el tipo de puntos.')));
        $this->validatorSchema['descripcion'] = new sfValidatorAnd(array(
                ), array(), array('required' => __('Necesitas incluir una descripción.'), 'invalid' => __('Necesitas incluir una descripción.')));

        
        $this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser', 'required' => true), array('required' => __('Necesitas seleccionar un Usuario.'), 'invalid'=>__('Ese Usuario no es válido.')));

        $this->widgetSchema->setLabels(array(
            'tipo_punto' => ('Tipo de puntos')
        ));

        $this->validatorSchema['puntos'] = new sfValidatorRegex(
                        array('pattern' => '/^[0-9,,.]*$/', 'trim' => 'both', 'required' => true),
                        array('required' => 'Necesitas introducir el número de puntos.', 'invalid' => 'Necesitas introducir el número de puntos.')
        );


        //user_id
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden(array(), array('id' => 'concurso_user_id'));
        $this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser')));

        //username
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array('label' => 'Usuario/Alias'), array('id' => 'concurso_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->validatorSchema['user_name'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'username'), array('required' => 'Necesitas seleccionar un Usuario.', 'invalid' => 'Ese Usuario no es válido.'));


        if(! $this->isNew())
        {
          $this->setDefault('user_name', $this->getObject()->getSfGuardUser()->getUsername());
        }

        
        //for check decimal point
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'checkPuntos'))));
    }
    public function checkPuntos($validator, $values)
    {

      $test=0;
      $error = array();

      $points =  $values['puntos'];

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
          $errorMessage = 'Necesitas introducir el número de puntos.';
          $errorCount++;          
        }
        else if(($sign) && ($val > 10000000))
        {
          $errorMessage = 'No puedes asignar un valor superior a 10.000.000.';
          $errorCount++;          
        }else if($isValidDecimal === 0)
        {
          $errorMessage = 'No puedes asignar más de cuatro decimales.';
          $errorCount++;
        }        
        else if(! $isPoint && $val >= 1000)
        {
          $errorMessage = 'Necesitas introducir el número de puntos.';
          $errorCount++;
        }else if(isset($invalidString) && $invalidString == 0)
        {
          $errorMessage = 'Necesitas introducir el número de puntos.';
          $errorCount++;          
        }

        if($errorCount > 0)
        {          
          $error['puntos'] = new sfValidatorError($validator, $errorMessage);
          throw new sfValidatorErrorSchema($validator, $error);          
        }        
      }
      
      return $values;
    }
    public function updateObject($values = null)
    {

      $values = $this->values;

      $puntos = $values['puntos'];
      $puntos = str_replace('.', '', $puntos);
      $puntos = str_replace(',', '.', $puntos);
      $values['puntos'] = $puntos;

      parent::updateObject($values);
    }
    
}
