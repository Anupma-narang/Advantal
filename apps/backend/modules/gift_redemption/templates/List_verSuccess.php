
<?php use_helper('Text') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Detalle del canje de regalos') ?></h1>

  <div id="sf_admin_content">
    <h2>
      <?php echo __($gift_redemption->getName(), array(), 'name') ?>
    </h2>
    <ul class="dragbox-content">
      <li><span class="bold"><?php echo __('Fecha: ') ?></span><?php echo format_datetime($gift_redemption->getCreatedAt(), "dd/MM/y", "es_ES") ?>
      </li>

      <li>
        <span class="bold"><?php echo __('Nombre de usuario') ?>:</span>
        <?php $user = Doctrine::getTable('sfGuardUser')->find($gift_redemption->getUser()); ?>
        <?php echo $user->getUsername() ?>
      </li>
      <li>
        <span class="bold"><?php echo __('Regalo') ?>:</span>

        <?php echo $gift_redemption->getGift() ?>
      </li>
      <li>
        <span class="bold"><?php echo __('Tipo de vía') ?>:</span>
        <?php echo $gift_redemption->getRoadType() ?>
      </li>
      <li>
        <span class="bold"><?php echo __('Dirección de entrega') ?>:</span>
        <?php echo $gift_redemption->getAddress() ?>
      </li>
      <li>
        <span class="bold"><?php echo __('Nº') ?>:</span>
        <?php echo $gift_redemption->getNumber() ?>
      </li>

      <?php if(trim($gift_redemption->getFloor()) != "" && $gift_redemption->getFloor() != null): ?>
        <li>
          <span class="bold"><?php echo __('Piso') ?>:</span>
          <?php echo $gift_redemption->getFloor() ?>
        </li>
      <?php endif;?>

      <?php if(trim($gift_redemption->getDoor()) != "" && $gift_redemption->getDoor() != null): ?>
        <li>
          <span class="bold"><?php echo __('Puerta') ?>:</span>
          <?php echo $gift_redemption->getDoor() ?>
        </li>
      <?php endif;?>

      <li>
        <span class="bold"><?php echo __('Provincia') ?>:</span>
        <?php $state = Doctrine::getTable('States')->find($gift_redemption->getStatesId()); ?>
        <?php echo $state->getName(); ?>
      </li>
      <li>
        <span class="bold"><?php echo __('Localidad') ?>:</span>
        <?php $city = Doctrine::getTable('City')->find($gift_redemption->getCityId()); ?>
        <?php echo $city->getName(); ?>
      </li>
      <li>
        <span class="bold"><?php echo __('Teléfono de contacto') ?>:</span>
        <?php echo $gift_redemption->getContactNumber() ?>
      </li>
      <li>
        <span class="bold"><?php echo __('Horario de entrega preferido') ?>:</span>
        <?php $delivery_time_list = array('Mañana: 8-14', 'Tarde: 14-20') ?>
        <?php echo $delivery_time_list[$gift_redemption->getDeliveryTime()] ?>
      </li>
			<span class="ver_link">  
  		<div style="clear: both; height: 16px;"></div>
      <div><?php echo link_to('Volver al Listado', '@gift_redemption', array('class' => 'normal')) ?>
  		</div>
			</span>
    </ul>
  </div>
</div>
