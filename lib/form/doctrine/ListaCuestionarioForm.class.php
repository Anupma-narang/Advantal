<?php

/**
 * ListaCuestionario form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ListaCuestionarioForm extends BaseListaCuestionarioForm {

    public function configure() {

        unset($this['created_at'], $this['updated_at']);
        $this->widgetSchema['nombre']->setAttributes(array('maxlength' => 70, 'style' => 'width:351px !important;'));

        $subform = new sfForm();
        $decorator = '<ul class="inline">%content%</ul>';

        $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'EmpresaSectorUno',
            //'table_method' => 'getSectoresUnoOrderByOrden',
            'label' => 'Sector',
            'add_empty' => 'Selecciona sector')
        );

        $this->validatorSchema['empresa_sector_uno_id']->setMessage('required', 'No has seleccionado un sector.');

        $this->widgetSchema['empresa_sector_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'EmpresaSectorDos',
            //'table_method' => 'getSectoresDosOrderByOrden',
            'depends' => 'EmpresaSectorUno',
            'ajax' => true,
            'add_empty' => 'Selecciona subsector ',
            'label' => 'Subsector'));
        $this->validatorSchema['empresa_sector_dos_id']->setMessage('required', 'No has seleccionado un subsector.');

        $this->widgetSchema['empresa_sector_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'EmpresaSectorTres',
            //'table_method' => 'getSectoresTresOrderByOrden',
            'depends' => 'EmpresaSectorDos',
            'ajax' => true,
            'add_empty' => 'Selecciona actividad ',
            'label' => 'Actividad'
        ));
        $this->validatorSchema['empresa_sector_tres_id']->setMessage('required', 'No has seleccionado una actividad.');


        $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProductoTipoUno',
            'order_by' => array('orden', 'asc'),
            'label' => 'Sector del producto',
            'add_empty' => 'Selecciona sector'
        ));
        $this->validatorSchema['producto_tipo_uno_id']->setMessage('required', 'No has seleccionado un sector.');


        $this->widgetSchema['producto_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProductoTipoDos',
            'depends' => 'ProductoTipoUno',
            'ajax' => true,
            'add_empty' => 'Selecciona subsector ',
            'label' => 'Subsector del producto')
        );
        $this->validatorSchema['producto_tipo_dos_id']->setMessage('required', 'No has seleccionado un subsector.');


        $this->widgetSchema['producto_tipo_tres_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => 'ProductoTipoTres',
            'depends' => 'ProductoTipoDos',
            'ajax' => true,
            'add_empty' => 'Selecciona tipo de producto',
            'label' => 'Tipo de producto'));

        $this->validatorSchema['producto_tipo_tres_id']->setMessage('required', 'No has seleccionado un tipo de producto.');

        $this->widgetSchema['tipo'] = new sfWidgetFormChoice(array(
            'choices' => ListaCuestionarioTable::$tipos)
        );
        $this->validatorSchema['tipo'] = new sfValidatorChoice(array(
            'choices' => array_keys(ListaCuestionarioTable::$tipos)
        ));
        if ($this->isNew()) {
            $max_questions = 13;
            for ($i = 1; $i <= $max_questions; $i++) {
                $pregunta = new ListaCuestionarioPregunta();
                $pregunta->Cuestionario = $this->getObject();

                $pregunta_form = new ListaCuestionarioPreguntaForm($pregunta);
                $subform->embedForm('Nº ' . $i, $pregunta_form, $decorator);
            }
            $this->embedForm('ListaCuestionarioPregunta', $subform);
        } else {
            $this->embedRelation('ListaCuestionarioPregunta', null, array(), $decorator);
        }
        $this->widgetSchema['ListaCuestionarioPregunta']->setLabel('<label id="Preguntas">Preguntas</label>');

        $this->getValidatorSchema()->setPreValidator(
                new sfValidatorCallback(array('callback' => array($this, 'validarEmpresaProducto')))
        );

        $this->validatorSchema->setPostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'validarNumeroKpi')))
        );

        $this->validatorSchema['nombre']->setMessage('required', 'Necesitas incluir un título.');
    }

    public function validarEmpresaProducto($validator, $values) {
        $errorSchema = new sfValidatorErrorSchema($validator);
        $required = array();
        switch ($values['tipo']) {
            case 'empresa':
                array_push($required, 'empresa_sector_uno_id', 'empresa_sector_dos_id');
                $empresaSectorDosValue = $values['empresa_sector_dos_id'];
                if (EmpresaSectorDosTable::hasActividad($empresaSectorDosValue) || null == $empresaSectorDosValue) {
                    array_push($required, 'empresa_sector_tres_id');
                }

                foreach ($required as $field) {
                    $this->validatorSchema[$field]->setOption('required', true);

                    try {
                        if (isset($values[$field])) {
                            $this->validatorSchema[$field]->clean($values[$field]);
                        }
                    } catch (sfValidatorErrorSchema $e) {
                        $errorSchema->addErrors($e);
                    } catch (sfValidatorError $e) {
                        $errorSchema->addError($e, $field);
                    }
                }

                break;

            case 'producto':
                array_push($required, 'producto_tipo_uno_id', 'producto_tipo_dos_id');
                $empresaSectorDosValue = $values['producto_tipo_dos_id'];
                if (ProductoTipoDosTable::hasActividad($empresaSectorDosValue) || null == $empresaSectorDosValue) {
                    array_push($required, 'producto_tipo_tres_id');
                }

                foreach ($required as $field) {
                    $this->validatorSchema[$field]->setOption('required', true);

                    try {
                        if (isset($values[$field])) {
                            $this->validatorSchema[$field]->clean($values[$field]);
                        }
                    } catch (sfValidatorErrorSchema $e) {
                        $errorSchema->addErrors($e);
                    } catch (sfValidatorError $e) {
                        $errorSchema->addError($e, $field);
                    }
                }

                break;
        }
        if (count($errorSchema)) {
            //en alguna parte se me lanza el error schema... :( y no veo donde. Por lo tanto, para no duplicar no lanzo nada
//            throw $errorSchema;
        }
    }

    public function validarNumeroKpi($validator, $values) {
        $minKpi = sfConfig::get('app_cuestionarios_min_kpi', 7);

        if (empty($values['ListaCuestionarioPregunta']))
            return $values;
        $nbKpi = 0;
        foreach ($values['ListaCuestionarioPregunta'] as $pregunta) {
            if (!is_null($pregunta['kpi_id'])) {
                $nbKpi++;
            }
        }

        if ($nbKpi < $minKpi) {
            $error = new sfValidatorError($validator, 'Necesitas incluir 7 KPIs o más.');
            $this->getErrorSchema()->addError($error, 'ListaCuestionarioPregunta');
            throw $this->getErrorSchema();
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
        if ($this->isNew()) {
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
        } else {
            parent::saveEmbeddedForms($con, $forms);
        }
    }

}