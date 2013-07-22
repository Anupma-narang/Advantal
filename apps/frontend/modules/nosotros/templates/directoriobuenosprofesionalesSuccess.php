<div id="content_breadcroum">
    <?php echo link_to("Inicio","home/index") ?> >> 
</div>

<div id="content_nosotros_comofuncionamos">

        <h1>Cómo funciona el Directorio de buenos profesionales</h1>

    <div id="content_nosotros_comofuncionamos_uno">     
        
        <div id="content_nosotros_comofuncionamos_uno_a">
            <p>&nbsp;</p>
            <span class="subtitle"><?php echo link_to("¿Lo que hay que saber antes de auditar a un profesional?","nosotros/directoriobuenosprofesionales?page=1")?></span><br/>
            <span class="subtitle"><?php echo link_to("¿Funcionamiento del Directorio en detalle?","nosotros/directoriobuenosprofesionales?page=2")?></span><br/>
        </div>
        
    
        <div id="content_nosotros_comofuncionamos_uno_a_img">
           
            <?php echo image_tag("img/static/".sfContext::getInstance()->getActionName()."_img0_lateral.jpg")?>     
    </div>
</div>
   <div id="conten_overflow_directoriobuenosprofesionales"> 
   <?php if($page==1): ?>
        <div id="parrafo"><h2>¿Qué es el Directorio de buenos profesionales?</h2>  <div id="forma_hea"></div><div id="forma_body"> <div id="alinea">
                    <ul><li>
 El Directorio de buenos profesionales consiste en una <strong>guía de profesionales</strong> de diferentes actividades que <strong>sus clientes recomiendan por sus buenas prácticas y excelencia</strong> en el servicio.                       </li><li>
Estos profesionales están recomendados porque se ajustan a las necesidades y expectativas de sus usuarios y les producen una <span class="link_rojo">experiencia de cliente plenamente satisfactoria</span> (link a ¿Qué es una experiencia de cliente satisfactoria?), única e irrepetible.                        </li></ul>       
                </div></div> <div id="forma_bot"></div></div>
     
     <div id="parrafo"> <h2>¿Qué objetivos persigue el Directorio?</h2> <div id="forma_hea"></div><div id="forma_body"> <div id="alinea">
                 <ul><li>
  <strong>Hacer público</strong> los profesionales de diversos sectores que <strong>destacan por su excelencia</strong> y buenas prácticas, con el fin de servir de referencia a otros consumidores.
                     </li><li><strong>Crear un mecanismo de seguimiento y auditoría</strong> continua que asegure a los usuarios y al profesional la excelencia alcanzada y permita corregir desviaciones de forma dinámica.
                     </li></ul>
             </div></div> <div id="forma_bot"></div></div>
                 

     <div id="parrafo"> <h2>¿Cómo se valora a un profesional?</h2> <div id="forma_hea"></div><div id="forma_body"> <div id="alinea">
                 <ul><li>   
                         Un profesional puede ser <span class="link_rojo">recomendado</span> (link a ¿Cómo recomendar a un buen profesional?) o <span class="link_rojo">desaprobado</span> (link a ¿Cómo desaprobar a un profesional?) mediante un sistema de cartas de recomendación (link a ¿Qué es una carta de recomendación?) y cartas de desaprobación (link a ¿Qué es una carta de desaprobación?) en relación al servicio que presta a sus clientes.
                     </li><li>
Los criterios para la valoración positiva o negativa son <strong>aspectos relevantes para el propio usuario</strong> (conocimientos profesionales, atención proporcionada, trato ofrecido, etc.).
</li><li>
Para recomendar a un profesional <strong>no es necesario que esté publicado en el Directorio</strong>, puede ser propuesto por cualquier colaborador. 
</li><li>
Para poder desaprobar a un profesional <strong>si es necesario que esté publicado previamente en el Directorio</strong>. En caso contrario no es posible.
</li><li>
Cada recomendación o desaprobación de un profesional está <strong>recompensada con puntos canjeables por regalos</strong>, según el modelo y condiciones establecidas en nuestro <span class="link_rojo"><?php echo link_to("sistema de puntos y Jerarquías","nosotros/jerarquias") ?></span>.             
 </li></ul>            </div></div> <div id="forma_bot"></div></div>
 
   
   
    <div id="parrafo"> <h2>¿Cómo puedes participar en  la valoración de un profesional?</h2> <div id="forma_hea"></div><div id="forma_body"> <div id="alinea">
                <ul><li>
                Puedes <strong>auditar</strong> (valorar positiva o negativamente) a un mismo profesional hasta un <strong>máximo de 4 veces por temporada</strong>, con un intervalo entre valoración de al menos 30 días. Las valoraciones pueden ser todas positivas, todas negativas o una mezcla de ambas.
                    </li><li>
Puedes <strong>auditar a tantos profesionales como desees</strong> y por todos ganas puntos.
                    </li><li>
A efectos de tener en cuenta la valoración final positiva o negativa de un profesional tenemos en cuenta tu <strong>última valoración</strong>, al ser la más reciente y la que mejor indica su situación en ese momento. No obstante todas las valoraciones son importantes y necesarias para analizar su evolución y proponer mejoras.
                    </li></ul>   </div></div> <div id="forma_bot"></div></div>
     
         <div id="parrafo"> <h2>¿Cómo funciona el Directorio?</h2> <div id="forma_hea"></div><div id="forma_body"> <div id="alinea">
                     <ul><li>
                 Cuando un profesional es recomendado por primera vez lo <strong>publicamos en el Directorio de manera temporal</strong> durante un periodo de 3 meses.
                         </li><li>
Trascurrido este tiempo, si la proporción de valoraciones positivas recibida es superior a las negativas en <strong>proporción de 3 a 1</strong> le proponemos la posibilidad de formar parte del Directorio de manera permanente suscribiéndose al servicio <span class="azulon">Buen Profesional</span>.
                         </li><li>
Si el profesional no desea permanecer en el Directorio, <strong>es retirado</strong> sin más consecuencias.
                         </li></ul>                 </div></div> <div id="forma_bot"></div></div>
     
     

   
   
   
   
   
   
   
   
   
   
   </div>
   <?php elseif($page==2): ?>
                 <div id="parrafo"> <h2>1) Recomendación de un profesional aún no publicado</h2> <div id="forma_hea"></div><div id="forma_body"> <div id="alinea">
                             <ul><li>
     Un usuario desea recomendar a un profesional independiente o empleado en una empresa o entidad pública que le ha prestado un servicio excelente y que no está publicado en el Directorio.
                                 </li><li>
El usuario entra en Recomienda un profesional y rellena una carta de recomendación (link a ¿Qué es una carta de recomendación?) de manera anónima. Se identifica sólo con un alias que previamente ha dado de alta como colaborador (link a Por que crear una cuenta) de la comunidad de auditoscopia.  
</li><li>
La carta de recomendación incluye obligatoriamente una descripción de los motivos por los cuales ha recomendado al profesional. 
</li><li>
El colaborador da de alta en el Directorio al profesional rellenando sus datos de identificación y contacto. Esta acción solamente es necesaria la primera vez que se recomienda a un profesional.
</li></ul>                         
                         </div></div> <div id="forma_bot"></div></div>
        
        <div id="parrafo"> <h2>2) Recomendación de un profesional ya publicado</h2> <div id="forma_hea"></div><div id="forma_body"> <div id="alinea">                 
 <ul><li>       
Un colaborador entra en el Directorio y localiza a un buen profesional que desea recomendar porque le ha prestado un servicio excelente.
</li><li>
Hace clic en la función recomienda y rellena una carta de recomendación con los motivos por los cuales ha recomendado al profesional.         
 </li></ul>           </div></div> <div id="forma_bot"></div></div> 
            
            
               <div id="parrafo"> <h2>3) Desaprobación de un profesional</h2> <div id="forma_hea"></div><div id="forma_body"> <div id="alinea">                 
   <ul><li>
                           Un colaborador desea valorar negativamente o desaprobar a un profesional independiente o empleado de una empresa o entidad pública que le ha prestado un servicio insatisfactorio.
</li><li>
El colaborador entra en el Directorio, hace clic en la función desaprueba y rellena una carta de desaprobación (link a ¿Qué es una carta de desaprobación?) con los motivos por los cuáles desaprueba al profesional.
</li><li>
Su carta de desaprobación incluye obligatoriamente una propuesta de mejora con recomendaciones para mejorar el servicio insatisfactorio. 
 </li></ul>    </div></div> <div id="forma_bot"></div></div>


    <?php endif; ?>

<!--</div> fin content_comofuncionamos-->
</div>