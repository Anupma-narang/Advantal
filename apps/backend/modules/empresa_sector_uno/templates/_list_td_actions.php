<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_show">
      <a href="/backend.php/empresa_sector_uno/<?php echo $empresa_sector_uno->getId() ?>">Ver</a>
    </li>
    <li class="sf_admin_action_edit">
      <a href="/backend.php/empresa_sector_uno/<?php echo $empresa_sector_uno->getId() ?>/edit">Editar</a>
    </li>
    <li class="sf_admin_action_delete">
      <a onclick="if (confirm('¿Estás seguro?')) { var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'post'; f.action = this.href;var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', 'sf_method'); m.setAttribute('value', 'delete'); f.appendChild(m);var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', '_csrf_token'); m.setAttribute('value', 'c114d9e5ef64ae6f771f45bb004cd875'); f.appendChild(m);f.submit(); };return false;" href="/backend.php/empresa_sector_uno/<?php echo $empresa_sector_uno->getId() ?>">Borrar</a>
    </li>
  </ul>
</td>

<script language="javascript">
  $('ul.sf_admin_td_actions li').css({"display":"block"});
</script>