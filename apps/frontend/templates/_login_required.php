<?php if (!$sf_user->isAuthenticated()) : ?>

<?php use_stylesheet('fancybox/jquery.fancybox.css'); ?>
<div style="display: none">
    <div id="login_required_box">
        <div class="border-box"><div class="top-left"><div class="top-right">
            <p>[title]</p>
            <ul class="bundle">
                <li><a href="[href]">ya soy colaborador</a></li>
                <li>¿Aún no eres colaborador? ¡<?php echo link_to('Crea una cuenta','@apply')?> ahora!</li>
            </ul><br/>
        </div>
    </div><div class="bottom-left"><div class="bottom-right"></div></div></div></div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $("a.login_required").each(function(){
        $(this).fancybox({
            beforeLoad : function() {
              msg=$(this.element).attr("message");
              if(typeof msg == "undefined") msg="<?php print (isset($msg) and !empty($msg))?html_entity_decode($msg):''?>";
              this.content = $("#login_required_box").html().replace("[title]", msg).replace("[href]", "/guard/login?redirect="+encodeURI(this.href));
            }
        });
    });
});
</script>
<?php endif ?>