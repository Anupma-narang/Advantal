<td class="sf_admin_text sf_admin_list_td_orden">
  <?php echo $gift->getOrden() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo get_partial('gift/created_at', array('type' => 'list', 'gift' => $gift)) ?>
</td>

<td class="sf_admin_text sf_admin_list_td_name">
  <?php  
      $tempGift = "01234567890"; //$gift->getName();
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
</td>
<td class="sf_admin_text sf_admin_list_td_require_points">
  <?php echo get_partial('gift/require_points', array('type' => 'list', 'gift' => $gift)) ?>
</td>

<td class="sf_admin_foreignkey sf_admin_list_td_hierarchy">
  <?php echo get_partial('gift/hierarchy', array('type' => 'list', 'gift' => $gift)) ?>
</td>

<td class="sf_admin_boolean sf_admin_list_td_featured">
  <?php echo get_partial('gift/featured', array('type' => 'list', 'gift' => $gift)) ?>
</td>

<td class="sf_admin_text sf_admin_list_td_featured_order">
  <?php echo $gift->getFeaturedOrder() ?>
</td>

