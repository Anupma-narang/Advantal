<?php

/**
 * escritorio actions.
 *
 * @package    symfony
 * @subpackage escritorio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class escritorioActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {      
    }

    public function executeGet_alertas(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $q = Doctrine::getTable('Alertas')->createQuery()->orderBy('created_at desc')->andWhereNotIn('entity', array(2, 3, 7, 5, 6, 9, 11, 500, 800));
        if ($delete = $request->getParameter('delete')) {
            if ($delete == 'all') {
                Doctrine::getTable('alertas')->createQuery()->andWhereNotIn('entity', array(2, 3, 7, 5, 6, 9, 11, 500, 800))->delete()->execute();
            } else {
                Doctrine::getTable('alertas')->createQuery()->where('id=?', $delete)->delete()->execute();
            }
        }

        $this->alertas = new sfDoctrinePager(
                'Alertas', sfConfig::get('app_max_home_items', 25)
        );
        $this->alertas->setQuery($q);
        $this->alertas->setPage($request->getParameter('page', 1));
        $this->alertas->init();

        $this->n_alertas = $this->alertas->getNbResults();
    }

    public function executeGet_profesionales_pendientes(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());

        $q = Doctrine::getTable('Profesional')->createQuery('a')->where('a.profesional_estado_id = 1')->orderBy('a.created_at desc');

        // delete process Start
        if ($delete = $request->getParameter('delete')) {
            if ($delete == 'all') {
                Doctrine::getTable('Alertas')->createQuery()->where('entity = 7')->delete()->execute();
            } else {
                Doctrine::getTable('Alertas')->createQuery()->where('id=?', $delete)->andWhere('entity = 7')->delete()->execute();
            }
        }
        // delete process End
        $this->profesionales = new sfDoctrinePager(
                'Alertas', sfConfig::get('app_max_home_items', 25)
        );

        $this->profesionales->setQuery($q);
        $this->profesionales->setPage($request->getParameter('page', 1));
        $this->profesionales->init();

        $this->n_profesionales = $this->profesionales->getNbResults();
    }

    public function executeGet_cartas_pendientes(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $q = Doctrine::getTable("ProfesionalLetter")->createQuery()->where("profesional_letter_estado_id=1")->orderBy("created_at desc");

        $this->cartas = new sfDoctrinePager(
                'ProfesionalLetter', sfConfig::get('app_max_home_items', 25)
        );
        $this->cartas->setQuery($q);
        $this->cartas->setPage($request->getParameter('page', 1));
        $this->cartas->init();

        $this->n_cartas = $this->cartas->getNbResults();

        $this->n_cartas = $this->cartas->getNbResults();
    }

    public function executeGet_concursos_pendientes(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $q = Doctrine::getTable("Concurso")->createQuery()->where("concurso_estado_id=1")->orderBy("created_at desc");

        $this->concursos = new sfDoctrinePager(
                'Concurso', sfConfig::get('app_max_home_items', 25)
        );
        $this->concursos->setQuery($q);
        $this->concursos->setPage($request->getParameter('page', 1));
        $this->concursos->init();

        $this->n_concursos = $this->concursos->getNbResults();
    }

    public function executeGet_contribuciones_pendientes(sfWebRequest $request) {
        $q = Doctrine::getTable("Contribucion")->createQuery()->where("contribucion_estado_id=1")->andWhere('principal=false')->orderBy("created_at desc");

        $this->contribuciones = new sfDoctrinePager(
                'Concurso', sfConfig::get('app_max_home_items', 25)
        );
        $this->contribuciones->setQuery($q);
        $this->contribuciones->setPage($request->getParameter('page', 1));
        $this->contribuciones->init();

        $this->n_contribuciones = $this->contribuciones->getNbResults();
    }

    public function executeGet_concursos60dias(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $q = Doctrine::getTable("Concurso")->createQuery()->where("CURDATE() = DATE(DATE_ADD(fecha_activacion,INTERVAL 60 DAY))")->orderBy("fecha_activacion desc");

        $this->concursos = new sfDoctrinePager(
                'Concurso', sfConfig::get('app_max_home_items', 25)
        );
        $this->concursos->setQuery($q);
        $this->concursos->setPage($request->getParameter('page', 1));
        $this->concursos->init();

        $this->n_concursos = $this->concursos->getNbResults();
    }

    public function executeGet_concursos75dias(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $q = Doctrine::getTable("Concurso")->createQuery()->where("CURDATE() = DATE(DATE_ADD(fecha_activacion,INTERVAL 75 DAY))")->orderBy("fecha_activacion desc");

        $this->concursos = new sfDoctrinePager(
                'Concurso', sfConfig::get('app_max_home_items', 25)
        );
        $this->concursos->setQuery($q);
        $this->concursos->setPage($request->getParameter('page', 1));
        $this->concursos->init();

        $this->n_concursos = $this->concursos->getNbResults();
    }

    /**
     * method display records from Alertas de caja model
     * and also delete records when request is for delete operation
     * @param sfWebRequest $request
     */
    public function executeAlertasDeCajaList(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        //if request for delete record
        if ($id = $request->getParameter('delete')) {
            Doctrine::getTable('AlertasDeCaja')->deleteRecordsById($id);
        }
        // get alertas de caja records query
        $alertas_de_caja_query = Doctrine::getTable('AlertasDeCaja')->getAlertasListQuery();
        // create and initialize doctrin pager for records
        $this->alertas_de_caja_pager = new sfDoctrinePager('AlertasDeCaja', sfConfig::get('app_max_home_items', 25));
        $this->alertas_de_caja_pager->setQuery($alertas_de_caja_query);
        $this->alertas_de_caja_pager->setPage($request->getParameter('page', 1));
        $this->alertas_de_caja_pager->init();
    }

    public function executeGiftRedemtionAlerts(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        //if request for delete record
        if ($id = $request->getParameter('delete')) {
            Doctrine::getTable('Alertas')->deleteRecordsById($id);
        }
        // get alertas de caja records query
        $alertas_gift_query = Doctrine::getTable('Alertas')->getGiftAlerts();
        // create and initialize doctrin pager for records
        $this->gift_alert_pager = new sfDoctrinePager('Alertas', sfConfig::get('app_max_home_items', 25));
        $this->gift_alert_pager->setQuery($alertas_gift_query);
        $this->gift_alert_pager->setPage($request->getParameter('page', 1));
        $this->gift_alert_pager->init();
    }

}