  <?php
      $gift = $reward_log->getGift();
      $strlen =  strlen($gift);
      $temp='';

      if($strlen > 35)
      {
        $temp .= substr($gift, 0, 35);
        $temp .= "<br />";
        $temp .= substr($gift, 35, 35);
        echo $temp;
      }
      else
      {
        echo $gift;
      }
  ?>


