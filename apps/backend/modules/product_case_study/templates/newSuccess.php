<?php use_helper('I18N', 'Date') ?>
<?php include_partial('product_case_study/assets') ?>
<style type="text/css">
    #sf_admin_container label{
        width: 140px;
    }
</style>
<div id="sf_admin_container">
    <h1><?php echo __('Nuevo caso de éxito de Producto', array(), 'messages') ?></h1>

    <?php include_partial('product_case_study/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('product_case_study/form_header', array('product_case_study' => $product_case_study, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('product_case_study/form', array('product_case_study' => $product_case_study, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('product_case_study/form_footer', array('product_case_study' => $product_case_study, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
</div>

<script type="text/javascript">
    $('#product_case_study_producto_tipo_dos_id').change(function(){
        if($('#product_case_study_producto_tipo_tres_id option').size() == 1){
            $('#product_case_study_producto_tipo_tres_id').attr('disabled','disabled');
        }
    });

    $('#product_case_study_producto_tipo_dos_id').each(function(){
        if($('#product_case_study_producto_tipo_dos_id option:selected').val()){
            if($('#product_case_study_producto_tipo_tres_id option').size() == 1){
                $('#product_case_study_producto_tipo_tres_id').attr('disabled','disabled');
            }
        }
    });
</script>