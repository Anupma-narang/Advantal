<?php if ($sf_user->getGuardUser()->getProfile()->getImage() == ""): ?>
  <?php $image = "default.png" ?>
<?php else: ?>
  <?php $image = $sf_user->getGuardUser()->getProfile()->getImage() ?>
<?php endif; ?>

<div id="table_log">
<!--<table border="0" width="288">
<tbody>
<tr>
  <td width="56" style="vertical-align: top; text-align: center;">
       </td>
  <td width="216" valign="top">  </td>
</tr>
<tr>
  <td height="10"></td>
  <td colspan="2" rowspan="3"></td>
</tr>
<tr>
    <td height="10"></td>
    </tr>
<tr>
    <td height="10">&nbsp;</td>
    </tr>

</tbody>
</table>-->
  <table width="311" border="0">
    <tr>
      <td width="41" height="21">
        <?php echo image_tag(basename(sfConfig::get('sf_upload_dir_name')) . '/' . basename(sfConfig::get('sf_users_dir')) . "/" . $image, array("alt" => $sf_user->getGuardUser()->getUsername())) ?>
      </td>
      <td width="231" rowspan="7" valign="top">
        <?php $user_profile = $sf_user->getGuardUser()->getProfile(); ?>
        <?php $heirarchy_list = Doctrine::getTable('Jerarquia')->getHierarchyList() ?>
        <span><strong>Hola</strong></span>
        <span class="negrita gris"><?php echo $sf_user->getGuardUser()->getUserName() ?></span><br />
        <span class="negrita verde"><?php echo __('Eres ') . $heirarchy_list[$user_profile->getHierarchy()]; ?></span><br />
        <div id="point-log">
          <span class="negrita azul"><?php echo __('Puntos acumulados: ') . $sf_user->getMoneyInFormat($user_profile->getAccumulatedPoints()) ?></span><br/>
          <span class="negrita naranja"><?php echo __('Puntos canjeables: ') . $sf_user->getMoneyInFormat($user_profile->getChangePoints()) ?></span><br />
        </div>
        <div id="cashup-log">
          <span class="negrita rojo_marron"><?php echo __('Caja: ') . $sf_user->getMoneyInFormat($sf_user->getGuardUser()->getProfile()->getMoney()) ?> &euro;</span><br />
          <span class="negrita rojo_marron"><?php echo __('Caja acumulada: ') . $sf_user->getMoneyInFormat($sf_user->getGuardUser()->getProfile()->getMoneySum()) ?> &euro;</span>
        </div>
      </td>

    </tr>
    <tr>
      <td valign="top"><?php echo link_to(__('salir'), '@sf_guard_signout', array("id" => 'logout', "class" => "salir")) ?></td>
    </tr>
    <tr>
      <td></td>
    </tr>

  </table>

</div>