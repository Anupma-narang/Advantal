<?php

class clearOrderTask extends sfBaseTask
{
    protected function configure()
    {
        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
            // add your own options here
        ));

        $this->namespace = 'auditoscopia';
        $this->name = 'clear-order';
        $this->briefDescription = 'Límpia el registro del orden. No lanzar en producción! ';
    }

    protected function execute($arguments = array(), $options = array())
    {
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        $deletedRows = Doctrine_Query::create()->delete('OrderPreferences o')
            ->where(1)
            ->execute();

        $this->logSection('Filas borradas:', $deletedRows);


    }
}
