<?php
$user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
echo $producto->getCountComments($user_id); 
?>
