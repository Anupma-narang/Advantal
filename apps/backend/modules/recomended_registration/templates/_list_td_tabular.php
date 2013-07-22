<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo get_partial('recomended_registration/created_at', array('type' => 'list', 'recomended_registration' => $recomended_registration)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_registered_user">
  <?php echo $recomended_registration->getRegisteredUser() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_recomended_user">
  <?php echo $recomended_registration->getRecomendedUser() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_email">
  <?php echo $recomended_registration->getEmail() ?>
</td>
