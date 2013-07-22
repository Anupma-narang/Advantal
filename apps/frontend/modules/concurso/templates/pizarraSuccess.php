<?php if($pizarra) { ?>

<li id="pizarra-<?php echo $num; ?>" speed="10" class="elem" objid="<?php echo $pizarra->id; ?>">
    <div class="name"><?php echo $pizarra->name; ?></div>
    <div class="text"><p><?php echo $pizarra->text; ?></p></div>
</li>

<?php } ?>
