<?php
/*
 * @package    
 * @subpackage 
 * @author     	Francisco López Losada 
 * @version     
 * @date			01/12/2009
  Este programa es software libre. Puede redistribuirlo y/o modificarlo bajo los términos de la Licencia
  Pública General de GNU según es publicada por la Free Software Foundation, bien de la versión 3 de dicha
  Licencia o bien (según su elección) de cualquier versión posterior.

  Este programa se distribuye con la esperanza de que sea útil, pero SIN NINGUNA GARANTÍA, incluso sin la
  garantía MERCANTIL implícita o sin garantizar la CONVENIENCIA PARA UN PROPÓSITO PARTICULAR. Véase la
  Licencia Pública General de GNU para más detalles.

  Debería haber recibido una copia de la Licencia Pública General junto con este programa. Si no ha sido así,
  escriba a la Free Software Foundation, Inc., en 675 Mass Ave, Cambridge, MA 02139, EEUU.

  La licencia se encuentra en el archivo licencia.txt

 */
?>

<div id='nav'>
    <ul class=mainMenu>
        <li [?php if(sfContext::getInstance()->getModuleName()=="home"):?]class='active'[?php endif;?]>[?php echo link_to("Portada","home/index",array("class"=>"mainLink"))?]</li>	
        <li [?php if(sfContext::getInstance()->getModuleName()=="Concurso"):?]class='active'[?php endif;?]>[?php echo link_to("Concursos","concurso/index",array("class"=>"mainLink"))?]
            <ul>
                <li>[?php echo link_to("concurso_categoria","concurso_categoria/index",array("class"=>"mainLink"))?]</li>
                <li>[?php echo link_to("concurso_estado","concurso_estado/index",array("class"=>"mainLink"))?]</li>
                <li>[?php echo link_to("concurso_historico","concurso_historico/index",array("class"=>"mainLink"))?]</li>
                <li>[?php echo link_to("concurso_referendum","concurso_referendum/index",array("class"=>"mainLink"))?]</li>
                <li>[?php echo link_to("concurso_revision","concurso_revision/index",array("class"=>"mainLink"))?]</li>
                <li>[?php echo link_to("concurso_tipo","concurso_tipo/index",array("class"=>"mainLink"))?]</li>
                <li>[?php echo link_to("cuestionario","cuestionario/index",array("class"=>"mainLink"))?]</li>
                <li>[?php echo link_to("medallero","medallero/new",array("class"=>"mainLink"))?]</li>
            </ul>
        </li> <!-- CONTRIBUCIONES-->
        <li [?php if(sfContext::getInstance()->getModuleName()=="Contribuciones"):?]class='active'[?php endif;?]>[?php echo link_to("Contribuciones","contribucion/index",array("class"=>"mainLink"))?]
            <ul>
                <li>[?php echo link_to("Contribucion_estado","contribucion_estado/index",array("class"=>"mainLink"))?]</li>
            </ul>
        </li>

        <li [?php if(sfContext::getInstance()->getModuleName()=="empresa"):?]class='active'[?php endif;?]>[?php echo link_to("Empresas","empresa/index",array("class"=>"mainLink"))?]
            <ul>
                <li>[?php echo link_to("Productos","producto/index",array("class"=>"mainLink"))?] </li>
            </ul>
        </li>


        <li [?php if(sfContext::getInstance()->getModuleName()=="Mesa Redonda"):?]class='active'[?php endif;?]>[?php echo link_to("Mesa Redonda","mesa_redonda/index",array("class"=>"mainLink"))?]
            <ul>
                <li> [?php echo link_to("Categoria Mesa Redonda","mesaredonda_categoria/index",array("class"=>"mainLink"))?]</li>        
                <li> [?php echo link_to("Estados Mesa Redonda","mesaredonda_estado/index",array("class"=>"mainLink"))?]</li>        
                <li> [?php echo link_to("Ponencias Mesa Redonda","mesaredonda_ponencia/index",array("class"=>"mainLink"))?]</li>        
                <li> [?php echo link_to("Referendums Mesa Redonda","mesaredonda_referendum/index",array("class"=>"mainLink"))?]</li>        
            </ul>
        </li>
        <!--Buenos profesionales-->


        </li>

        <li [?php if(sfContext::getInstance()->getModuleName()=="sfGuardUser"):?]class='active'[?php endif;?]>[?php echo link_to("Usuarios","sfGuardUser/index",array("class"=>"mainLink"))?]
            <ul>
                <li>[?php echo link_to("Grupos","sfGuardGroup/index",array("class"=>"mainLink"))?]</li>
                <li>[?php echo link_to("Credenciales","sfGuardPermission/index",array("class"=>"mainLink"))?]</li>
            </ul>
        </li>
        <li [?php if(sfContext::getInstance()->getModuleName()=="fichero"):?]class='active'[?php endif;?]>[?php echo link_to("Ficheros","fichero/index",array("class"=>"mainLink"))?]</li>        
        <li [?php if(sfContext::getInstance()->getModuleName()=="road_type"):?]class='active'[?php endif;?]>[?php echo link_to("Tipo Via","road_type/index",array("class"=>"mainLink"))?]    
            <ul>
                <li>[?php echo link_to("Provincias","states/index",array("class"=>"mainLink"))?]</li>
                <li>[?php echo link_to("Profesionales I","profesional_tipo_uno/index",array("class"=>"mainLink"))?]
                <li>[?php echo link_to("Profesionales Nivel II","profesional_tipo_dos/index",array("class"=>"mainLink"))?]</li>        
                <li>[?php echo link_to("Profesionales Nivel III","profesional_tipo_tres/index",array("class"=>"mainLink"))?]</li> 
                <li>[?php echo link_to("Empresa Nivel 1","empresa_sector_uno/index",array("class"=>"mainLink"))?]</li>
                <li>[?php echo link_to("Empresa Nivel 2","empresa_sector_dos/index",array("class"=>"mainLink"))?]</li>        
                <li>[?php echo link_to("Empresa Nivel 3","empresa_sector_tres/index",array("class"=>"mainLink"))?]</li>
                <li>[?php echo link_to("Productos Nivel 1","producto_tipo_uno/index",array("class"=>"mainLink"))?]</li>
                <li>[?php echo link_to("Productos Nivel 2","producto_tipo_dos/index",array("class"=>"mainLink"))?]</li>        
                <li>[?php echo link_to("Productos Nivel 3","producto_tipo_tres/index",array("class"=>"mainLink"))?]</li>  
            </ul>
        </li>
        <li>[?php echo link_to("Logout","logout/index")?]</li>
    </ul>
    <h1 class=panel>Panel de Administración</h1>
</div>
