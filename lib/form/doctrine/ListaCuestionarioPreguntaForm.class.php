<?php

/**
 * ListaCuestionarioPregunta form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'Tag'));

class ListaCuestionarioPreguntaForm extends BaseListaCuestionarioPreguntaForm {

    static $tipo_pregunta = array('opcion' => 'Opción', 'texto' => 'Texto', 'sino' => 'Si / No');

    public function configure() {

        unset($this['position'], $this['lista_cuestionario_id']);

        $this->widgetSchema['tipo'] = new sfWidgetFormChoice(array(
            'choices' => self::$tipo_pregunta
        ));

        $this->widgetSchema['kpi_id'] = new audWidgetFormDoctrineJQueryAutocompleter(array(
            'model' => 'Kpi',
            'label' => 'KPI',
            'url' => url_for('kpi_autocomplete', array('id' => $this->getObject()->getId())),
            'add_url' => url_for('kpi_add_empresa', array('id' => $this->getObject()->getId()))
                ), array('maxlength' => 70, 'style' => 'width: 176px !important;'));

        $this->widgetSchema['pregunta'] = new audWidgetFormDoctrineJQueryAutocompleter(array(
            'model' => 'ListaCuestionarioPregunta',
            'label' => 'Pregunta',
            'url' => url_for('pregunta_autocomplete', array('id' => $this->getObject()->getId())),
            'add_url' => url_for('pregunta_add_empresa', array('id' => $this->getObject()->getId()))
                ), array('maxlength' => 70, 'style' => 'width: 281px !important;'));

        $this->getWidgetSchema()->setFormFormatterName('list');
    }

}