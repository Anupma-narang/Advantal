<?php

/**
 * ListaCuestionario form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ListaCuestionarioNegraForm extends BaseListaCuestionarioForm {

    public function configure() {

        unset($this['created_at'], $this['updated_at']);
        $this->widgetSchema['nombre']->setAttribute('size', 60);

        $subform = new sfForm();
        $decorator = '<ul class="inline">%content%</ul>';
        $this->widgetSchema['empresa_sector_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'EmpresaSectorDos',
            //'table_method' => 'getSectoresDosOrderByOrden',
            'depends' => 'EmpresaSectorUno',
            'ajax' => true,
            'add_empty' => 'Selecciona Empresa '));

        $this->widgetSchema['empresa_sector_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'EmpresaSectorTres',
            //'table_method' => 'getSectoresTresOrderByOrden',
            'depends' => 'EmpresaSectorDos',
            'ajax' => true,
            'add_empty' => 'Selecciona Empresa '));

        $this->widgetSchema['tipo'] = new sfWidgetFormChoice(array(
            'choices' => ListaCuestionarioTable::$tipos)
        );
        $this->validatorSchema['tipo'] = new sfValidatorChoice(array(
            'choices' => array_keys(ListaCuestionarioTable::$tipos)
        ));
        if ($this->isNew()) {
            $max_questions = 1;

            for ($i = 1; $i <= $max_questions; $i++) {
                $pregunta = new ListaCuestionarioPregunta();
                $pregunta->Cuestionario = $this->getObject();

                $pregunta_form = new ListaCuestionarioPreguntaForm($pregunta);
                $subform->embedForm('Núm ' . $i, $pregunta_form, $decorator);
            }
            $this->embedForm('ListaCuestionarioPregunta', $subform);
        } else {
            $this->embedRelation('ListaCuestionarioPregunta', null, array(), $decorator, '<div>%content%</div>');
            $this->widgetSchema['ListaCuestionarioPregunta']->setLabel('Preguntas');
        }
    }

    public function validarNumeroKpi($validator, $values) {
        $minKpi = sfConfig::get('app_cuestionarios_min_kpi', 0);

        if (empty($values['ListaCuestionarioPregunta']))
            return $values;
        $nbKpi = 0;
        foreach ($values['ListaCuestionarioPregunta'] as $pregunta) {
            if (!is_null($pregunta['kpi_id'])) {
                $nbKpi++;
            }
        }

        if ($nbKpi < $minKpi) {
            $error = new sfValidatorError($validator, 'Necesitas incluir 7 KPIs o más');
            throw new sfValidatorErrorSchema($validator, array('lista_cuestionario_pregunta' => $error));
        }

        return $values;
    }

    /**
     * Bug debido a que el sistema graba dos veces las preguntas en estar en un subform... esto no debería
     * pasar pero no veo la razón...  o sea que modifico el saveEmbeddedForm... :(
     *
     * @param mixed $con   An optional connection object
     * @param array $forms An array of forms
     */
    public function saveEmbeddedForms($con = null, $forms = null) {
        if (null === $con) {
            $con = $this->getConnection();
        }

        if (null === $forms) {
            $forms = $this->embeddedForms;
        }

        foreach ($forms as $form) {
            if ($form instanceof sfFormObject) {
                $form->getObject()->save($con);
                $form->saveEmbeddedForms($con);
            }
        }
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {
        if ($taintedValues['lista'] == 'ln') {

        }
        parent::bind($taintedValues, $taintedFiles);
    }

}
