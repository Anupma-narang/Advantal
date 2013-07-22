<div class="con-p">
  <div class="bd-l list-f">
    <?php if (count($professioanl_list)): ?>

      <ul class="cn-lt">
        <?php foreach ($professioanl_list as $index => $professioanl): ?>
          <li class="<?php echo $index % 2 ? '' : 'blue-back' ?>">
            <a href="<?php echo url_for('lista_profesional_detalle', array('slug' => $professioanl->getSlug())) ?>" class="home-block-link">
              <?php $image = $professioanl->getProfesionalTipoDos() ? $professioanl->getProfesionalTipoDos()->getImage() : $professioanl->getProfesionalTipoUno()->getImage(); ?>
              <div class="cn-l rhb"><?php echo image_tag(basename(sfConfig::get('sf_upload_dir_name')) . DIRECTORY_SEPARATOR . $image); ?></div>
              <div class="cn-r">
                <?php $first_name_array = explode(' ', $professioanl->getFirstName());?>
                <?php $first_name = ''?>
                <?php foreach ($first_name_array as $key => $value):?>
                <?php $first_name .= $value[0] . '. ';?>
                <?php endforeach;?>
                <span class="cn-ep cbgr2-color bold block"><?php echo truncate_text($first_name . ' ' .$professioanl->getLastNameOne() . ' ' . $professioanl->getLastNameTwo() , 28); ?></span>
                <?php $city_state_length = strlen($professioanl->getCity() . ' ' . $professioanl->getStates());?>
                <strong class="gr-l cbg-color block">
                  <?php echo truncate_text($professioanl->getCity(), $city_state_length >= 50 ? 25 : 25 ); ?>
                  <?php echo truncate_text('(' . $professioanl->getStates() . ')', 25 ); ?>
                </strong>
                <strong class="rc-l cbo-color block"><?php echo truncate_text($professioanl->getActivityName(), 25); ?></strong>
              </div>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
      <?php echo link_to('&nbsp;', url_for('lista_profesional'), array('title' => 'Ver todos los profesionales en el Directorio de buenos profesionales', 'class' => 'bt_ver')); ?>
    <?php endif; ?>
  </div>

</div>