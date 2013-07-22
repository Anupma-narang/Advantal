<?php $extension = pathinfo ($fichero->getFile(), PATHINFO_EXTENSION); ?>
<?php echo image_tag($extension.".png")?>
<?php echo link_to($fichero->name, "/images/".basename(sfConfig::get('sf_upload_dir')).'/'.basename(sfConfig::get('sf_documents_dir')).'/'.$fichero->file)?>
