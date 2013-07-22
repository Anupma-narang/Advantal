<?php

/**
 * BaseComentarioListaNegra
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $comentario
 * @property integer $sf_guard_user_id
 * @property integer $producto_id
 * @property integer $empresa_id
 * @property boolean $aprobado
 * @property Producto $Producto
 * @property Empresa $Empresa
 * @property sfGuardUser $User
 * 
 * @method string               getComentario()       Returns the current record's "comentario" value
 * @method integer              getSfGuardUserId()    Returns the current record's "sf_guard_user_id" value
 * @method integer              getProductoId()       Returns the current record's "producto_id" value
 * @method integer              getEmpresaId()        Returns the current record's "empresa_id" value
 * @method boolean              getAprobado()         Returns the current record's "aprobado" value
 * @method Producto             getProducto()         Returns the current record's "Producto" value
 * @method Empresa              getEmpresa()          Returns the current record's "Empresa" value
 * @method sfGuardUser          getUser()             Returns the current record's "User" value
 * @method ComentarioListaNegra setComentario()       Sets the current record's "comentario" value
 * @method ComentarioListaNegra setSfGuardUserId()    Sets the current record's "sf_guard_user_id" value
 * @method ComentarioListaNegra setProductoId()       Sets the current record's "producto_id" value
 * @method ComentarioListaNegra setEmpresaId()        Sets the current record's "empresa_id" value
 * @method ComentarioListaNegra setAprobado()         Sets the current record's "aprobado" value
 * @method ComentarioListaNegra setProducto()         Sets the current record's "Producto" value
 * @method ComentarioListaNegra setEmpresa()          Sets the current record's "Empresa" value
 * @method ComentarioListaNegra setUser()             Sets the current record's "User" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseComentarioListaNegra extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('comentario_lista_negra');
        $this->hasColumn('comentario', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('sf_guard_user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('producto_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('empresa_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('aprobado', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Producto', array(
             'local' => 'producto_id',
             'foreign' => 'id'));

        $this->hasOne('Empresa', array(
             'local' => 'empresa_id',
             'foreign' => 'id'));

        $this->hasOne('sfGuardUser as User', array(
             'local' => 'sf_guard_user_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}