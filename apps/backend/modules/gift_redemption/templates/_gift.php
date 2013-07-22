<?php
    $tempGift = $gift_redemption->getGift();
    
    $strlen =  strlen($tempGift);
    $temp='';

    if($strlen > 35)
    {
      $temp .= substr($tempGift, 0, 35);
      $temp .= "<br />";
      $temp .= substr($tempGift, 35, 35);
      echo $temp;
    }
    else
    {
      echo $tempGift;
    }
?>

