<?php

/**
 * Kpi filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class KpiFormFilter extends BaseKpiFormFilter
{
    public function configure()
    {
        sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'I18N'));
        $this->widgetSchema['tipo'] = new sfWidgetFormChoice(array(
                'choices' => ListaCuestionarioTable::$tipos
        ));

        $this->validatorSchema['tipo'] = new sfValidatorChoice(array(
            'choices' => array_keys(ListaCuestionarioTable::$tipos),
            'required' => false
        ));
    }

    public function getFields()
    {
        return array(
            'id'     => 'Number',
            'nombre' => 'Text',
            'tipo'   => 'Enum',
        );
    }
}
