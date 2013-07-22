<?php

/**
 * Producto filter form.
 *
 * @package    auditoscopia
 * @subpackage filter
 * @author     Slx
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ListaNegraProductoFormFilter extends BaseProductoFormFilter
{
    public function configure()
    {
        sfApplicationConfiguration::getActive()->loadHelpers(array('Url'));

        $this->widgetSchema['name'] = new audWidgetFormJQueryAutocompleterInField(array(
            'url' => url_for('@producto_autocomplete?field=name&lista=ln')
        ));
        $this->widgetSchema['marca'] = new audWidgetFormJQueryAutocompleterInField(array(
            'url' => url_for('@producto_autocomplete?field=marca&lista=ln')
        ));
        $this->widgetSchema['modelo'] = new audWidgetFormJQueryAutocompleterInField(array(
            'url' => url_for('@producto_autocomplete?field=modelo&lista=ln')
        ));


        $this->widgetSchema->setLabels(array(
            'name' => 'Producto',
        ));
//        $this->useFields(array('name', 'marca', 'modelo'));
        $this->disableLocalCSRFProtection();

    }

    public function addNameColumnQuery(Doctrine_Query $query, $field, $values)
    {
        if ($values != null) {
            $query->addWhere($query->getRootAlias() . '.name LIKE ?', '%' . $values . '%');
        }
    }
    public function addModeloColumnQuery(Doctrine_Query $query, $field, $values)
    {
        if ($values != null) {
            $query->addWhere($query->getRootAlias() . '.modelo LIKE ?', '%' . $values . '%');
        }
    }
    public function addMarcaColumnQuery(Doctrine_Query $query, $field, $values)
    {
        if ($values != null) {
            $query->addWhere($query->getRootAlias() . '.marca LIKE ?', '%' . $values . '%');

        }
    }

}