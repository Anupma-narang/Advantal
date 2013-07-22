<?php use_helper('Date', 'Text', 'Concursos', 'mihelper') ?>
<ul class="cp-lt block">
  <?php foreach ($contest_records as $index => $contest): ?>
    <li>
      <a href="<?php echo url_for_concurso($contest) ?>" class="home-block-link">
        <div>
          <div class="cn-l ">
            <?php echo image_tag(basename(sfConfig::get('sf_upload_dir_name')) . DIRECTORY_SEPARATOR . $contest->getConcursoCategoria()->getImage()); // . $contest->ConcursoCategoria->getImage()) ?>
          </div>
          <div class="cn-r ">
            <span class="cn-n"> <?php echo truncate_text($contest->getName(), 65) ?></span>
            <div class="cn-rp">
              <span class="cn-ep bold <?php echo $contest_type == 'company' ? 'bc' : 'cbbro-color' ?>">
                <?php if ($contest_type == 'company'): ?>
                  <?php $city_name_length = 65 - strlen($contest->getStateValue()); ?>

                  <?php $company_length = strlen($contest->getEmpresa()->getName()) < ($city_name_length - 5) ? strlen($contest->getEmpresa()->getName()) : $city_name_length - 5; ?>

                  <?php $city_name_length = $city_name_length - $company_length; ?>

                  <?php echo truncate_text($contest->getEmpresa()->getName(), $company_length); ?>
                <?php else: ?>
                  <?php $product = $contest->getProducto(); ?>
                  <?php $product_str_length = strlen($contest->getProducto()->getName()) ?>
                  <?php $product_str_length = $product_str_length > 65 ? 40 : $product_str_length; ?>

                  <?php echo truncate_text($contest->getProducto()->getName(), $product_str_length); ?>
                <?php endif; ?> 
              </span>
              <?php if ($contest_type == 'company'): ?>
                <strong class="gr-l <?php echo $contest_type == 'company' ? 'gc' : 'rc' ?>" >
                  <?php echo truncate_text($contest->getCityValue(), $city_name_length) . ' ' . $contest->getStateValue() ?>
                </strong>
              <?php else: ?>
                <?php $marca_length = strlen($product->getMarca()) ?>
                <?php $marca_length = $marca_length > 64 - $product_str_length ? 60 - $product_str_length : $marca_length; ?>
              
                <strong class="cbb-color"><?php echo truncate_text($product->getMarca(), $marca_length) ?></strong>
                <?php $modelo_length = strlen($product->getModelo()) ?>
                <?php $modelo_length = $modelo_length > 63 - ($product_str_length + $marca_length) ? 63 - ($product_str_length + $marca_length) : $marca_length; ?>
                
                <strong class="cbgr2-color"><?php echo truncate_text($product->getModelo(), $modelo_length) ?></strong>
              <?php endif; ?>
            </div>

            <span class="cn-d"><?php echo html_entity_decode(truncate_text($contest->getIncidencia(), $length = 250)) ?></span>
          </div>
        </div>
      </a>
    </li>
  <?php endforeach; ?>
</ul>