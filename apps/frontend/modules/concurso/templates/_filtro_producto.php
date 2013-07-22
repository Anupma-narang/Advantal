<?php use_javascript('jquery.autocompleter.js')?>
<?php use_stylesheet('jquery.autocompleter.css')?>
<div id="buscador_content">
    <div class="border-box" style="width: 625px;">
        <div class="top-left">
            <div class="top-right">
                <form id="filterForm" action="<?php echo url_for('concurso/index') ?>?tipo=producto" method="POST">
                    <input type="hidden" id="pageField" name="page" value="">
                    <input type="hidden" id="extraField" name="extra" value="">
                    <?php echo $form->renderHiddenFields() ?>
                    <table style="width: 100%">
                        <tr>
                            <td colspan="3">
                                <?php echo $form['filter']->renderLabel() ?>
                                <br />
                                <?php echo $form['filter']->render() ?>
                            </td>
                        </tr>
                        <tr>
                            <td id="marca_filter">
                                <?php echo $form['marca']->renderLabel() ?>
                                <br />
                                <?php echo $form['marca']->render() ?>
                            </td>
                            <td id="modelo_filter">
                                <?php echo $form['modelo']->renderLabel() ?>
                                <br />
                                <?php echo $form['modelo']->render() ?>
                            </td>
                            <td style="width: 100%;vertical-align: bottom;text-align: right;">
                                <input type="submit" value="buscar">
                            </td>
                        </tr>
                        <?php if ($sf_user->isAuthenticated()) : ?>
                        <tr>
                            <td colspan="3" style="text-align: center">
                                <a id="save_link" href="#">recuerda orden</a>
                                -
                                <a id="restore_link" href="#">Mi orden</a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </form>
            </div>
        </div>
        <div class="bottom-left">
                <div class="bottom-right"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        if (15 == $('#ProductoFilterForm_filter').val())
        {
            $('#modelo_filter').css('visibility', 'hidden');
        }
        else if (15 > $('#ProductoFilterForm_filter').val())
        {
            $('#marca_filter').css('visibility', 'hidden');
            $('#modelo_filter').css('visibility', 'hidden');
        }

	$("#ProductoFilterForm_marca").autocomplete("<?php echo url_for('ajax_get/productos_by_marca')?>", {width: 260,selectFirst: false});
	$("#ProductoFilterForm_modelo").autocomplete("<?php echo url_for('ajax_get/productos_by_modelo')?>", {width: 260,selectFirst: false});
    });

    $('#save_link').click(function(){
        $('#extraField').val('save');
        $('#filterForm').submit();
    });

    $('#restore_link').click(function(){
        $('#extraField').val('restore');
        $('#filterForm').submit();
    });

    $('#ProductoFilterForm_filter').change(function(){
        if ( 15 == $(this).val()) {
            $('#marca_filter').css('visibility', 'visible');
            $('#modelo_filter').css('visibility', 'hidden');
        } else if ( 16 == $(this).val()) {
            $('#marca_filter').css('visibility', 'visible');
            $('#modelo_filter').css('visibility', 'visible');
        } else {
            $('#marca_filter').css('visibility', 'hidden');
            $('#modelo_filter').css('visibility', 'hidden');
        }
        $('#ProductoFilterForm_marca').val("");
        $('#ProductoFilterForm_modelo').val("");

    });
</script>