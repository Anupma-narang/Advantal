<?php

/**
 * Pizarra form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PizarraForm extends BasePizarraForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        parent::configure();
        $days_array = array(
            1 => __('Lunes'),
            2 => __('Martes'),
            3 => __('Miércoles'),
            4 => __('Jueves'),
            5 => __('Viernes'),
            6 => __('Sábado'),
            7 => __('Domingo'));
        $months_array = array(
            1 => __('Enero'),
            2 => __('Febrero'),
            3 => __('Marzo'),
            4 => __('Abril'),
            5 => __('Mayo'),
            6 => __('Junio'),
            7 => __('Julio'),
            8 => __('Agosto'),
            9 => __('Septiembre'),
            10 => __('Octubre'),
            11 => __('Noviembre'),
            12 => __('Diciembre')
        );
        $hierarch = array('1' => 'Público');
        $section_array = Doctrine::getTable('PizarraSection')->getSectionList();
        $hierarch = array_merge($hierarch, Doctrine::getTable('Jerarquia')->getHierarchyList());
        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 150, 'class' => 'tamano_70_c'));
        $this->widgetSchema['text'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'max_length' => 3000), array('maxlength' => 3000));
        //$this->widgetSchema['seccion'] = new sfWidgetFormChoice(array('choices' =>  Pizarra::getSectionList() ));
        $this->widgetSchema['seccion'] = new sfWidgetFormChoice(array('choices' => $section_array, 'multiple' => true, 'expanded' => true));
        $this->widgetSchema['visibilidad'] = new sfWidgetFormChoice(array('choices' => $hierarch));
        $this->widgetSchema['velocidad'] = new sfWidgetFormChoice(array('choices' => array(10000 => '10 segundos', 30000 => '30 segundos', 60000 => '60 segundos')));
        $this->widgetSchema['desde'] = new sfWidgetFormDateTime(array('format' => '%date% %time%'), array('disabled' => 'disabled'));
        $this->widgetSchema['hasta'] = new sfWidgetFormDateTime(array('format' => '%date% %time%'));
        $this->widgetSchema['days'] = new sfWidgetFormChoice(array('choices' => $days_array, 'multiple' => true, 'expanded' => true));
        $this->widgetSchema['months'] = new sfWidgetFormChoice(array('choices' => $months_array, 'multiple' => true, 'expanded' => true), array('class' => 'month'));

        $this->validatorSchema['text'] = new sfValidatorString(array('max_length' => 3000, 'required' => true), array('max_length' => __('Has superado el espacio permitido para tu mensaje.'), 'required' => __('Necesitas incluir un mensaje.')));
        $this->validatorSchema['seccion'] = new sfValidatorChoice(array('choices' => array_keys($section_array), 'required' => true, 'multiple' => true), array('required' => __('Necesitas seleccionar al menos una sección para publicar el mensaje.')));
        $this->validatorSchema['name'] = new sfValidatorString(array('max_length' => 150, 'required' => true), array('required' => __('Necesitas incluir un titular.')));
        $this->validatorSchema['desde'] = new sfValidatorDateTime(array('required' => true), array('required' => __('Necesitas incluir una fecha de inicio.'), 'invalid' => __('Necesitas incluir una fecha y hora de finalización.')));
        $this->validatorSchema['hasta'] = new sfValidatorDateTime(array('required' => true), array('required' => __('Necesitas incluir una fecha de finalización.'), 'invalid' => __('Necesitas incluir una fecha y hora de finalización.')));
        $this->validatorSchema['days'] = new sfValidatorChoice(array('choices' => array_keys($days_array), 'required' => true, 'multiple' => true), array('required' => __('Necesitas seleccionar al menos un día de la semana.')));
        $this->validatorSchema['months'] = new sfValidatorChoice(array('choices' => array_keys($months_array), 'required' => true, 'multiple' => true), array('required' => __('Necesitas seleccionar al menos un mes del año.')));

        $this->setDefault('desde', date('Y-m-d'));
        $this->setDefault('seccion', array(1, 2, 3, 4, 5, 6, 7, 8, 9));
        $this->setDefault('days', array(1, 2, 3, 4, 5, 6, 7, 8, 9));
        $this->setDefault('months', array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12));
        //$this->setDefaultValues('hasta', date('Y-m-d H:i:s',strtotime(date('Y-m-d'))+157680000));
    }

    public function setDefaultValues($field, $value) {
        $this->setDefault($field, $value);
    }

}
