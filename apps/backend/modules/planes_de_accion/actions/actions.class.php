<?php

require_once dirname(__FILE__) . '/../lib/planes_de_accionGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/planes_de_accionGeneratorHelper.class.php';

/**
 * planes_de_accion actions.
 *
 * @package    symfony
 * @subpackage planes_de_accion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class planes_de_accionActions extends autoPlanes_de_accionActions {

    protected function buildQuery() {
        $query = parent::buildQuery();

        $query->innerJoin('r.Concurso co');
        $query->andWhere('contribucion_estado_id=2');
        $query->andWhere('co.concurso_estado_id!=1');
        //  $query->andWhere('principal=false');
        //$query->innerJoin('co.Empresa e');
        //$query->andWhere('co.concurso_tipo_id=1');

        $filter_column = $this->getUser()->getAttribute('planes_de_accion.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

        $sort = $this->getSort();
        $sort_column = $this->getUser()->getAttribute('planes_de_accion.sort', null, 'admin_module');

        if ($sort_column[0] == 'concurso_id') {
            if (array_key_exists('columname', $_GET)) {
                if ($_GET['columname'] == 'category') {
                    $query->leftJoin('co.ConcursoCategoria esu');
                    $query->orderBy('esu.name' . ' ' . $sort[1]);
                }
                if ($_GET['columname'] == 'concurso') {
                    $query->orderBy('co.name' . ' ' . $sort[1]);
                }
            } elseif (isset($sort_column[2]) && !empty($sort_column[0])) {
                if ($sort_column[2] == 'category') {
                    $query->leftJoin('co.ConcursoCategoria esu');
                    $query->orderBy('esu.name' . ' ' . $sort[1]);
                }
                if ($sort_column[2] == 'concurso') {
                    $query->orderBy('co.name' . ' ' . $sort[1]);
                }
            }
        } elseif ($sort_column[0] == 'contribucion_estado_id') {
            //$query->leftJoin('co.Concurso esu');
            $query->orderBy('co.ConcursoEstado.name' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'user_id') {
            $query->leftJoin('r.User esu');
            $query->orderBy('esu.username' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'created_at') {
            $query->orderBy('r.created_at' . ' ' . $sort[1]);
        } else {
            if ($sort[0] != "") {
                $query->addOrderBy($sort[0] . ' ' . $sort[1]);
            }
        }

        $request = sfContext::getInstance()->getRequest();

        if(! $request->hasParameter('sort') && ! $request->hasParameter('sort_type'))
        {
          $query->orderBy('created_at DESC');
        }

        return $query;
    }

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            if ($request->hasParameter("columname")) {
                $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type'), $request->getParameter('columname')));
            } else {
                $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
            }
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
    }

    protected function addSortQuery($query) {
        if (array(null, null) == ($sort = $this->getSort())) {
            return;
        }

        if (!in_array(strtolower($sort[1]), array('asc', 'desc'))) {
            $sort[1] = 'asc';
        }

        switch ($sort[0]) {
            case 'concurso_id':
                $sort[0] = 'c.name';
                break;
        }

        $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    }

    protected function isValidSortColumn($column) {
        return Doctrine_Core::getTable('Contribucion')->hasColumn($column) || $column == 'concurso_id';
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($contribucion = Doctrine::getTable("contribucion")->findOneById($request->getParameter('id')));

        $this->redirect('contribucion/edit?id=' . $contribucion->getId());
    }

    /* public function executeShow(sfWebRequest $request) {
      $this->forward404Unless($contribucion = Doctrine::getTable("contribucion")->findOneById($request->getParameter('id')));

      $this->redirect('contribucion/show?id='.$contribucion->getId().'&plan=yes');
      } */

    public function executeShow(sfWebRequest $request) {
        $this->contribucion = $this->getRoute()->getObject();
        //$this->helper = new contribucionGeneratorHelper();

        $this->n_contribuciones_destacados = Doctrine::getTable('contribucion')
                ->createQuery('c')
//					->leftJoin('c.concur')
                ->where('c.concurso_id=?', $this->contribucion->getConcursoId())
                ->andWhere('c.destacado=1')
                ->count();

        $this->puntos = doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic = false')->execute();
    }

    public function executeShowIncidenciaDetail(sfWebRequest $request) {
        $this->forward404Unless($this->contribucion = Doctrine::getTable('Contribucion')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
        //$this->contribucion = Doctrine::getTable('Contribucion')->findOneBy('id', $request->getParameter('id'));
    }

    public function executeShowPlanAccionDetail(sfWebRequest $request) {
        $this->forward404Unless($this->contribucion = Doctrine::getTable('Contribucion')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
    }

    public function executeShowResumen(sfWebRequest $request) {
        $this->forward404Unless($this->contribucion = Doctrine::getTable('Contribucion')->findOneBy('id', $request->getParameter('id')));
        $this->setLayout('layout_emergente_new');
    }

}
