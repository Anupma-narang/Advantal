<?php

class ContribucionForm extends BaseContribucionForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $this->disableCSRFProtection();
        $this->useFields(array('resumen', 'plan_accion', 'contribucion_estado_id', 'name'));

        $this->widgetSchema['contribucion_estado_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['contribucion_estado_id'] = new sfValidatorPass();
        $this->setDefault('contribucion_estado_id', 1);

        $this->widgetSchema['plan_accion'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_plan_accion', 'max_length' => 43000));
        $this->validatorSchema['plan_accion'] = new sfValidatorString(
                array('required' => true, 'max_rep_length' => 80000), array('required' => 'Necesitas incluir un Plan de acción.', 'max_rep_length' => 'Has superado el espacio permitido para tu Plan de acción'));

        $this->widgetSchema['resumen'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_resumen', 'max_length' => 1000));
        $this->validatorSchema['resumen'] = new sfValidatorString(
                array('max_rep_length' => 2000, 'required' => true), array(
            'max_rep_length' => 'Has superado el espacio permitido para el resumen de tu Plan de acción.',
            'required' => 'Necesitas incluir un resumen de tu Plan de acción.'));

        $this->widgetSchema['name'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['name']->setOption('required', false);

        $this->widgetSchema->setLabels(array(
            'plan_accion' => __('Plan de acción*'),
            'resumen' => __('Resumen del Plan de acción*')
        ));
    }

}

class ContribucionFormUno extends BaseContribucionForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        unset($this['created_at'], $this['updated_at'], $this['principal'], $this['user_id']);

        $this->widgetSchema['contribucion_estado_id'] = new sfWidgetFormInputHidden();
        $this->setDefault('contribucion_estado_id', 1);

        $this->widgetSchema['concurso_id'] = new sfWidgetFormInputHidden();
        $this->setDefault('concurso_id', $this->getOption('concurso_id'));

        $this->widgetSchema['incidencia'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300));
        $this->validatorSchema['incidencia'] = new sfValidatorString(array('max_rep_length' => 25000), array('max_rep_length' => 'Has superado el espacio permitido para la descripción de la incidencia.'));
        $this->validatorSchema['incidencia']->setMessage('required', 'No has incluido una descripción de la incidencia.');

        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_60_c'));
        $this->validatorSchema['name'] = new sfValidatorString(array('max_length' => 100), array('required' => 'No has incluido un título de la incidencia.'));

        $this->widgetSchema['plan_accion'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_plan_accion', 'max_length' => 43000));
        $this->validatorSchema['plan_accion'] = new sfValidatorString(array('required' => true, 'max_rep_length' => 80000), array('required' => 'No has incluido tu Plan de acción.', 'max_rep_length' => 'Has superado el espacio permitido para tu Plan de acción'));

        $this->widgetSchema['resumen'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_resumen', 'max_length' => 1000));
        $this->validatorSchema['resumen'] = new sfValidatorString(array('max_rep_length' => 2000, 'required' => true), array('max_rep_length' => 'Has superado el espacio permitido para el resumen de tu Plan de acción.', 'required' => 'No has incluido el resumen de tu Plan de acción.'));

        $this->widgetSchema['borrador'] = new sfWidgetFormInputCheckbox(array('label' => 'Pincha aquí si quieres guardar esta contribucion como borrador.', 'value_attribute_value' => 'borrador'));
        $this->validatorSchema['borrador'] = new sfValidatorPass();

        $this->widgetSchema['destacado'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['destacado'] = new sfValidatorBoolean(array('required' => false));

        for ($i = 1; $i <= 5; $i++) {
            $this->embedForm('archivo_' . $i, new ContribucionArchivoForm(new ContribucionArchivo()));
        }

        $this->validatorSchema->setPreValidator(new sfValidatorCallback(array('callback' => array($this, 'preValidate'))));

        $this->widgetSchema->setLabels(array(
            'name' => __('Título de la incidencia*'),
            'destacado' => __('Destacada'),
            'incidencia' => __('Descripción de la incidencia*'),
            'plan_accion' => __('Plan de acción*'),
            'resumen' => __('Resumen del Plan de acción*')
        ));
    }

    public function doBind(array $values) {
        if (isset($values["borrador"])) {
            $values["contribucion_estado_id"] = 3;
        } //else {
        //$values["contribucion_estado_id"] = 1;
        //}

        return parent::doBind($values);
    }

    public function preValidate($validator, $values) {
        if (isset($values['borrador'])) {
            $this->getValidator('plan_accion')->setOption('required', false);
            $this->getValidator('resumen')->setOption('required', false);
            $this->getValidator('incidencia')->setOption('required', false);
        }
    }

    public function saveEmbeddedForms($con = null, $forms = null) {
        if (null === $con) {
            $con = $this->getConnection();
        }

        if (null === $forms) {
            $forms = $this->embeddedForms;
        }
        foreach ($forms as $id_form => $form) {
            if ($form instanceof ContribucionArchivoForm) {
                $values = $this->getValues();
                if ($form->getObject()->getFile() && $values[$id_form]['status'] == TRUE) {
                    $upload = $form->getObject()->getFile();
                    if ($upload instanceof sfValidatedFile) {
                        $filename = sha1($upload->getOriginalName() . microtime() . rand()) . $upload->getExtension($upload->getOriginalExtension());
                        $upload->save(sfConfig::get('sf_images_dir') . '/documents/' . $filename);
                        $form->getObject()->setContribucionId($this->getObject()->getId()); //sfContext::getInstance()->getRequest()->getParameter('id'));
                        $form->getObject()->setFile($filename);
                        $form->getObject()->save($con);
                    }
                }
            } elseif ($form instanceof sfFormObject) {
                $form->getObject()->setPrincipal(1);
                $form->getObject()->setUserId(sfContext::getInstance()->getUser()->getGuardUser()->getId());
                $form->getObject()->save($con);
                $form->saveEmbeddedForms($con);
            } else {
                $this->saveEmbeddedForms($con, $form->getEmbeddedForms());
            }
        }
        /* foreach ($forms as $form) {
          if ($form instanceof sfFormObject) {
          if ($form->getObject()->getFile()) {
          $form->getObject()->setContribucionId($this->getObject()->getId());
          $form->getObject()->save($con);
          }
          } else {
          $this->saveEmbeddedForms($con, $form->getEmbeddedForms());
          }
          } */
    }

    public function save($con = null) {
        $this->getObject()->setPrincipal(0);
        $this->getObject()->setUserId(sfContext::getInstance()->getUser()->getGuardUser()->getId());
        return parent::save($con);
    }

}
