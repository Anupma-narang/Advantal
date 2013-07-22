<?php $permissions = $administration_emails->getUser() ? $administration_emails->getUser()->getPermissions() : '' ?>
<?php echo count($permissions) ? $permissions[0]: ''?>