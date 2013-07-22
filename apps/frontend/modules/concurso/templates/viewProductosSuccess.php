<table>
<?php foreach ($productos as $producto): ?>
<tr>
    <td valign="top"><?php print $producto->getName() ?></td>
    <td valign="top"><?php print $producto->getProductoTipoUno()->getName() ?>(<?php print $producto->getProductoTipoUnoId() ?>)</td>
    <td valign="top"><?php print $producto->getProductoTipoDos()->getName() ?>(<?php print $producto->getProductoTipoDosId() ?>)</td>
    <td valign="top"><?php print $producto->getProductoTipoTres()->getName() ?>(<?php print $producto->getProductoTipoTresId() ?>)</td>
</tr>
<?php endforeach; ?>
</table>