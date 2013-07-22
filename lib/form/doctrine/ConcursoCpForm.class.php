<?php

/**
 * ConcursoCp form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ConcursoCpForm extends BaseConcursoCpForm {

    public function configure() {
        unset($this["created_at"], $this["updated_at"], $this["fecha_referendum"]);

        $this->widgetSchema["concurso_categoria_id"] = new sfWidgetFormDoctrineChoice(array("model" => $this->getRelatedModelName("ConcursoCategoria"),
            "add_empty" => true, "table_method" => "selectCategoriaCp"));

        if ($this->isNew()) {
            $this->widgetSchema["fecha_activacion"] = new sfWidgetFormInputHidden();
            $this->setDefault("fecha_activacion", date("Y-m-d"));

            $this->setDefault("user_id", sfContext::getInstance()->getRequest()->getParameter("user_id"));
            $this->setDefault("concurso_estado_id", 2);
        } else {
            unset($this["fecha_activacion"]);
        }
        $this->widgetSchema["concurso_estado_id"] = new sfWidgetFormInputHidden();


        $this->widgetSchema["user_id"] = new sfWidgetFormInputHidden();



        //$this->widgetSchema['states_id'] = new sfWidgetFormDoctrineChoice(array(
        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => 'States',
            'order_by' => array('orden', 'asc'),
            'add_empty' => 'Seleccione Provincia'));

        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'City',
            'depends' => 'States',
            'add_empty' => 'Selecciona Localidad',
            'ajax' => true));

        if ($this->isNew()) {
            $contribucion = new ContribucionCp();
            $contribucion->ConcursoCp = $this->getObject();
            $formulario = new ContribucionCpConcursoForm($contribucion);
            $this->embedForm("contribucioncp", $formulario);
        } else {
            $this->embedRelation("ContribucionCp", "ContribucionCpConcursoForm");
        }
    }

}
