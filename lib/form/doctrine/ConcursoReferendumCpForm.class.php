<?php

/**
 * ConcursoReferendumCp form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ConcursoReferendumCpForm extends BaseConcursoReferendumCpForm {

    public function configure() {
        unset($this["created_at"], $this["updated_at"]);
        $this->widgetSchema["value"] = new sfWidgetFormChoice(array("choices" => $this->getOption('valores'), "expanded" => "true"));

        //$concursoid = sfContext::getInstance()->getRequest()->getParameter("concurso_id");
        $this->setDefault("concurso_cp_id", $this->getOption('concursocp'));
        $this->widgetSchema["concurso_cp_id"] = new sfWidgetFormInputHidden();

        //$contribucionid = sfContext::getInstance()->getRequest()->getParameter("contribucion_id");
        $this->setDefault("contribucion_cp_id", $this->getOption('contribucioncp'));
        $this->widgetSchema["contribucion_cp_id"] = new sfWidgetFormInputHidden();

        //$this->widgetSchema->setNameFormat('concurso_referendum[%s]');
        $this->widgetSchema->setNameFormat($this->getOption('contribucioncp') . '_concurso_referendum_cp[%s]');
    }

}
