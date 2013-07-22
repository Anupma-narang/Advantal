<?php
class myUser extends sfGuardSecurityUser
{
	public function initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array())
	{
		parent::initialize($dispatcher, $storage, $options);
		
		$this->setCulture('es');
	}
  
  public function getId(){
    if($user = $this->getGuardUser()){
      return $user->getId();
    }
    return false;
  }

  /**
   *  method return money in european format
   * @param Float $money Money
   * @return String
   */
  public function getMoneyInFormat($money) {

    $poswer = 0;
    
    if (strpos($money, '.')) {
      $poswer = substr($money, strpos($money, '.') + 1, strlen($money));
      $poswer = str_replace('0',' ', $poswer);
      
      $poswer = strlen(rtrim($poswer));
    }
    
    if ($poswer)
    {
      $returnMoney = number_format($money, ($poswer == 0 ? 0 : ($poswer > 4 ? 4: $poswer)), ',', '.');
    }
    else
    {
      $returnMoney = number_format($money, 0, ',', '.');      
    }

    $tempPoint = strpos($returnMoney, ',');

    if($tempPoint)
    {
      $tempPointArray= explode(',', $returnMoney);
      if(strlen($tempPointArray[1]) == 1)
      {
        $returnMoney .= '0';
      }
    }
    
    
    return $returnMoney;
    
  }
    
    /**
     * check if caja amount is in format or not
     * @param String $caja
     * @return boolean
     */
    public function isCajaValid($caja){
      $caja_orignal = $caja;
      if ($caja) {
        $caja = str_replace('.', '', $caja);
        $caja = str_replace(',', '.', $caja);
        
        $caja_with_format = $this->getMoneyInFormat($caja);
        
        if($caja_with_format = $caja_orignal ){
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }
}
