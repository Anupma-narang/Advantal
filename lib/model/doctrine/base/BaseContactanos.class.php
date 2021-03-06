<?php

/**
 * BaseContactanos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $status
 * @property integer $user_id
 * @property string $nombre
 * @property string $apellido1
 * @property string $apellido2
 * @property string $email
 * @property string $phone
 * @property string $comentario
 * @property string $fichero1
 * @property string $fichero2
 * @property string $fichero3
 * @property string $fichero4
 * @property string $fichero5
 * @property string $logo
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property sfGuardUser $sfGuardUser
 * 
 * @method integer     getStatus()      Returns the current record's "status" value
 * @method integer     getUserId()      Returns the current record's "user_id" value
 * @method string      getNombre()      Returns the current record's "nombre" value
 * @method string      getApellido1()   Returns the current record's "apellido1" value
 * @method string      getApellido2()   Returns the current record's "apellido2" value
 * @method string      getEmail()       Returns the current record's "email" value
 * @method string      getPhone()       Returns the current record's "phone" value
 * @method string      getComentario()  Returns the current record's "comentario" value
 * @method string      getFichero1()    Returns the current record's "fichero1" value
 * @method string      getFichero2()    Returns the current record's "fichero2" value
 * @method string      getFichero3()    Returns the current record's "fichero3" value
 * @method string      getFichero4()    Returns the current record's "fichero4" value
 * @method string      getFichero5()    Returns the current record's "fichero5" value
 * @method string      getLogo()        Returns the current record's "logo" value
 * @method timestamp   getCreatedAt()   Returns the current record's "created_at" value
 * @method timestamp   getUpdatedAt()   Returns the current record's "updated_at" value
 * @method sfGuardUser getSfGuardUser() Returns the current record's "sfGuardUser" value
 * @method Contactanos setStatus()      Sets the current record's "status" value
 * @method Contactanos setUserId()      Sets the current record's "user_id" value
 * @method Contactanos setNombre()      Sets the current record's "nombre" value
 * @method Contactanos setApellido1()   Sets the current record's "apellido1" value
 * @method Contactanos setApellido2()   Sets the current record's "apellido2" value
 * @method Contactanos setEmail()       Sets the current record's "email" value
 * @method Contactanos setPhone()       Sets the current record's "phone" value
 * @method Contactanos setComentario()  Sets the current record's "comentario" value
 * @method Contactanos setFichero1()    Sets the current record's "fichero1" value
 * @method Contactanos setFichero2()    Sets the current record's "fichero2" value
 * @method Contactanos setFichero3()    Sets the current record's "fichero3" value
 * @method Contactanos setFichero4()    Sets the current record's "fichero4" value
 * @method Contactanos setFichero5()    Sets the current record's "fichero5" value
 * @method Contactanos setLogo()        Sets the current record's "logo" value
 * @method Contactanos setCreatedAt()   Sets the current record's "created_at" value
 * @method Contactanos setUpdatedAt()   Sets the current record's "updated_at" value
 * @method Contactanos setSfGuardUser() Sets the current record's "sfGuardUser" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseContactanos extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('contactanos');
        $this->hasColumn('status', 'integer', 5, array(
             'type' => 'integer',
             'default' => 1,
             'length' => 5,
             ));
        $this->hasColumn('user_id', 'integer', 7, array(
             'type' => 'integer',
             'notnull' => false,
             'length' => 7,
             ));
        $this->hasColumn('nombre', 'string', 70, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 70,
             ));
        $this->hasColumn('apellido1', 'string', 70, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 70,
             ));
        $this->hasColumn('apellido2', 'string', 70, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 70,
             ));
        $this->hasColumn('email', 'string', 70, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 70,
             ));
        $this->hasColumn('phone', 'string', 32, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 32,
             ));
        $this->hasColumn('comentario', 'string', 8300, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 8300,
             ));
        $this->hasColumn('fichero1', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('fichero2', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('fichero3', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('fichero4', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('fichero5', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('logo', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('created_at', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('updated_at', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));
    }
}