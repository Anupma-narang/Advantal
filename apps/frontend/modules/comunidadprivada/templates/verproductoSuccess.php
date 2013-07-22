
<table width="400"> 
    <tr><td colspan="2" align="center"></td></tr>
    <tr><td width="250"><?php echo "Nombre: ". $producto->name ?></td><td width="250">Si no encuentras el producto que buscas.!!</td></tr>
    <tr><td width="250"><?php echo "Marca: ".$producto->Marca ?></td><td width="250"> Crea uno ..</td></tr>
    <tr><td width="250"><?php echo "Modelo: ".$producto->Modelo ?></td>
        <td width="250"> 
            <span class="concurso_link_no">
                <?php echo link_to("nuevo", "producto/new") ?>
            </span>
        </td>
    </tr>
</table>