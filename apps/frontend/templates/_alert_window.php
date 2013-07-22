<?php if ($sf_user->hasFlash('notice') || $sf_user->hasFlash('error')) : ?>
<div id='alert'>
    <?php if ($sf_user->hasFlash('notice')): ?>
        <div class="flash_close" title="cierra este mensaje"></div>
        <div class="flash_notice">
            <?php echo $sf_user->getFlash('notice', ESC_RAW) ?>
        </div>
    <?php endif; ?>

    <?php if ($sf_user->hasFlash('error')): ?>
    <div class="flash_close" title="cierra este mensaje"></div>
    <div class="flash_notice">
        <?php echo $sf_user->getFlash('error', ESC_RAW) ?>
    </div>
    <?php endif; ?>
</div>
<?php endif ?>

<?php // TODO enviar este js a algún lugar genérico. Preguntar a Vincente donde ponerlo ?>
<script type='text/javascript'>
    $(function() {
       $('.flash_close').click(function() {
           $('#alert').hide('slow');
       })
    });

</script>