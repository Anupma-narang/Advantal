<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo get_partial('colaboradorpuntoshistorico/created_at', array('type' => 'list', 'colaboradorpuntoshistorico' => $colaboradorpuntoshistorico)) ?>
</td>

<td class="sf_admin_text sf_admin_list_td_puntos">
  <?php echo get_partial('colaboradorpuntoshistorico/puntos', array('type' => 'list', 'colaboradorpuntoshistorico' => $colaboradorpuntoshistorico)) ?>
</td>

<td class="sf_admin_text sf_admin_list_td_tipo_punto" style="width: 160px;">
  <?php
      $tipoPunto = $colaboradorpuntoshistorico->getTipoPunto();
      $strlen =  strlen($tipoPunto);
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
            if($tipoPunto[$i] == " " && $br == 0)
            {
              $temp .= "<br />";
              $br++;
            }
          }
          
          $temp .= $tipoPunto[$i];          
        }

        if($br == 0)
        {
          $tempText .= substr($tipoPunto, 0, 20);
          $tempText .= "<br />";
          $tempText .= substr($tipoPunto, 20, 20);
          echo $tempText ;
        }
        else
        {
          echo $temp;
        }
        
      }
      else
      {
        echo $tipoPunto;
      }      
  ?>
</td>
<td class="sf_admin_text sf_admin_list_td_descripcion" style="width: 100px;">
  <?php echo $colaboradorpuntoshistorico->getDescripcion() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_user_id">
  <?php echo get_partial('colaboradorpuntoshistorico/user_id', array('type' => 'list', 'colaboradorpuntoshistorico' => $colaboradorpuntoshistorico)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_hierarchy" style="width: 150px;">
  <?php echo get_partial('colaboradorpuntoshistorico/hierarchy', array('type' => 'list', 'colaboradorpuntoshistorico' => $colaboradorpuntoshistorico)) ?>
</td>
