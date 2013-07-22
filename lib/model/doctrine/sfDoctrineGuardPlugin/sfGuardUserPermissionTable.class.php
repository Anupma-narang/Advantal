<?php

/**
 * sfGuardUserPermissionTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class sfGuardUserPermissionTable extends PluginsfGuardUserPermissionTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object sfGuardUserPermissionTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('sfGuardUserPermission');
    }
    public function isSuperAdminExist(){
      //create query
      $query = Doctrine_Query::create()
                ->select('sgup.user_id, sgp.id superadmin')
                ->from('sfGuardUserPermission sgup')
                ->leftJoin('sgup.Permission sgp')
                ->where('sgp.name = "Superadministrador"');
      $record = $query->fetchOne(null, Doctrine::HYDRATE_ARRAY);
      return $record;
    }
}