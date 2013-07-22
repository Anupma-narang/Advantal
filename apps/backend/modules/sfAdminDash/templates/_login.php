<?php
use_helper('I18N');
?>

<div id="ctr" align="center">
  <div class="login round">
    <div class="login-form">
      <form action="<?php echo url_for(sfAdminDash::getProperty('login_route', '@sf_guard_signin')); ?>" method="post">
        <div align="center">
          <img alt="Login" src="<?php echo image_path('acceso.gif'); ?>" />
        </div>
        <div class="form-block round">
          <?php $form->renderGlobalErrors(); ?>
          <?php if (isset($form['_csrf_token'])): ?>
            <?php echo $form['_csrf_token']->render(); ?> 
          <?php endif; ?>
          <div class="inputlabel"><?php echo $form['username']->renderLabel(__('Correo electrónico', array(), 'sf_admin_dash'), array('class' => 'blod')); ?></div>
          <div >
            <?php echo $form['username']->renderError(); ?>
            <?php echo $form['username']->render(array('class' => 'inputbox')); ?>
          </div>
          <div class="inputlabel"><?php echo $form['password']->renderLabel(__('Contraseña', array(), 'sf_admin_dash'), array('class' => 'blod')); ?></div>
          <div>
            <?php echo $form['password']->renderError(); ?>
            <?php echo $form['password']->render(array('class' => 'inputbox')); ?>
          </div>
          <div>
          	<label class="rec_label">¿Recordar?</label><?php echo $form['remember']->render(array('class' =>'inputcheck')); ?></div>
          <div align="center"><input type="submit" name="submit" class="clr lg-cmd" value="&nbsp;<?php echo __('Entrar ', array(), 'sf_admin_dash'); ?>"/></div>
        </div>
      </form>
    </div>
    <div class="login-text">
      <div class="ctr"><img alt="Security" src="<?php echo image_path(sfAdminDash::getProperty('web_dir', '/sfAdminDashPlugin') . '/images/login_security.png'); ?>" /></div>
      <p style="font-weight:bold;"><?php echo __('Bienvenido a ', array(), 'sf_admin_dash'); ?> 
        <span class="site-title">audit<span class="site-o">o</span>scopia</span></p>
    </div>

    <div class="clr"></div>
  </div>
</div>
