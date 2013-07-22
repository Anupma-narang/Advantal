<?php

require_once dirname(__FILE__) . '/../lib/planes_de_accion_productoGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/planes_de_accion_productoGeneratorHelper.class.php';

/**
 * planes_de_accion_producto actions.
 *
 * @package    symfony
 * @subpackage planes_de_accion_producto
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class planes_de_accion_productoActions extends autoPlanes_de_accion_productoActions {

    protected function buildQuery() {
        $query = parent::buildQuery();

        $query->innerJoin('r.Concurso co');
        $query->innerJoin('co.Producto p');
        $query->andWhere('contribucion_estado_id=2');
        //  $query->andWhere('principal=false');
        $query->andWhere('co.concurso_tipo_id=2');

        $filter_column = $this->getUser()->getAttribute('planes_de_accion_producto.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

        $sort = $this->getSort();
        $sort_column = $this->getUser()->getAttribute('planes_de_accion_producto.sort', null, 'admin_module');

        if ($sort_column[0] == 'concurso_id') {
            if (array_key_exists('columname', $_GET)) {
                if ($_GET['columname'] == 'resume_name') {
                    $query->orderBy('r.name' . ' ' . $sort[1]);
                }
                if ($_GET['columname'] == 'concurso') {
                    $query->orderBy('co.name' . ' ' . $sort[1]);
                }
                if ($_GET['columname'] == 'category') {
                    $query->orderBy('co.ConcursoCategoria.name' . ' ' . $sort[1]);
                }
                if ($_GET['columname'] == 'producto') {
                    $query->leftJoin('co.Producto esu');
                    $query->orderBy('esu.name' . ' ' . $sort[1]);
                }
                if ($_GET['columname'] == 'marca') {
                    $query->leftJoin('co.Producto s');
                    $query->orderBy('s.marca' . ' ' . $sort[1]);
                }
                if ($_GET['columname'] == 'modelo') {
                    $query->leftJoin('co.Producto s');
                    $query->orderBy('s.modelo' . ' ' . $sort[1]);
                }
                if ($_GET['columname'] == 'sector') {
                    $query->leftJoin('co.Producto pt');
                    $query->leftJoin('pt.ProductoTipoUno un');
                    $query->orderBy('un.name' . ' ' . $sort[1]);
                }
                if ($_GET['columname'] == 'subsector') {
                    $query->leftJoin('co.Producto pt');
                    $query->leftJoin('pt.ProductoTipoDos ed');
                    $query->orderBy('ed.name' . ' ' . $sort[1]);
                }
                if ($_GET['columname'] == 'tipodeproducto') {
                    $query->leftJoin('co.Producto pt');
                    $query->leftJoin('pt.ProductoTipoTres est');
                    $query->orderBy('est.name' . ' ' . $sort[1]);
                }
            } elseif (isset($sort_column[2]) && !empty($sort_column[0])) {
                if ($sort_column[2] == 'resume_name') {
                    $query->orderBy('r.name' . ' ' . $sort[1]);
                }
                if ($sort_column[2] == 'concurso') {
                    $query->orderBy('co.name' . ' ' . $sort[1]);
                }
                if ($sort_column[2] == 'category') {
                    $query->orderBy('co.ConcursoCategoria.name' . ' ' . $sort[1]);
                }
                if ($sort_column[2] == 'producto') {
                    $query->leftJoin('co.Producto esu');
                    $query->orderBy('esu.name' . ' ' . $sort[1]);
                }
                if ($sort_column[2] == 'marca') {
                    $query->leftJoin('co.Producto s');
                    $query->orderBy('s.marca' . ' ' . $sort[1]);
                }
                if ($sort_column[2] == 'modelo') {
                    $query->leftJoin('co.Producto s');
                    $query->orderBy('s.modelo' . ' ' . $sort[1]);
                }
                if ($sort_column[2] == 'sector') {
                    $query->leftJoin('co.Producto pt');
                    $query->leftJoin('pt.ProductoTipoUno un');
                    $query->orderBy('un.name' . ' ' . $sort[1]);
                }
                if ($sort_column[2] == 'subsector') {
                    $query->leftJoin('co.Producto pt');
                    $query->leftJoin('pt.ProductoTipoDos ed');
                    $query->orderBy('ed.name' . ' ' . $sort[1]);
                }
                if ($sort_column[2] == 'tipodeproducto') {
                    $query->leftJoin('co.Producto pt');
                    $query->leftJoin('pt.ProductoTipoTres est');
                    $query->orderBy('est.name' . ' ' . $sort[1]);
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

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($contribucion = Doctrine::getTable("contribucion")->findOneById($request->getParameter('id')));

        $this->redirect('contribucion/edit?id=' . $contribucion->getId());
    }

    /* public function executeShow(sfWebRequest $request)
      {
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

}
