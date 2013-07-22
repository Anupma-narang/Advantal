
<table width="400"> 
    <tr><td colspan="2" align="center"></td></tr>
    <tr><td  width="200"><?php echo $empresa->name ?></td><td><?php //echo $empresa->State->name?></td></tr>
     <tr><td  width="200"><?php echo $empresa->direccion ?></td><td>Si no encuentras la empresa que buscas.!! Crea una </td></tr>
      <tr><td  width="200"><?php echo $empresa->localidad ?></td><td> <span class="concurso_link_no"> 
                <?php echo link_to("nueva", "empresa/new") ?>
            </span></td></tr>
</table> 


