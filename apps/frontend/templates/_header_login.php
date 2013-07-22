<div id="login">
    <?php if ($sf_user->isAuthenticated()): ?>
        <?php include_component('sfApply', 'login') ?>
    <?php else: ?>
        <table border="0" width="300" cellpadding="0" cellspacing="10">

            <tr> <td> <span id="subtitulo"> ¡Hazte colaborador ya!</span></td></tr>
            <tr> <td align="center"><span id="href_boton_red"><?php echo link_to("crea una cuenta", "sfApply/apply", array("title" => "Crea una cuenta en auditoscopia")) ?></span>
                </td></tr>
            <tr> <td align="center">  <span id="href_boton_gray"><?php echo link_to("ya soy colaborador", "guard/login", array("title" => "Ya soy colaborador de auditoscopia")) ?></span>
                </td></tr>
        </table>
    <?php endif; ?>
</div>