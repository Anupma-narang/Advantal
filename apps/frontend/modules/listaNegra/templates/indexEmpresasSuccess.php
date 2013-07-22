<?php include_partial("listaBlanca/breadcrumb", array('sectoresActivos' => $sectoresActivos, 'lista' => '<strong>Lista negra de empresas y entidades</strong>')) ?>
<?php include_partial("listaNegra/headerlistas") ?>
<?php include_partial('global/alert_window'); ?>
<?php use_stylesheet('caja'); ?>
<!-- buscador -->
<?php include_partial('buscadorEmpresa', array('form' => $form)) ?>
<style type="text/css">
    .spanMsg{
        bottom: 0 !important;
        font-weight: bold !important;
        margin: -16px 0 0 !important;
        position: absolute !important;
        right: 0 !important;
        vertical-align: top !important;
    }
</style>
<!-- fin del buscador -->
<div id="content_laslistas_lista">
    <div class="menu-buscador" style="margin-top: 10px;">
        <a class="empresas-entidades-activa" href="#">Empresas/Entidades</a>
        <a class="productos" href="<?php echo url_for('lista_negra_producto') ?>">Productos</a>
        <div class="spanMsg"></div><div class="clear"></div>
    </div>
    <div class="content-top"></div>
    <div class="content-middle">
        <div id="content_laslistas_left">
            <?php include_component('listaBlanca', 'categoriaEmpresas', array('url' => 'lista_negra_empresa')); ?>
        </div>
        <div id="content_laslistas_left_shadow"></div>
        <div id="content_laslistas_right">
            <div class="top">
                <div class="order">
                    <?php include_partial('ordenaEmpresa', array('sortForm' => $sortForm)); ?>
                </div>
            </div>
            <div id="content-results" class="main">
                <div class="top"></div>
                <div class="middle">
                    <?php if (isset($empresa_sector_uno)): ?>
                        <div class="title">
                            <?php echo image_tag('/images/uploads/thumbnails/' . $empresa_sector_uno->getImage(), array('class' => 'miniatura-categoria')) ?>
                            <span><?php echo $empresa_sector_uno->getName() ?></span>
                        </div>
                    <?php endif ?>

                    <div id='resultados_empresas'>
                        <?php include_partial('resultadosEmpresa', array('pager' => $pager, 'ms_values' => $ms_values, 'sectoresActivos' => $sectoresActivos)); ?>

                    </div>
                    <?php include_partial('global/black_board', array('section' => 'LNE')) ?>
                </div>
                <div class="bottom"></div>

            </div>
            <div class="bottom"></div>
        </div>
    </div>

    <div class="content-bottom"></div>
</div>

<div class="hidden" id="user_messagebox">
  <div class="border-box-n">
    <div class="header-left"><div class="header-right"></div></div>
    <div class="top-left">
      <div class="top-right" id="user_message_content">
      </div>
    </div>
    <div class="bottom-left">
      <div class="bottom-right"></div>
    </div>
  </div>

</div>
<a href="#user_messagebox" class="hidden" id="user_message_ancor">message box</a>

<?php include_partial('global/login_required', array('msg' => "Para <strong>comentar</strong> necesitas ser colaborador.")); ?>



