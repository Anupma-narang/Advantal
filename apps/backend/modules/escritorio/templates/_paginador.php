<?php if ($pager->haveToPaginate()): ?>
<div class="pagination" style="text-align:right">
    <a href='#page' rel='<?php echo $pager->getFirstPage()?>' title='Primera'><img
        src='/images/first.png'/></a>
    <a href='#page' rel='<?php echo $pager->getPreviousPage()?>' title='Anterior'><img
        src='/images/previous.png'/></a>

    <?php foreach ($pager->getLinks() as $page): ?>
    <a class='<?php echo $page == $pager->getPage() ? 'activo' : ''?>' href='#page'
       rel='<?php echo $page ?>'><?php echo $page ?></a>
    <?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif ?>

    <?php endforeach ?>

    <a href='#page' rel='<?php echo $pager->getNextPage()?>' title='Anterior'><img src='/images/next.png'/></a>
    <a href='#page' rel='<?php echo $pager->getLastPage()?>' title='Primera'><img src='/images/last.png'/></a>

</div>
<?php endif ?>

<script type='text/javascript'>
    $('.pagination a').live('click', function () {
        dragbox = $(this).closest('.dragbox');
        autoloadBox = $(this).closest('.autoload');
        autoloadBox.css('opacity','0.3');
        autoloadBox.load(dragbox.attr('rel'), { page :  $(this).attr('rel') }, function () {
            autoloadBox.animate({opacity:1}, 200);
        });

        return false;
    });
</script>
