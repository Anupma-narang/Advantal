<table width="400"> 
    <tr><td colspan="2" align="center"></td></tr>
    <tr><td width="250"><?php echo "Nombre:    ".$pdvar->name ?></td><td width="250">Si no encuentras el profesional que buscas.!!</td></tr>
    <tr><td width="250"><?php echo "Dirección: ".$pdvar->direccion ?></td><td width="250"> Crea uno ..</td></tr>
    <tr><td width="250"><?php echo "Localidad: ".$pdvar->localidad ?></td>
        <td width="250"> 
            <span class="concurso_link_no">
                <?php echo link_to("nuevo", "buenprofesional/new") ?>
            </span>
        </td>
    </tr>
</table>


