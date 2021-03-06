<?php

/**
 * OrderPreferencesTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class OrderPreferencesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object OrderPreferencesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('OrderPreferences');
    }

    public static function setOrder($user, $key, $values)
    {
        $orderPreference = self::getInstance()->createQuery('q')
            ->where('q.sf_guard_user_id = ?', $user->getId())
            ->andWhere('q.key_id = ?', $key)
            ->fetchOne();

        if (!$orderPreference) {
            $orderPreference = new OrderPreferences();
            $orderPreference->setUser($user);
            $orderPreference->setKeyId($key);
        }

        $orderPreference->setOrden(serialize($values));
        $orderPreference->save();

    }

    public static function getOrder($user, $key)
    {
        $q =  self::getInstance()->createQuery('q')
            ->where('q.sf_guard_user_id = ?', $user->getId())
            ->andWhere('q.key_id = ?', $key);
        return $q->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY_SHALLOW);
    }

}
