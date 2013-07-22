<div id="content_concursos_arriba">BUSCAR UN CONCURSO</div>
<div id="content_concursos_buscador">
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php echo link_to("Empresa / Entidad", "concurso/index?tipo=empresa&advanced=".$advanced, array("class"=>$tipo=="producto" ? '':'active')) ?>
        </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">
             <?php echo link_to("Productos", "concurso/index?tipo=producto&advanced=".$advanced, array("class"=>$tipo=="producto" ? 'active':'')) ?> 
        </span>
    </div>

    
    <div id="buscador_content"> 
        <div id="buscador_hea"></div>    
        <div id="buscador_body">
<?php if (count($sf_user->getAttributeHolder()->getAll("concurso_filters"))):?>
    <span class=filter_title><?php echo "Filtros aplicados"?></span>
    <ul class=filter_list>
        <?php foreach ($filters as $filter=>$label):?>
        	<?php if ($sf_user->hasAttribute($filter, 'concurso_filters')):?>
        		<?php if ($filter=="sfGuardUser"||$filter=="sfGuardUser_p"):?>
        		<li><?php echo $label?> : <em><?php echo ${"selected_$filter"}->username?></em>
        		<?php else:?>
        		<li><?php echo $label?> : <em><?php echo ${"selected_$filter"}->name?></em>
        		<?php endif;?>
        		<?php echo link_to(image_tag("delete.png",array("class"=>"delete_filter")),
            	   "concurso/index?tipo=$tipo&remove_filter=".$filter."&advanced=".$advanced,
            	    array("title"=>"Quitar Filtro ".$label))?>
        		</li>
        	<?php endif;?>
        <?php endforeach;?>
    	<?php if ($sf_user->hasAttribute("sort", 'article_filters')):?>
    		<li><?php echo "Orden"?> : <em><?php echo $sortLabel[$sf_user->getAttribute("sort",null,"article_filters")]?></em>
        		<?php echo link_to(image_tag("delete.png",array("class"=>"delete_filter")),
            	   "article/index?remove_filter=sort",
            	    array("title"=>"Quitar Filtro Orden"))?>
        		</li>
    	<?php endif;?>
    </ul>
<?php endif;?>
<?php if (count($sf_user->getAttributeHolder()->getAll("concurso_filters"))<count($filters)):?>
    <?php foreach ($filters as $filter=>$label):?>
        <?php if (!$sf_user->hasAttribute($filter, 'concurso_filters')):?>
        	<?php if ($filter=="Empresa"||$filter=="Producto"):?>
        		<form id="<?php echo $filter?>_form" method="post" action="<?php echo url_for('concurso/index?isForm='.$filter."&tipo=".$tipo."&advanced=".$advanced)?>">	
        	        <?php echo $form;?>
        	        <input type=submit value="Buscar"/>
        	    </form>
        	<?php elseif ($filter=="sfGuardUser"):?>
        		<form id="<?php echo $filter?>_form" method="post" action="<?php echo url_for('concurso/index?isForm='.$filter."&tipo=".$tipo."&advanced=".$advanced)?>">	
        	        <?php echo $form_user;?>
        	        <input type=submit value="Buscar"/>
        	    </form>   
        	<?php elseif ($filter=="sfGuardUser_p"):?>
        		<form id="<?php echo $filter?>_form" method="post" action="<?php echo url_for('concurso/index?isForm='.$filter."&tipo=".$tipo."&advanced=".$advanced)?>">	
        	        <?php echo $form_user_p;?>
        	        <input type=submit value="Buscar"/>
        	    </form>  
			<?php elseif ($filter=="City"):?>
        		<form id="<?php echo $filter?>_form" method="post" action="<?php echo url_for('concurso/index?isForm='.$filter."&tipo=".$tipo."&advanced=".$advanced)?>">	
        	        <?php echo $form_user_c;?>
        	        <input type=submit value="Buscar"/>
        	    </form>          	          	
        	<?php else:?>
        		<span class="filter_label"><?php echo ${$filter}->getLabel()?></span>
        		<?php //echo $filter?>
        	    <?php echo ${$filter}->render($filter,"&",ESC_RAW)?>
        	<?php endif;?>   	
    	<?php endif;?>
    <?php endforeach;?>
<?php endif;?>
<?php if (count($sf_user->getAttributeHolder()->getAll("concurso_filters"))):?>
                     
<span class="filter_label">
    <?php echo link_to("Borrar filtros","concurso/index?reset=true&advanced=".$advanced)?>
</span>
                    <?php endif;?>
<p class=clear><?php if ($advanced=="falso"):?>
<?php echo link_to("Búsqueda avanzada","concurso/index?advanced=verdadero&tipo=".$tipo)?>
<?php elseif ($advanced=="verdadero"):?>
<?php echo link_to("Buscador normal","concurso/index?advanced=falso&tipo=".$tipo)?>
<?php endif;?></p>
</div> <!-- Fin buscador content-->
<!--<div id="borra"></div>-->
 <div id="buscador_bot"></div>  
    </div> 
    
    
</div>
<?php if ($tipo=="empresa"):?>
    <script type="text/javascript"> advanced="<?php echo $advanced?>";	
    //<![CDATA[
    
    $('.filter_select').change(function() {
        
    	window.location='concurso?concurso_filters='+$(this).attr("name")+'&value='+$(this).attr("value")+'&tipo=empresa&advanced='+advanced;  
    });
    $('#autocomplete_filter_empresa_id').change(function() {	
    	$("#Empresa_form").submit();
    });
    //]]>
    </script>
<?php elseif($tipo=="producto"):?>
    <script type="text/javascript">
    //<![CDATA[
    $('.filter_select').change(function() {	
    	window.location='concurso?concurso_filters='+$(this).attr("name")+'&value='+$(this).attr("value")+'&tipo=producto&advanced='+advanced;  
    });

    $('#autocomplete_filter_producto_id').change(function() {	
    	$("#Producto_form").submit();
    });
    //]]>
    </script>
<?php endif;?>

