
<div style="text-align:center" class="p-top">
  <?php echo image_tag('/images/img/logo-auditoscopia.png') ?>
</div>

<?php include_partial('sfAdminDash/login', array('form' => $form)); ?>     

<script type="text/javascript">

  $('document').ready(function(){
    if('<?php echo $user_block_limit ?>' >= 5){
      alert("<?php echo 'No tienes autorización para acceder a este sistema.'?>\n\n" + "<?php echo 'Muchas gracias por tu colaboración.'?>"  );
    }
  });
</script>