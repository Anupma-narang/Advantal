<?php $extension = pathinfo ($fichero->getFile(), PATHINFO_EXTENSION); ?>
<?php echo link_to(image_tag($extension.".png")."archivo $orden", "/images/".basename(sfConfig::get('sf_upload_dir')).'/'.basename(sfConfig::get('sf_documents_dir')).'/'.$fichero->file)?>
