<?php

/**
 * Gift form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GiftForm extends BaseGiftForm {

    public function configure() {
        parent::configure();        

        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => '70', 'class' => 'tamano_32_c'));
        $this->widgetSchema['require_points'] = new sfWidgetFormInputText(array(), array('maxlength' => '10', 'class' => 'tamano_10_c'));
        $this->widgetSchema['orden'] = new sfWidgetFormInputText(array(), array('maxlength' => '3', 'class' => 'tamano_3_c'));

        $this->widgetSchema['featured_order'] = new sfWidgetFormInputText(array(), array('maxlength' => '1', 'class' => 'tamano_2_c'));
        $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
            'label' => 'Company logo',
            'file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_gift_dir')) . '/' .$this->getObject()->getImage(),
            'is_image' => true,
            'edit_mode' => !$this->isNew(),
            'template' => '<div class="edit-image">%file%<br />%input%<br /><br /> <b>'.$this->getObject()->getImage().'</b></div>',
        ));
        $this->widgetSchema['created_at'] = new sfWidgetFormDateTime(array('date' => array('format' => '%day% - %month% - %year%')));
        $this->widgetSchema['features'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'max_length' => 3000, 'err_id' => 'max_length_error'), array('maxlength' => 3000));

        $this->validatorSchema['name'] = new sfValidatorString(array('required' => true), array('required' => __('Necesitas incluir un regalo.')));
        $this->validatorSchema['image'] = new sfValidatorFile(array(
            'required' => false,
            'path' => sfConfig::get('sf_gift_dir'),
            'mime_types' => 'web_images',
                ), array('required' => __('Necesitas incluir la imagen del regalo.')));
        $this->validatorSchema['require_points'] = new sfValidatorCaja(array('required' => true), array('required' => __('Necesitas incluir los puntos de canje necesarios.'), 'invalid' => __('Necesitas incluir los puntos de canje necesarios.')));
        $this->validatorSchema['orden'] = new sfValidatorInteger(array('required' => true), array('required' => __('Necesitas incluir un orden.')));
        $this->validatorSchema['featured_order'] = new sfValidatorInteger(array('required' => false), array());
        $this->validatorSchema['features'] = new sfValidatorString(array('max_length' => 3000, 'required' => true), array('max_length' => __('Has superado el límite permitido para las características del regalo.'), 'required' => __('Necesitas incluir las características de regalo.')));
        $this->validatorSchema['created_at'] = new sfValidatorDateTime(array('required' => false));
        $this->setDefault('created_at', date('d-m-Y H:i:s'));
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'featuredCallback'))));
    }

    /**
     *
     * @param type $validator
     * @param type $values
     * @return type
     */
    public function featuredCallback($validator, $values) {
        if (!empty($values['featured'])) {
            //get featured limit
            $featured_limit = Doctrine::getTable('Gift')->getFeatreudLimit();

            //if featured limit is more then 10 then show error message
            if ($featured_limit[0]['gift_limit'] >= 6) {
                $invalid = new sfValidatorError($validator, 'No puedes destacar más de 6 regalos del Escaparate en la Home.');
                throw new sfValidatorErrorSchema($validator, array('featured' => $invalid));
            }
        }
        return $values;
    }

}
