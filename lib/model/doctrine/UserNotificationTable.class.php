<?php

/**
 * UserNotificationTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class UserNotificationTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object UserNotificationTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('UserNotification');
    }

    /**
     * Returns an instance of this class.
     *
     * @return object UserNotificationTable
     */
    public static function isActiveNotification($field, $userId)
    {
        $notification = Doctrine::getTable('UserNotification')
            ->createQuery('U')
            ->where('U.'.$field.' = 1')
            ->andWhere('U.user_id = ?', $userId)
            ->execute();
        return $notification;
    }
}