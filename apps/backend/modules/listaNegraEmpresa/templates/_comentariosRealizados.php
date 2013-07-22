<?php
$user_id = sfContext::getInstance()->getUser()->getGuardUser()->getId();
echo $empresa->getCountComments($user_id); 
?>
