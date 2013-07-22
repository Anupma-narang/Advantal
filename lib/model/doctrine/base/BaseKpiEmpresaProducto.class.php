<?php

/**
 * BaseKpiEmpresaProducto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $kpi_id
 * @property integer $empresa_id
 * @property integer $producto_id
 * @property integer $suma_valores
 * @property integer $numero_valores
 * @property string $nombre
 * @property Empresa $Empresa
 * @property Producto $Producto
 * @property Kpi $Kpi
 * 
 * @method integer            getKpiId()          Returns the current record's "kpi_id" value
 * @method integer            getEmpresaId()      Returns the current record's "empresa_id" value
 * @method integer            getProductoId()     Returns the current record's "producto_id" value
 * @method integer            getSumaValores()    Returns the current record's "suma_valores" value
 * @method integer            getNumeroValores()  Returns the current record's "numero_valores" value
 * @method string             getNombre()         Returns the current record's "nombre" value
 * @method Empresa            getEmpresa()        Returns the current record's "Empresa" value
 * @method Producto           getProducto()       Returns the current record's "Producto" value
 * @method Kpi                getKpi()            Returns the current record's "Kpi" value
 * @method KpiEmpresaProducto setKpiId()          Sets the current record's "kpi_id" value
 * @method KpiEmpresaProducto setEmpresaId()      Sets the current record's "empresa_id" value
 * @method KpiEmpresaProducto setProductoId()     Sets the current record's "producto_id" value
 * @method KpiEmpresaProducto setSumaValores()    Sets the current record's "suma_valores" value
 * @method KpiEmpresaProducto setNumeroValores()  Sets the current record's "numero_valores" value
 * @method KpiEmpresaProducto setNombre()         Sets the current record's "nombre" value
 * @method KpiEmpresaProducto setEmpresa()        Sets the current record's "Empresa" value
 * @method KpiEmpresaProducto setProducto()       Sets the current record's "Producto" value
 * @method KpiEmpresaProducto setKpi()            Sets the current record's "Kpi" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseKpiEmpresaProducto extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('kpi_empresa_producto');
        $this->hasColumn('kpi_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('empresa_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('producto_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('suma_valores', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('numero_valores', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('nombre', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Empresa', array(
             'local' => 'empresa_id',
             'foreign' => 'id'));

        $this->hasOne('Producto', array(
             'local' => 'producto_id',
             'foreign' => 'id'));

        $this->hasOne('Kpi', array(
             'local' => 'kpi_id',
             'foreign' => 'id'));
    }
}