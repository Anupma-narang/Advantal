<?php

class cronConcursosTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'cron';
    $this->name             = 'concursos';
    $this->briefDescription = 'Pasa a Referéndum todos los concursos de más de 60 y 7 días. Además notifica por e-mail';
    $this->detailedDescription = <<<EOF
The [cron:concursos|INFO] task does things.
Call it with:

  [php symfony cron:concursos|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
//    $this->getMailer();
//    sfContext::createInstance($this->configuration);

    // add your code here
    $this->logSection('AUDITOSCOPIA', '<<');
    $this->logSection('CRON', 'Concursos');


    $concursos = Doctrine::getTable('concurso')->createQuery('c')->leftJoin('c.ConcursoEstado e')->where('e.value=3')->execute();
    $n_con=0;
    $this->logSection('Estado a', 'Deliberación');
    foreach ($concursos as $con)
    {
    	if(!$fecha = $con->getFechaReferendum())
    		continue;

    	$dias = intval((time()-strtotime($fecha))/86400);
    	if($dias >=2/*7*/){
				$last=$con->getConcursoEstadoId();

    		$con->setConcursoEstadoId(4);

				// si pasamos de activo ó referendum, a otro estado superior se deben quitar el destacado de las contribuciones
				$con->quitarDestacadoConcursoYContribuciones();

    		$con->save();
                $con->asignarPuntosGanadores();
		
				// guardamos en el histórico cada cambio de estado
				$concurso_historico=new ConcursoHistorico();
				$concurso_historico->setConcursoId($con->getId());
				$concurso_historico->setDate(date('Y-m-d H:i:s'));
				$concurso_historico->setEstadoInicial($last);
				$concurso_historico->setEstadoFinal(4);
				$concurso_historico->save();

    		$n_con++;
    	}
    }
    $this->logSection('Concursos nuevos en Deliberación', $n_con);

    $concursos = Doctrine::getTable('concurso')->createQuery('c')->leftJoin('c.ConcursoEstado e')->where('e.value=2')->execute();
    $this->logSection('Nº concursos', $concursos->count());
    $n_con=0;

    $this->logSection('Estado a', 'Referédum');
    foreach ($concursos as $con)
    {
    	if(!$fecha = $con->getFechaActivacion())
    		$fecha = $con->getCreatedAt();

    	$dias = intval((time()-strtotime($fecha))/86400);
    	if($dias >=5/*60*/){
				$last=$con->getConcursoEstadoId();

    		$con->setConcursoEstadoId(3);
    		$con->setFechaReferendum(date('Y-m-d'));
    		$con->save();

				// guardamos en el histórico cada cambio de estado
				$concurso_historico=new ConcursoHistorico();
				$concurso_historico->setConcursoId($con->getId());
				$concurso_historico->setDate(date('Y-m-d H:i:s'));
				$concurso_historico->setEstadoInicial($last);
				$concurso_historico->setEstadoFinal(3);
				$concurso_historico->save();

    		$n_con++;
    	}
    }
    $this->logSection('Concursos nuevos en Referendum', $n_con);


    //las notificaciones
    $this->logSection('Notificaciones por e-mail de concursos', '');
		$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);
		sfContext::createInstance($configuration);

		ConcursoTable::mailFinConcursoEmpresa3Dias();
    ConcursoTable::mailFinConcursoProducto3Dias();
    ConcursoTable::mailFinReferendumConcursoEmpresa2Dias();
    ConcursoTable::mailFinReferendumConcursoProducto2Dias();
		
		
		// borramos posibles ficheros residentes en la carpeta de uploads
		$tempFolder=pkValidatorFilePersistent::getPersistentDir();
		borrar_directorio($tempFolder);
		

    $this->logSection('Fin','<<');
  }
	
	public function borrar_directorio($dir)
	{
		if(!$dh = @opendir($dir)) return;
		while (false !== ($obj = readdir($dh))) 
		{
			if($obj=='.' || $obj=='..') continue;
			if (!@unlink($dir.'/'.$obj)) borrar_directorio($dir.'/'.$obj);
		}
		closedir($dh);
		
		@rmdir($dir);
	}
}
