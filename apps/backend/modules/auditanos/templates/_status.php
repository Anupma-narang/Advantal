
<?php
$image_array = array(1 => '/images/check_red.gif',
    2 => '/images/check_blue.gif',
    3 => '/images/check_green.gif');
?>
<img src="<?php echo $image_array[$auditanos->getStatus()]; ?>" />