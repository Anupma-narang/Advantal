<div id="buscador_content">
    <div class="border-box" style="width: 625px;">
        <div class="top-left">
            <div class="top-right">
                <form id="filterForm" action="<?php echo url_for('concurso/index') ?>?tipo=empresa" method="POST">
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
                            <td id="states_filter">
                                <?php echo $form['states_id']->renderLabel() ?>
                                <br />
                                <?php echo $form['states_id']->render() ?>
                            </td>
                            <td id="city_filter">
                                <?php echo $form['city_id']->renderLabel() ?>
                                <br />
                                <?php echo $form['city_id']->render() ?>
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
        if (5 == $('#EmpresaFilterForm_filter').val())
        {
            $('#city_filter').css('visibility', 'hidden');
        }
        else if (5 > $('#EmpresaFilterForm_filter').val())
        {
            $('#states_filter').css('visibility', 'hidden');
            $('#city_filter').css('visibility', 'hidden');
        }

        $('#save_link').click(function(){
            $('#extraField').val('save');
            $('#filterForm').submit();
        });

        $('#restore_link').click(function(){
            $('#extraField').val('restore');
            $('#filterForm').submit();
        });

        $('#EmpresaFilterForm_filter').change(function(){
            if ( 5 == $(this).val()) {
                $('#states_filter').css('visibility', 'visible');
                $('#city_filter').css('visibility', 'hidden');
                $('#EmpresaFilterForm_states_id').val(0);
                $('#EmpresaFilterForm_city_id').val(-1);
            } else if ( 6 == $(this).val()) {
                $('#states_filter').css('visibility', 'visible');
                $('#city_filter').css('visibility', 'visible');
                $('#EmpresaFilterForm_states_id').val(0);
                $('#EmpresaFilterForm_city_id').val(0);
            } else {
                $('#states_filter').css('visibility', 'hidden');
                $('#city_filter').css('visibility', 'hidden');
                $('#EmpresaFilterForm_states_id').val(-1);
                $('#EmpresaFilterForm_city_id').val(-1);
            }
        });
    });
</script>
