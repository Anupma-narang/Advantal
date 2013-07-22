<td class="sf_admin_date sf_admin_list_td_created_at">
    <?php echo get_partial('auditanos/created_at', array('type' => 'list', 'auditanos' => $auditanos)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_state">
    <?php echo get_partial('auditanos/state', array('type' => 'list', 'auditanos' => $auditanos)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_location">
    <?php echo get_partial('auditanos/location', array('type' => 'list', 'auditanos' => $auditanos)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_heirarchy">
    <?php echo get_partial('auditanos/heirarchy', array('type' => 'list', 'auditanos' => $auditanos)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_username">
    <?php echo get_partial('auditanos/username', array('type' => 'list', 'auditanos' => $auditanos)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_status">
    <?php echo get_partial('auditanos/status', array('type' => 'list', 'auditanos' => $auditanos)) ?>
</td>
