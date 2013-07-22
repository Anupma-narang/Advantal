<?php

class renderer_votos extends sfWidgetForm {

    protected function configure($options = array(), $attributes = array()) {
        $this->addRequiredOption('choices');
        $this->addRequiredOption('contribucion_id');
    }

    public function render($name, $value = null, $attributes = array(), $errors = array()) {
        $choices = $this->getOption('choices')->call();
        $result = '<ul class="radio_list">';
        foreach ($choices as $choice) {
            $result .= '<li class="concurso_referendum_' . $choice . '">';
            $result .= '<input class="concurso_referendum_value_' . $choice . '" type="radio" value="' . $choice . '" name="' . $this->getOption('contribucion_id') . '_concurso_referendum[value]">';
            $result .= '<label for="' . $this->getOption('contribucion_id') . '_concurso_referendum_value_' . $choice . '">' . $choice . '</label>';
            $result .='</li>';
        }
        return $result .= '</ul>';
    }

}

class ConcursoReferendumForm extends BaseConcursoReferendumForm {

    public function configure() {
        $id = $this->getOption('contribucion_id');
        $choices = $this->getOption('choices', array_combine(range(1, 5), range(1, 5)));
        $this->useFields(array('contribucion_id', 'value'));

        $this->widgetSchema->setNameFormat($id . '_concurso_referendum[%s]');
        $this->widgetSchema['value'] = new sfWidgetFormChoice(array('renderer_class' => 'renderer_votos', 'renderer_options' => array('contribucion_id' => $id), 'choices' => $choices, 'expanded' => 'true'), array());
        $this->widgetSchema['contribucion_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['value'] = new sfValidatorChoice(array('choices' => $choices, 'required' => true));
        $this->validatorSchema['contribucion_id'] = new sfValidatorPass();
        $this->setDefault('contribucion_id', $id);
    }

    public function updateObject($values = null) {
        parent::updateObject($values);

        $contribucion = ContribucionTable::getInstance()->find($this->getObject()->getContribucionId());
        if ($contribucion) {
            $this->getObject()->setUserId(sfContext::getInstance()->getUser()->getGuardUser()->getId());
            $this->getObject()->setConcursoId($contribucion->getConcursoId());
        }
    }

}
