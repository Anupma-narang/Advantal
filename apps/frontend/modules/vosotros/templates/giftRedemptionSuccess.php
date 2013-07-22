<?php use_stylesheet('forms.css') ?>
<?php use_javascript('passwordStrengthMeter.js') ?>
<?php use_stylesheet('jquery.autocompleter.css') ?>
<?php use_stylesheet('caja.css') ?>
<?php use_javascript('fancybox/jquery.fancybox.pack.js') ?>
<?php use_stylesheet('fancybox/jquery.fancybox.css') ?>

<div id="content_vosotros">
    <div id="content_breadcroum">
        <?php echo link_to("Inicio", "home/index", array('title' => 'Inicio')) ?>
        >> <?php echo link_to("Vosotros ", "/vosotros", array('title' => 'Vosotros')) ?>
        >> <?php echo link_to('Escaparate de regalos', "vosotros/" . sfContext::getInstance()->getActionName(), array('title' => 'Escaparate de regalos')) ?>
    </div>

    <div class="box width100"><h1><?php echo __('Formulario de canje de regalo') ?></h1></div>
    <div><?php
        echo image_tag(sfConfig::get('sf_gift_upload_path') . '/' . 'thumb_' . $gift->getImage(), array('class' => 'gift-image',
            'data-id' => $gift->getId(),
            'id' => 'gift_image_' . $gift->getId(),
        ));
        ?> </div>
    <div class="container box">
        <?php if ($sf_user->hasFlash('errorgift')): ?>
            <ul class="error_list">
                <li style="font-weight: bold;"><?php echo $sf_user->getFlash('errorgift', ESC_RAW) ?></li>
            </ul>
        <?php endif; ?>
        <p>
            <strong><?php echo $gift->getName(); ?></strong>
        </p>
        <div class="border-box">
            <div class="top-left">
                <div class="top-right" >
                    <h2 align="center"><?php echo __('CANJE DE REGALO') ?></h2>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>



        <form method="POST" action="<?php echo url_for('gift_redemption', array('id' => $gift_id)) ?>" id="frm">


            <div class="border-box">
                <div class="top-left">
                    <div class="top-right">
                        <table width="100%" border="0">
                            <tr>
                                <td colspan="2"><?php echo $gift_redemption_form['name']->renderError() ?>
                                    <input type="hidden" name="page" value="<?php echo $page ?>">
                                </td>
                            </tr>
                            <tr>
                                <th><?php echo $gift_redemption_form['name']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th><?php echo $gift_redemption_form['name']->render(array('readonly' => 'readonly', 'class' => 'gray-out tamano_32_c')) ?></th>
                            </tr>
                            <tr>
                                <td colspan="2"><?php echo $gift_redemption_form['surname1']->renderError() ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $gift_redemption_form['surname1']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th><?php echo $gift_redemption_form['surname1']->render(array('readonly' => 'readonly', 'class' => 'gray-out tamano_32_c')) ?></th>
                            </tr>
                            <tr>
                                <td colspan="2"><?php echo $gift_redemption_form['surname2']->renderError() ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $gift_redemption_form['surname2']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th><?php echo $gift_redemption_form['surname2']->render(array('readonly' => 'readonly', 'class' => 'gray-out tamano_32_c')) ?></th>
                            </tr>
                            <tr>
                                <td colspan="2"><?php echo $gift_redemption_form['road_type']->renderError() ?></td>
                            </tr>
                            <tr>
                                <?php $road_typeError = (($gift_redemption_form['road_type']->hasError()) ? 'errorgift' : ''); ?>
                                <th><?php echo $gift_redemption_form['road_type']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th><?php echo $gift_redemption_form['road_type']->render(array('class' => 'select_pequeño ' . $road_typeError)) ?></th>
                            </tr>
                            <tr>
                                <td colspan="2"><?php echo $gift_redemption_form['address']->renderError() ?></td>
                            </tr>
                            <tr>
                                <?php $addressError = (($gift_redemption_form['address']->hasError()) ? 'errorgift' : ''); ?>
                                <th><?php echo $gift_redemption_form['address']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th><?php echo $gift_redemption_form['address']->render(array('class' => 'tamano_32_c ' . $addressError)) ?></th>
                            </tr>
                            <tr>
                                <td colspan="2"><?php echo $gift_redemption_form['number']->renderError() ?></td>
                            </tr>
                            <tr>
                                <?php $numberError = (($gift_redemption_form['number']->hasError()) ? 'errorgift' : ''); ?>
                                <th><?php echo $gift_redemption_form['number']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th><?php echo $gift_redemption_form['number']->render(array('class' => 'tamano_4_c ' . $numberError)) ?></th>
                            </tr>
                            <tr>
                                <td colspan="2"><?php echo $gift_redemption_form['floor']->renderError() ?></td>
                            </tr>
                            <tr>
                                <?php $floorError = (($gift_redemption_form['floor']->hasError()) ? 'errorgift' : ''); ?>
                                <th><?php echo $gift_redemption_form['floor']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th><?php echo $gift_redemption_form['floor']->render(array('class' => 'tamano_3_c ' . $floorError)) ?></th>
                            </tr>
                            <tr>
                                <td colspan="2"><?php echo $gift_redemption_form['door']->renderError() ?></td>
                            </tr>
                            <tr>
                                <?php $doorError = (($gift_redemption_form['door']->hasError()) ? 'errorgift' : ''); ?>
                                <th><?php echo $gift_redemption_form['door']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th><?php echo $gift_redemption_form['door']->render(array('class' => 'tamano_4_c ' . $doorError)) ?></th>
                            </tr>
                            <tr>
                                <td colspan="2"><?php echo $gift_redemption_form['cp']->renderError() ?></td>
                            </tr>
                            <tr>
                                <?php $cpError = (($gift_redemption_form['cp']->hasError()) ? 'errorgift' : ''); ?>
                                <th><?php echo $gift_redemption_form['cp']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th><?php echo $gift_redemption_form['cp']->render(array('class' => 'giftc_p ' . $cpError)) ?></th>
                            </tr>
                            <tr>
                                <td colspan="2"><?php echo $gift_redemption_form['states_id']->renderError() ?></td>
                            </tr>
                            <tr>
                                <?php $states_idError = (($gift_redemption_form['states_id']->hasError()) ? 'errorgift' : ''); ?>
                                <th><?php echo $gift_redemption_form['states_id']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th><?php echo $gift_redemption_form['states_id']->render(array('class' => $states_idError)) ?></th>
                            </tr>
                            <tr>
                                <td colspan="2"><?php echo $gift_redemption_form['city_id']->renderError() ?></td>
                            </tr>
                            <tr>
                                <?php $city_idError = (($gift_redemption_form['city_id']->hasError()) ? 'errorgift' : ''); ?>
                                <th><?php echo $gift_redemption_form['city_id']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th><?php echo $gift_redemption_form['city_id']->render(array('class' => 'c_id ' . $city_idError)) ?></th>
                            </tr>

                            <tr>
                                <td colspan="2"><?php echo $gift_redemption_form['contact_number']->renderError() ?></td>
                            </tr>
                            <tr>
                                <?php $contact_numberError = (($gift_redemption_form['contact_number']->hasError()) ? 'errorgift' : ''); ?>
                                <th><?php echo $gift_redemption_form['contact_number']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th><?php echo $gift_redemption_form['contact_number']->render(array('class' => 'tamano_9_c ' . $contact_numberError)) ?></th>
                            </tr>
                            <tr>
                                <td colspan="2"><?php echo $gift_redemption_form['delivery_time']->renderError() ?></td>
                            </tr>
                            <tr>
                                <?php $delivery_timeError = (($gift_redemption_form['delivery_time']->hasError()) ? 'errorgift' : ''); ?>
                                <th><?php echo $gift_redemption_form['delivery_time']->renderLabel(null, array('class' => 'bundle')) ?></th>
                                <th><?php echo $gift_redemption_form['delivery_time']->render(array('class' => 'tamano_32_c ' . $delivery_timeError)) ?></th>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><strong><?php echo __('*Datos requeridos.') ?></strong></td>
                            </tr>
                            <tr>
                                <td  align="center" colspan="2">
                                    <input type="submit" value="confirma" id="confirma_button" class="red_button">

                                    <?php echo link_to(__('cancela'), url_for('gift_list')) ?>
                                </td>

                            </tr>
                        </table>
                        <?php echo $gift_redemption_form->renderHiddenFields() ?>
                        <?php echo $gift_redemption_form->renderGlobalErrors(); ?>
                    </div>
                </div>
                <div class="bottom-left">
                    <div class="bottom-right"></div>
                </div>
            </div>
        </form>
    </div>


</div>
<style type="text/css">
    input.giftc_p{
        width: 47px;
    }
    select.errorgift,
    input.errorgift{
        border: 2px solid red;
        border-radius: 3px 3px 3px 3px;
    }
    form#frm input {

        font-family: arial !important;
        font-size: 14px;
    }
    .c_id{
        width: 230px;

    }
</style>
<script type="text/javascript">

    $("input#confirma_button").click(function() {
        $(this).removeClass("red_button");
        $(this).addClass("gray_button");
        $(this).attr('disabled', 'disabled');
        $('#frm').submit();
    });

    function ceuta_melilla(f, g) {
        var state2city = new Array();<?php
                        foreach (StatesTable::getCiudadesAutonomas() as $city)
                            printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
                            ?>
        if (state2city[f.val()])
            g.val(state2city[f.val()]).attr("disabled", "disabled");
    }
    $(document).ready(function() {
        sortProvinciaList("gift_redemption_states_id");
        $("#gift_redemption_states_id").change(function() {
            ceuta_melilla($(this), $("#gift_redemption_city_id"))
        });
        $("#frm").bind("submit", function() {
            $("#gift_redemption_city_id").removeAttr("disabled");
        });
        ceuta_melilla($("#gift_redemption_states_id"), $("#gift_redemption_city_id"));


    });
</script>