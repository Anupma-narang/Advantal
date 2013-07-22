<?php

class cronEvolucionListasTask extends sfBaseTask
{
    protected function configure()
    {
        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
            // add your own options here
        ));

        $this->namespace = 'cron';
        $this->name = 'evolucion-listas';
        $this->briefDescription = 'Cálculo de la evolución de las listas. Este script se ha de lanzar una vez al mes ';
        $this->detailedDescription = <<<EOF
Este script cálcula la evolución mensual de las empresas y productos.
  [php symfony cron:evolucion-listas|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        $this->logSection('Iniciando cálculo', '...');

        //suma el total de suma de cuestionarios

        $objects = array('Empresa', 'Producto');
        foreach ($objects as $object) {
            $entity = call_user_func(array($object . 'Table', 'getInstance'));
            foreach ($entity->findAll() as $record) {
                //calcular primero si existe este record para este mes...

                $setObject = 'set'.$object;
                $reflector = new ReflectionClass($record);
                $method = $reflector->getMethod('getFactorFormula');
                $evolucion = new EmpresaProductoEvolucion();
                $evolucion->$setObject($record);
                $evolucion->setPuntuacion($method->invoke($record));
                $evolucion->setDate(date('y-m-d'));
                $evolucion->save();
            }
        }

        $this->logSection('Cálculo finalizado', '<<<');
    }
}
