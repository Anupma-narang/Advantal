<div id="content_breadcroum">
    <?php echo link_to("Inicio","home/index") ?> >> 
<!--    <a href="#"> Condiciones</a>-->
</div>


<div id="content_nosotros_empresa">
    <h1>Si eres una empresa o entidad</h1>  
<!--    <p> &nbsp;</p>-->
<!--    <h2 class="linea">Auditamos y mejoramos tu experiencia de cliente con tus ideas</h2>-->
   
  <div id="content_nosotros_empresa_uno">
   
    <div id="content_nosotros_empresa_uno_a">
    Si eres una empresa, una entidad pública o un fabricante y deseas que tus productos o 
    servicios se <strong>ajusten perfectamente a las necesidades y expectativas de tus clientes…</strong><br>
    Si necesitas reforzar tu capacidad para <strong> producir a tus usuarios una experiencia de cliente 
plenamente satisfactoria</strong>, única e irrepetible…<br>
No dudes en contactar con nosotros para que <strong>te ayudemos a mejorar y alcanzar los siguientes objetivos:</strong>
    </div>
      
      <div id="content_nosotros_empresa_uno_a_img">
        <?php echo image_tag("img/static/empresa_img0_lateral.jpg")?>     
        </div>  
     </div>
<!--    <h2 class="linea">Si contribuyes con ideas, ganas recompensas</h2>-->
    <div id="content_nosotros_empresa_dos">
<p>Nuestro formulario
</p>       
    
    </div>

<div id="content_nosotros_empresa_seis">
    <form action="<?php echo url_for('contacto/enviar') ?>" method="POST">
       <table align="left">
           <?php echo $formulario?>
           <tr>
               <td><input type="submit" /></td>
           </tr>
           
           
           
       </table>
   
   
   
   
   
   
   </form>
</div>
<!--    <h2>¿Qué beneficios consigues al contribuir con <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>?</h2>    -->
<!--    <div id="content_nosotros_quienes_tres">        
          <div id="nosotros_texto_tres_uno">Mejoras tu <br />
            experiencia de cliente<br />
            y la de otros. </div>
          <div id="nosotros_texto_tres_dos">Mejoras en el lugar<br />
            que vives</div>
          <div id="nosotros_texto_tres_tres">Ganas dinero <br />
            y regalos.</div>
          <div id="nosotros_texto_tres_cuatro">Mejoras tu<br />
            servicio, producto <br />
            o profesional favorito</div>
    </div>-->
 
 
<!--    <div id="content_nosotros_empresa_cuatro"><br />
        Esta es <strong>nuestra misión</strong>:
        <p> Promover la participación de los consumidores en la definición y mejora de productos y servicios hasta la Excelencia, capaces de responder a sus necesidades y producirles una experiencia de cliente plenamente satisfactoria, a la vez que favorecer la redistribución justa del beneficio generado por su contribución. </p>
    </div>-->
<!--    <div id="content_nosotros_empresa_cinco"> 
       

<p>
¡Muchas gracias por tu confianza!    
</p>

</div>-->
      
 </div> <!-- content_nosotros_quienes -->