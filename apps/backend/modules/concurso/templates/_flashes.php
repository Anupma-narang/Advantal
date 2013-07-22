<?php if ($sf_user->hasFlash('notice')): ?>  
  <div class="notice"><?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?></div>
<?php elseif($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo __($sf_user->getFlash('error'), array(), 'sf_admin') ?></div>
<?php elseif($sf_user->hasAttribute('notice_message') && $sf_user->getAttribute('notice_message') != '' && $sf_user->getAttribute('notice_message') != null): ?>
  <div class="notice"><?php echo __($sf_user->getAttribute('notice_message'), array(), 'sf_admin') ?></div>
<?php endif; ?>

<?php $sf_user->setAttribute('notice_message', '');?>
