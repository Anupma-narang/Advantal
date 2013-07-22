<?php
  $concurso = $contribucion->getConcurso();
  $url = sprintf('http://%s/concurso/showPlanDeAccion/nombre/%s/slug/%s/date/%s/time/%s/id/%s',
    $_SERVER['HTTP_HOST'], $concurso->getProducto_or_Empresa_NameSlug(), $concurso->getSlug(),
    $concurso->getDateTimeObject('created_at')->format('d-m-Y'), $concurso->getDateTimeObject('created_at')->format('H-i-s'),
    $contribucion->getNumero());
?>

<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_show">
      <?php //print link_to('Ver', $url, array('popup' => array('popupWindow', 'width=650,height=500,scrollbars=1,left=200,top=0'))) ?>
        <a href="/backend.php/planes_de_accion_producto/<?php echo $contribucion->getId() ?>/show">Ver</a>  
    </li>
    <li class="sf_admin_action_edit">
      <a href="/backend.php/planes_de_accion_producto/<?php echo $contribucion->getId() ?>/edit">Editar</a>
    </li>
    <li class="sf_admin_action_delete">
      <a onclick="if (confirm('¿Estás seguro?')) { var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'post'; f.action = this.href;var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', 'sf_method'); m.setAttribute('value', 'delete'); f.appendChild(m);var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', '_csrf_token'); m.setAttribute('value', '6f2606b5ec4116b982ba4f1127834f19'); f.appendChild(m);f.submit(); };return false;" href="/backend.php/planes_de_accion_producto/<?php echo $contribucion->getId() ?>">Borrar</a>
    </li>
  </ul>
</td>

<script language="javascript">
  $('ul.sf_admin_td_actions li').css({"display":"block"});
</script>