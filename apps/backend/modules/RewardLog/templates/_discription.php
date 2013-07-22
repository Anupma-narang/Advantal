<?php
      $description = $reward_log->getDescroption();
      $strlen =  strlen($description);
      $strlen = ($strlen > 40) ? 40:$strlen;

      $temp='';
      $tempText= '';
      $br= 0;
      if($strlen > 20)
      {
        for($i=0;$i<$strlen;$i++)
        {
          if($i >= 20)
          {
            if($description[$i] == " " && $br == 0)
            {
              $temp .= "<br />";
              $br++;
            }
          }

          $temp .= $description[$i];
        }

        if($br == 0)
        {
          $tempText .= substr($description, 0, 20);
          $tempText .= "<br />";
          $tempText .= substr($description, 20, 20);
          echo $tempText ;
        }
        else
        {
          echo $temp;
        }

      }
      else
      {
        echo $description;
      }
?>
