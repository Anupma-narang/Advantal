<style type="text/css">
  p {
    margin: 0 0 0.2em;
    padding: 0;
  }
</style>
<?php use_helper('Text', 'Concursos', 'Date') ?>
<?php if ($request_type == 'company'): ?>
  <div id="title_concurso"><?php echo $case_study_record->getName() ?></div>
  <div id="fecha"><?php echo format_datetime($case_study_record->getCreatedAt(), "p", "es_ES") ?></div>
  <p style="color:#166494;font-family:Trebuchet MS"><b><?php echo $case_study_record->getName(); ?></b></p>
  <p class="gris"><?php echo $case_study_record->getRoadType() . ',' . $case_study_record->getDireccion() . ',' . $case_study_record->getNumero() . ',' . $case_study_record->getPiso() . ',' . $case_study_record->getPuerta(); ?></p>
  <p style="color:#429D29"><b><?php echo $case_study_record->getMunicipioProvincia(); ?></b></p>
  <p style="color:#F65E13"><b><?php echo $case_study_record->getSector(); ?></b></p>
  <p class="strong"><?php print __('Descripción del caso de éxito') ?></p>
  <div id="text">
    <?php print html_entity_decode($case_study_record->getDescription()) ?>
  </div>
<?php else: ?>
  <div id="title_concurso"><?php echo $case_study_record->getName() ?></div>
  <div id="fecha"><?php echo format_datetime($case_study_record->getCreatedAt(), "p", "es_ES") ?></div>
  <p style="color:#166494;font-family:Trebuchet MS"><b><?php echo $case_study_record->getName(); ?></b></p>
  <p class="gris"><?php echo $case_study_record->getMarca(); ?>&nbsp;<span style="color:#429D29"><?php echo $case_study_record->getModelo(); ?></span></p>
  <p style="color:#F65E13"><b><?php echo $case_study_record->getSector(); ?></b></p>
  <p class="strong"><?php print __('Descripción del caso de éxito') ?></p>
  <div id="text">
    <?php print html_entity_decode($case_study_record->getDescription()) ?>
  </div>


<?php endif; ?>
<?php echo __('Archivos:') ?>
<ul>
  <?php if ($case_study_record->getFile1()): ?>
    <li><a href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $case_study_record->getFile1(); ?>"><?php echo __('Archivos1') ?></a></li>
  <?php endif; ?>
  <?php if ($case_study_record->getFile2()): ?>
    <li><a href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $case_study_record->getFile2(); ?>"><?php echo __('Archivos2') ?></a></li>
  <?php endif; ?>
  <?php if ($case_study_record->getFile3()): ?>
    <li><a href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $case_study_record->getFile3(); ?>"><?php echo __('Archivos3') ?></a></li>
  <?php endif; ?>
  <?php if ($case_study_record->getFile4()): ?>
    <li><a href="<?php echo '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/' . $case_study_record->getFile4(); ?>"><?php echo __('Archivos4') ?></a></li>
  <?php endif; ?>
</ul>