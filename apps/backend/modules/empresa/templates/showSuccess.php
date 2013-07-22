<div id="sf_admin_container">
    <h1><?php echo __('Detalle de la Empresa/Entidad', array(), 'messages') ?></h1>
    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <ul class="dragbox-content">
                <?php if ($empresa->getCreatedAt() != '') : ?>
                    <li><strong>Fecha: </strong><?php echo $empresa->getFCreatedAt("d/m/Y"); ?></li>
                <?php endif ?>
                <li><strong>Empresa/Entidad: </strong><?php echo $empresa; ?></li>
                <?php if ($empresa->getRoadType()->getId()) : ?>
                    <li><strong>Tipo de vía: </strong><?php echo $empresa->getRoadType(); ?></li>
                <?php endif ?>
                <?php if ($empresa->getDireccionCompleta() != '') : ?>
                    <li><strong>Direccion: </strong><?php echo $empresa->getDireccionCompleta(); ?></li>
                <?php endif ?> 
                <?php if ($empresa->getStates()->getId()) : ?>
                    <li><strong>Provincia: </strong><?php echo $empresa->getStates(); ?></li>
                <?php endif ?>
                <li>
                    <strong>Localidad: </strong>
                    <?php if ($empresa->getStates() == 'Ceuta' || $empresa->getStates() == 'Melilla' || $empresa->getStates() == 'Toda España'): ?>
                        <?php echo $empresa->getStates(); ?>
                    <?php else: ?>
                        <?php echo $empresa->getMunicipioProvincia() ?>
                    <?php endif; ?>
                </li>
                <?php if ($empresa->getCodigoPostal() != '') : ?>
                    <li><strong>C.P.: </strong><?php echo $empresa->getCodigoPostal() ?></li>
                <?php endif ?>
                <?php if ($empresa->getPersonaContacto() != '') : ?>
                    <li><strong>Persona contacto: </strong><?php echo $empresa->getPersonaContacto() ?></li>
                <?php endif ?>

                <?php if ($empresa->getTelefono() != '') : ?>
                    <li><strong>Telefono: </strong><?php echo $empresa->getTelefono() ?></li>
                <?php endif ?>

                <?php if ($empresa->getEmail()) : ?>
                    <li><strong>Email: </strong><?php echo $empresa->getEmail() ?></li>
                <?php endif ?>

                <li><strong>Sector: </strong><?php echo $empresa->getEmpresaSectorUno() ?></li>
                <li><strong>Subsector: </strong><?php echo $empresa->getEmpresaSectorDos() ?></li>
                <?php if ($empresa->getEmpresaSectorTres()->getId()) : ?>
                    <li><strong>Actividad: </strong><?php echo $empresa->getEmpresaSectorTres() ?></li>
                <?php endif ?>
                <?php if ($empresa->getLista() == "lb"): ?>
                    <li><strong>Lista: </strong><?php echo __('Blanca', array(), 'messages'); ?></li>
                <?php elseif ($empresa->getLista() == "ln"): ?>
                    <li><strong>Lista: </strong><?php echo __('Negra', array(), 'messages'); ?></li>
                <?php else: ?>
                    <li><strong>Lista: </strong><?php echo __('Ninguna', array(), 'messages'); ?></li>
                <?php endif; ?>

                <?php if ($empresa->getLista() == "lb"): ?>
                    <?php if ($empresa->getRawValue()->getComentarioInicial()): ?>
                        <br/>    
                        <li class="comment" style="margin-bottom: 5px;"><span class="bold">Comentario inicial:</span><p class="mr-span"> </p>
                            <?php echo $empresa->getRawValue()->getComentarioInicial() ?>
                            <br/>
                            <span class="ver_link">      
                                <?php echo link_to('ver +', 'empresa/showComentarioInicial?id=' . $empresa->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1, scrollbars=1"))) ?>
                                <?php //echo link_to('descargar pdf', 'empresa/download_pdfComentario?id=' . $empresa->getId()) ?>
                            </span>
                        </li>
                        <br/>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            <ul class="dragbox-content">
                <?php if ($empresa->getConcursoDestacado()->getId()) : ?>
                    <li><strong>Concurso asociado: </strong><a
                            href='<?php echo url_for('concurso_show', array('id' => $empresa->getConcursoDestacado()->getId())) ?>'><?php echo $empresa->getConcursoDestacado() ?></a>
                    </li>
                <?php endif ?>
            </ul>


        </div>

        <ul class='sf_admin_actions'>
            <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@empresa', array('class' => 'sf_admin_action_cancel')) ?></li>
            <li class='sf_admin_action_list'><?php echo link_to('Ir a Listado en lista blanca', '@empresa_lista_blanca', array('class' => 'sf_admin_action_cancel')) ?></li>
            <li class='sf_admin_action_edit'><?php echo link_to('Editar', 'empresa_edit', array('id' => $empresa->getId()), array('class' => 'sf_admin_action_edit')) ?></li>
        </ul>
    </div>
</div>
<style type="text/css">
    .empresa_ul_audit{
        float: left;
        margin: 0 0 0 25px;
        min-height: 50px;
    }
    .empresa_audit{
        float: left;
        width: 100%;
    }
    .empresa_date{
        float: left;
        width: 135px;
    }
    .empresa_user_name{
        float: left;
        width: 200px;
        padding-right: 35px;
    }
    .empresa_pun_total{
        float: left;
        width: 150px;
    }
    .empresa_comentario{
        float: left;
        width: 125px;
    }
    .empresa_comment_aprobar{
        float: left;
        width: 200px;
    }
    .empresa_aprobar{
        float: left;
        width: 83px;
    }
    .pagination{
        float: left;
        width: 98%;
        margin: 5px 0 10px 25px;
    }
    .pagination .result{
        color: #006400;
        float: left;
        width: 85px;
        margin: -2px 0 0 0;
    }
    .empresa_number{
        float: left;
        margin-top: -1px;
        width: 24px;
    }
    .empresa_kpi{
        padding-left: 25px !important; 
    }
    #sf_admin_container ul.sf_admin_actions { 
        float: left; 
        width: 99%;
        margin: 10px 10px 10px 6px !important;
    }
    .ver_link{
        float:left;
        margin: 0px 0px 5px -19px;
    }
    .comment p{
        width: 100%;
    }
    .ui-dialog #dialog ul li{ list-style: disc; }
</style>
<script type='text/javascript'>


    $('.display_comments').click(function () {
        dialog = $('#dialog');
        if (dialog.length == 0) {
            dialog = $('<div/>', {
                id:'dialog'
            });
        }
        dialog.html($(this).next().html());
        dialog.dialog({ title:'Comentario', width:400, height:250});

        return false;

    });

    $('.ajax_actions').click(function () {
        var that = $(this);
        if (that.hasClass('check')) {
            if (!confirm(this.title)) {
                return false;
            }
        }
        $.post($(this).attr('href'), function (data) {
            that.closest('li').fadeOut();
            window.location.reload();
        });
        return false;
    })
</script>
