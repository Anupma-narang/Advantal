<?php

/**
 * Pd form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PdForm extends BasePdForm {

    public function configure() {
        unset($this["created_at"], $this["updated_at"]);

        $this->widgetSchema['profesional_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProfesionalTipoDos',
            'depends' => 'ProfesionalTipoUno',
            'add_empty' => 'Selecciona Actividad'));

        $this->widgetSchema['profesional_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProfesionalTipoTres',
            'depends' => 'ProfesionalTipoDos',
            'add_empty' => 'Selecciona Actividad'));

        $this->widgetSchema->setLabels(array('name' => 'Nombre',
            'road_type_id' => 'Tipo de vía',
            'codigopostal' => 'Código postal',
            'profesional_tipo_uno_id' => 'Categoría I',
            'profesional_tipo_dos_id' => 'Categoría II',
            'profesional_tipo_tres_id' => 'Categoría III'
        ));

        $this->widgetSchema["name"]->setAttribute('class', "inputText");
        $this->widgetSchema["direccion"]->setAttribute('class', "inputText");
        $this->widgetSchema["localidad"]->setAttribute('class', "inputText");
    }

}