<?php

/**
 * ListaCuestionarioPregunta form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ListaCuestionarioUserRespuestaForm extends BaseListaCuestionarioRespuestaForm
{

    public function configure()
    {
        unset($this['created_at'], $this['updated_at'], $this['updated_by'], $this['created_by'],
        $this['lista_cuestionario_pregunta_id'], $this['empresa_id'], $this['lista_cuestionario_user_id']);

        $pregunta = $this->options['pregunta'];

        switch ($pregunta->getTipo()) {
            case 'opcion':
                $option_values = array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5);
                $this->widgetSchema['respuesta'] = new sfWidgetFormChoice(array('choices' => $option_values, 'expanded' => true));
                $this->validatorSchema['respuesta'] = new sfValidatorInteger(
                    array('required' => true, 'max' => 5, 'min' => 1),
                    array('required' => 'Es necesario responder esta pregunta.'));
                break;

            case 'sino':
                $option_values = array(5 => 'Si', 1 => 'No');
                $this->widgetSchema['respuesta'] = new sfWidgetFormChoice(array('choices' => $option_values, 'expanded' => true));
                $this->validatorSchema['respuesta'] = new sfValidatorInteger(array('required' => true, 'max' => 5, 'min' => 1));

                break;
            case 'texto':
                $this->widgetSchema['respuesta'] = new sfWidgetFormTextareaCKEditor(array('width' => ((sfConfig::get("sf_app") == "backend") ? 600 : 510), 'height' => 200, 'err_id' => 'error_max_length', 'max_length' => 3000));
                $this->validatorSchema['respuesta'] = new sfValidatorPass();

                break;

            default:
                throw new sfException (sprintf('No está definido el formulario para el tipo de pregunta "%s"', $pregunta->getTipo()));
                break;

        }
        $this->widgetSchema['respuesta']->setLabel($pregunta->getPreguntaString());
        $this->widgetSchema->setFormFormatterName('list');
    }


}
