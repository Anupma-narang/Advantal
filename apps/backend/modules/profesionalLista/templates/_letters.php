<li class="empresa_audit">
    <span class="empresa_number">
        <span style="float: left; padding: <?php echo ($c >= 1 && $c >= 10) ? '1px 0 0 0;' : '1px 0 0 7px;' ?>"><?php echo $c; ?></span>)
    </span>
    <span class="empresa_title">
        <?php echo link_to($record->getName(), 'cartas_pendientes/show?id='.$record->getId(), array()) ?>
    </span>
    <span class="empresa_user_name">
         <?php echo link_to($record->getUser(), 'sfguarduser/List_ver?id=' . $record->getUserId(), array()) ?>
    </span>
    <span class="empresa_date">
        <?php echo $record->getDateTimeObject('created_at')->format('d/m/Y'); ?>
    </span>
</li>