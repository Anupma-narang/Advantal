<?php use_stylesheet('caja.css') ?>
<div id="content_concursos_buscador">
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('type' => 'empresa'); ?>

            <?php echo link_to('Empresa / Entidad', url_for('concurso-misauditorias', $param), array('class' => ($audit_type == 'producto' ? '' : 'active'))) ?>
        </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('type' => 'producto'); ?>
            <?php echo link_to('Producto', url_for('concurso-misauditorias', $param), array('class' => ($audit_type == 'producto' ? 'active' : ''))) ?>
        </span>
    </div>
</div>

<div id="content_concursos">
    <div class="border-box-n">
        <div class="header-left"><div class="header-right"></div></div>
        <div class="top-left">
            <div class="top-right" >
                <div class="audit-block">


                    <?php foreach ($audit_records as $audit_record): ?>
                        <a class="l-audita" href="javascript:void(0)" data-audit="<?php echo $audit_record[ucfirst($audit_type)]['id'] ?>" data-id="<?php echo $audit_record['id'] ?>">
                            <?php echo image_tag('/images/img/television_top.jpg') ?>
                            <p><?php echo date('Y-m-d', strtotime($audit_record['created_date'])) ?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>


</div>
<div class="float-left">
    <?php echo link_to('vuelve a mis auditorías', url_for('concurso-misauditorias', array('page' => $page, 'type' => $audit_type))) ?>
</div>
<form method="POST" action="<?php echo url_for('my_audit_record') ?>" id="audit_record">
    <input type="hidden" name="page"  value="<?php echo $page ?>"/>
    <input type="hidden" name="type" value="<?php echo $audit_type ?>"/>
    <input type="hidden" name="object_id" value="" id="object_id"/>
    <input type="hidden" name="id" value="" id="question_id"/>
</form>
<script type="text/javascript">

    $('.l-audita').bind('click', function() {
        var question_id = $(this).data('id');
        var object_id = $(this).data('audit');
        $('#object_id').val(object_id);
        $('#question_id').val(question_id);
        $('#audit_record').submit();
    });
</script>