<?php use_stylesheet('forms.css') ?>
<?php use_javascript('passwordStrengthMeter.js') ?>
<?php use_stylesheet('jquery.autocompleter.css') ?>
<?php use_stylesheet('caja.css') ?>
<?php use_javascript('fancybox/jquery.fancybox.pack.js') ?>
<?php use_stylesheet('fancybox/jquery.fancybox.css') ?>

<div id="contenido_home_uno">
    <div id="content_breadcroum"> 
        <?php echo link_to("Inicio", "home/index") ?>
    </div>
    <div id="contenido_home_uno_a"><div align="center" class="color_blanco_subtitulo"><?php echo __('Concurso de ideas destacadas'); ?></div>
    </div>
    <div id="contenido_home_uno_b">
    </div>
    <div id="contenido_home_uno_c">
        <div  align="left" class="color_blanco_subtitulo_uno"><span class="heading"><?php echo __('Concursos para mejorar empresas') ?></span>
            <div class="right">
                <span class="rss" title="Añade concursos de ideas de Empresa y Entidad a RSS"></span>
                <?php echo link_to('&nbsp;', '/concurso', array('title' => 'Ver todos los concursos de ideas de Empresa y Entidad', 'class' => 'bt_ver')); ?>
            </div>

        </div>
        <div class="r-con">
            <div class="con-c"><?php include_component('concurso', 'featuredContestList', array('contest_type' => 'company')) ?></div>
        </div>
    </div>
    <div id="contenido_home_uno_d">

        <div align="right" class="color_blanco_subtitulo_dos"><span class="heading"><?php echo __('Concursos para mejorar productos') ?></span>
            <div class="right">
                <span class="rss" title="Añade concursos de ideas de Producto a RSS"></span>

                <form class="s-view hidden" action="/concurso?tipo=producto" method="POST">
                    <input type="text" id="ConcursoProductoSearchForm_producto" name="ConcursoProductoSearchForm[producto]" maxlength="70" size="15" autocomplete="off">
                </form>
                <?php echo link_to('&nbsp;', '/concurso', array('title' => 'Ver todos los concursos de ideas de Producto', 'class' => 'bt_ver')); ?>
            </div>
        </div>
        <div class="l-con"><?php include_component('concurso', 'featuredContestList', array('contest_type' => 'product')) ?></div>

    </div>
</div>

<div id="contenido_home_tres">

    <div id="contenido_home_tres_b">
        <div id="contenido_home_tres_a">
            <span class="escaparate heading"><?php echo __('Escaparate de regalos') ?></span>
            <?php echo link_to('&nbsp;', url_for('gift_list'), array('title' => 'Ver todos los regalos en el Escaparate', 'class' => 'bt_ver')); ?>
            <div id="g-bl" class="block"></div>
        </div>

        <div class="bn-img"><?php echo image_tag("img_home/banner_audio.jpg") ?></div>


    </div>


</div>
<div id="contenido_home_cuatro">
    <div id="contenido_home_cuatro_a" >
        <div id="reward-blk">
            <span class="_c_subtitulo h-tl bd-l sview" title="Ranking de colaboradores por caja acumulada"><?php echo __('Ranking de recompensas'); ?></span>
            <span class="_c_subtitulo h-tl bd-r sview hidden" title="Ranking de colaboradores por puntos acumulados"><?php echo __('Ranking de colaboradores'); ?></span>

        </div>
        <div id="ul-p"></div>
    </div>
    <div id="contenido_home_cuatro_b">
        <div id="company-blk">
            <span class="_b_subtitulo h-tl bd-l sview" title="Destacado de empresas y entidades recomendadas"><?php echo __('Empresas recomendadas'); ?></span>
            <span class="_b_subtitulo h-tl bd-r sview hidden" title="Destacado de empresas y entidades no recomendadas"><?php echo __('Empresas no recomendadas'); ?></span>
            <span class="rss" title="Añade empresas y entidades recomendadas a RSS"></span>
        </div>

        <div id="e-p"></div>
    </div>
    <div id="contenido_home_cuatro_c">
        <div id="product-blk">
            <span class="_c_subtitulo h-tl bd-l sview" title="Destacado de productos recomendados"><?php echo __('Productos recomendados'); ?></span>
            <span class="_c_subtitulo h-tl bd-r sview hidden" title="Destacado de productos no recomendados"><?php echo __('Productos no recomendados'); ?></span>
            <span class="rss" title="Añade productos recomendados a RSS"></span>
        </div>

        <div id="p-p"></div>
    </div>
    <div id="contenido_home_cuatro_d">
        <div id="professional-blk">
            <span class="_d_subtitulo h-tl" title="Destacado de profesionales recomendados"><?php echo __('Profesionales recomendados'); ?> </span>
            <span class="rss" title="Añade profesionales recomendados a RSS"></span>
        </div>
        <div id="pr-p"></div>
    </div>

</div>
<div class="content pequeno hidden " id="user_login_box">
    <section class="border-box-n b-alert">
        <div class="header-left"><div class="header-right"></div></div>
        <div class="top-left">
            <div class="top-right">
                <p>Para <strong>ver esa información</strong> necesitas ser colaborador.</p>
                <ul class="bundle">
                    <li>
                        <a id="login-uri" href="/guard/login?redirect=<?php echo url_for('homepage') ?>"  title="ya soy colaborador">ya soy colaborador.</a></li>
                    <li>
                        ¿Aún no eres colaborador? ¡<a href="/registro" target="_blank" title="Crea una cuenta">Crea una cuenta</a> ahora!
                    </li>
                </ul>
                <br>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>
</div>

<a href="#user_login_box" class="hidden" id="user_login" onclick="$.fancybox.close();">message box</a>
<script type="text/javascript">
    var url_path = { 
        gift_records : '<?php echo url_for('featured_gifts') ?>',
        user_listing : '<?php echo url_for('featured_user_listing') ?>',
        company_listing: '<?php echo url_for('featured_comapny_list') ?>',
        product_listing: '<?php echo url_for('featured_product_list') ?>',
        professional_listing: '<?php echo url_for('featured_professional_list') ?>'
    };
    $(document).ready(function(){
        AjaxLoad('#g-bl',url_path.gift_records);
        AjaxLoad('#ul-p',url_path.user_listing);
        AjaxLoad('#e-p',url_path.company_listing);
        AjaxLoad('#p-p',url_path.product_listing);
        AjaxLoad('#pr-p',url_path.professional_listing);
    
    });
  
    function AjaxLoad(container, url_path){
        $.ajax({
            url: url_path,
            type: 'get',
            success:function(data){
                $(container).html(data);
            }
        });
    }
  
    function search(obj){
        //search box
    
        if($(obj).next().hasClass('hidden')){
        
            $(obj).next().removeClass('hidden')
        }else{
            $(obj).next().submit();
        }
    
    }
    function showList(parent, list_block){
        $('#' + parent).find('.list-f').addClass('hidden');
        $('#' + parent).find('.sview').addClass('hidden');
        $('#' + parent).find('.' + list_block).removeClass('hidden');
        $('#' + parent).find('.' + list_block + '-s').removeClass('hidden');
        $.ajax({
            url: '<?php echo url_for('list-session') ?>',
            data:{'session_name':parent, 'session_data': list_block},
            type: 'GET',
            success: function(data){
        
            }
        })
    }
</script>