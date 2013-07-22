<?php

/**
 * home actions.
 *
 * @package    auditoscopia
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        //Page Title
        $this->getResponse()->setTitle('Concursos de ideas para mejorar productos y servicios - auditoscopia');
        $this->getResponse()->addMeta('keywords', 'concurso ideas, concursos ideas, mejorar producto, mejorar productos, mejorar servicio, mejorar servicios, mejorar profesional, mejorar profesionales, producto favorito, productos favoritos, servicio favorito, servicios favoritos, profesional favorito, profesionales favoritos, empresa recomendada, empresas recomendadas, producto recomendado, productos recomendados, profesional recomendado, profesionales recomendados');
        $this->getResponse()->addMeta('description', 'Concursos de ideas para mejorar tus productos,servicios y profesionales favoritos y ganar dinero. Encuentra empresas,productos y profesionales recomendados');
    }

    public function executeGet_alertas(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());

        $q = Doctrine::getTable('Alertas')->createQuery()->orderBy('created_at desc');

        if ($delete = $request->getParameter('delete')) {
            if ($delete == 'all') {
                Doctrine::getTable('alertas')->createQuery()->delete()->execute();
            }
        }

        $this->alertas = new sfDoctrinePager(
                        'Alertas',
                        sfConfig::get('app_max_home_items', 25)
        );
        $this->alertas->setQuery($q);
        $this->alertas->setPage($request->getParameter('page', 1));
        $this->alertas->init();

        $this->n_alertas = $this->alertas->getNbResults();
    }

    public function executeGet_concursos_pendientes(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $q = Doctrine::getTable("Concurso")->createQuery()->where("concurso_estado_id=1")->orderBy("created_at desc");

        $this->concursos = new sfDoctrinePager(
                        'Concurso',
                        sfConfig::get('app_max_home_items', 25)
        );
        $this->concursos->setQuery($q);
        $this->concursos->setPage($request->getParameter('page', 1));
        $this->concursos->init();

        $this->n_concursos = $this->concursos->getNbResults();
    }

    public function executeGet_contribuciones_pendientes(sfWebRequest $request) {
        //$this->forward404Unless($request->isXmlHttpRequest());		
        $q = Doctrine::getTable("Contribucion")->createQuery()->where("contribucion_estado_id=1")->andWhere('principal=false')->orderBy("created_at desc");

        $this->contribuciones = new sfDoctrinePager(
                        'Concurso',
                        sfConfig::get('app_max_home_items', 25)
        );
        $this->contribuciones->setQuery($q);
        $this->contribuciones->setPage($request->getParameter('page', 1));
        $this->contribuciones->init();

        $this->n_contribuciones = $this->contribuciones->getNbResults();
    }

}
