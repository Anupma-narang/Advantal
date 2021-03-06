<?php

/**
 * BaseProductContestFavouriteList
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $contest_id
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property sfGuardUser $sfGuardUser
 * @property Concurso $Concurso
 * 
 * @method integer                     getUserId()      Returns the current record's "user_id" value
 * @method integer                     getContestId()   Returns the current record's "contest_id" value
 * @method timestamp                   getCreatedAt()   Returns the current record's "created_at" value
 * @method timestamp                   getUpdatedAt()   Returns the current record's "updated_at" value
 * @method sfGuardUser                 getSfGuardUser() Returns the current record's "sfGuardUser" value
 * @method Concurso                    getConcurso()    Returns the current record's "Concurso" value
 * @method ProductContestFavouriteList setUserId()      Sets the current record's "user_id" value
 * @method ProductContestFavouriteList setContestId()   Sets the current record's "contest_id" value
 * @method ProductContestFavouriteList setCreatedAt()   Sets the current record's "created_at" value
 * @method ProductContestFavouriteList setUpdatedAt()   Sets the current record's "updated_at" value
 * @method ProductContestFavouriteList setSfGuardUser() Sets the current record's "sfGuardUser" value
 * @method ProductContestFavouriteList setConcurso()    Sets the current record's "Concurso" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProductContestFavouriteList extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('product_contest_favourite_list');
        $this->hasColumn('user_id', 'integer', 7, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 7,
             ));
        $this->hasColumn('contest_id', 'integer', 7, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 7,
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
             'onUpdate' => 'CASCADE'));

        $this->hasOne('Concurso', array(
             'local' => 'contest_id',
             'foreign' => 'id'));
    }
}