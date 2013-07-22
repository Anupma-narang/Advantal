<?php $parametros = ''; ?>
<?php if (count($params) > 0): ?>
  <?php foreach($params as $key => $value): ?>
    <?php $parametros .= "&$key=$value" ?>
  <?php endforeach; ?>
  <?php $parametros .= '&'; ?>
  <?php $parametros[0] = "?"; ?>
<?php else: ?>
  <?php $parametros = "?"; ?>
<?php endif; ?>


<div class="pagination">
  <ul>
    <!--<li class="pag_primera">-->
    <!--  <a href="<?php //echo url_for($ruta) . $parametros ?>page=1"><<</a>-->
    <!--</li>-->
    <li class="prev">
      <a href="<?php echo url_for($ruta) . $parametros ?>page=<?php echo $pager->getPreviousPage() ?>"><</a>
    </li>
    
    <?php if ($pager->getFirstPage() - $pager->getCurrentMaxLink() > 0): ?>
        <li class="pagina">
          <a href="#">...</a>
        </li>    
    <?php endif; ?>
    
    <?php foreach ($pager->getLinks(6) as $key => $page): ?>
      <?php if ($page > 1 && $key == 0): ?>
        <li class="pagina_mas">
          <a href="#">...</a>
        </li>    
      <?php endif; ?>    
      <?php if ($page == $pager->getPage()): ?>
        <li class="active">
          <a href="#"><?php echo $page ?></a>
        </li>
      <?php else: ?>
        <li class="pagina">
          <a href="<?php echo url_for($ruta) . $parametros ?>page=<?php echo $page ?>"><?php echo $page ?></a>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>
    
    <?php if ($pager->getLastPage() - $pager->getCurrentMaxLink() > 0): ?>
        <li class="pagina_mas">
          <a href="#">...</a>
        </li>    
    <?php endif; ?>
    

    <li class="">
      <a href="<?php echo url_for($ruta) . $parametros ?>page=<?php echo $pager->getNextPage() ?>">></a>
    </li>
    <!--<li class="next">-->
    <!--  <a href="<?php //echo url_for($ruta) . $parametros ?>page=<?php echo $pager->getLastPage() ?>">>></a>-->
    <!--</li>-->
  </ul>
</div>
