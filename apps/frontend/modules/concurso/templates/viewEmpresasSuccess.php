<table>
<?php foreach ($empresas as $empresa): ?>
<tr>
    <td valign="top"><?php print $empresa->getName() ?></td>
    <td valign="top"><?php print $empresa->getEmpresaSectorUno()->getName() ?>(<?php print $empresa->getEmpresaSectorUnoId() ?>)</td>
    <td valign="top"><?php print $empresa->getEmpresaSectorDos()->getName() ?>(<?php print $empresa->getEmpresaSectorDosId() ?>)</td>
    <td valign="top"><?php print $empresa->getEmpresaSectorTres()->getName() ?>(<?php print $empresa->getEmpresaSectorTresId() ?>)</td>
</tr>
<?php endforeach; ?>
</table>