<?php
//require_once '/home/dmt/symfony-1.4.13/lib/autoload/sfCoreAutoload.class.php';
require_once dirname(__FILE__).'/../lib/symfony/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function configureDoctrine(Doctrine_Manager $manager)
  {
    $manager->setAttribute(Doctrine::ATTR_DEFAULT_TABLE_TYPE, 'INNODB');
    $manager->setCollate('utf8_unicode_ci');
    $manager->setCharset('utf8');
  }

  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfDependentSelectPlugin');
    $this->enablePlugins('sfFormExtraPlugin');
    $this->enablePlugins('sfJqueryReloadedPlugin');
    $this->enablePlugins('sfJQueryUIPlugin');
    $this->enablePlugins('sfThumbnailPlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin');
    $this->enablePlugins('sfDoctrineApplyPlugin');
    $this->enablePlugins('sfDoctrineActAsSignablePlugin');
    $this->enablePlugins('csDoctrineActAsSortablePlugin');

    sfConfig::add(array(
             'sf_upload_dir_name'  => $sf_upload_dir_name = 'images' . DIRECTORY_SEPARATOR . 'uploads',
             'sf_upload_dir'       => sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.$sf_upload_dir_name,
    ));
    sfConfig::set('sf_thumbnail_dir', sfConfig::get('sf_upload_dir').'/thumbnails');
    sfConfig::set('sf_images_dir', sfConfig::get('sf_web_dir').'/images/uploads');
    sfConfig::set('sf_documents_dir', sfConfig::get('sf_upload_dir').'/documents');
    sfConfig::set('sf_users_dir', sfConfig::get('sf_upload_dir').'/users');
    sfConfig::set('sf_gift_dir', sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR . 'gift');

    $this->enablePlugins('sfAdminDashPlugin');

      // load ladybug lib
      require_once sfConfig::get('sf_lib_dir') . '/vendor/Ladybug/lib/Ladybug/Autoloader.php';
      Ladybug\Autoloader::register();
    $this->enablePlugins('npAssetsOptimizerPlugin');
  }
}
