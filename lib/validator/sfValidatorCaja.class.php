<?php


class sfValidatorCaja extends sfValidatorBase
{
  
  protected function configure($options = array(), $messages = array())
  {
    $this->setMessage('invalid', '"%value%" is not an integer.');
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {
    $caja_orignal = $value;    

      if (isset($value)) {
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        
        $caja_with_format = $this->getMoneyInFormat($value);
        
        if($caja_with_format != $caja_orignal ){
          throw new sfValidatorError($this, 'invalid', array('value' => $caja_orignal));
        }
      }else{
        throw new sfValidatorError($this, 'invalid', array('value' => $caja_orignal));
      }
      return $caja_orignal;
  }
  
  protected function getMoneyInFormat($money){

      if(!is_float($money))
      {
        //return $money;
      }

    $poswer = 0;
    if(strpos($money, '.')){
      $poswer = substr($money, strpos($money, '.')+1, strlen($money));
      $poswer = strlen($poswer);
    }
    if($poswer){
      return number_format($money,$poswer,',','.');
    }else{
      return number_format($money,0,',','.');
    }
     
    
      
    }
}
