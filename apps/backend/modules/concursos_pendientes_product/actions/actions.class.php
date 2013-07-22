<?php

require_once dirname(__FILE__) . '/../lib/concursos_pendientes_productGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/concursos_pendientes_productGeneratorHelper.class.php';

/**
 * concursos_pendientes_product actions.
 *
 * @package    symfony
 * @subpackage concursos_pendientes_product
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class concursos_pendientes_productActions extends autoConcursos_pendientes_productActions {

    protected function buildQuery() {
        $query = parent::buildQuery();

        //Query customization
        $query->addWhere('concurso_estado_id=?', 1)
                ->addWhere('concurso_tipo_id=?', 2);


        $filter_column = $this->getUser()->getAttribute('concursos_pendientes_product.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

        $sort = $this->getSort();
        $sort_column = $this->getUser()->getAttribute('concursos_pendientes_product.sort', null, 'admin_module');
        if ($sort_column[0] == 'producto_id') {
            if (array_key_exists('columnname', $_GET)) {
                if ($_GET['columnname'] == 'marca') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.marca' . ' ' . $sort[1]);
                } elseif ($_GET['columnname'] == 'modelo') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.modelo' . ' ' . $sort[1]);
                } elseif ($_GET['columnname'] == 'sector') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.ProductoTipoUno.name' . ' ' . $sort[1]);
                } elseif ($_GET['columnname'] == 'subsector') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.ProductoTipoDos.name' . ' ' . $sort[1]);
                } elseif ($_GET['columnname'] == 'tresector') {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.ProductoTipoTres.name' . ' ' . $sort[1]);
                } else {
                    $query->leftJoin('r.Producto esu');
                    $query->orderBy('esu.name' . ' ' . $sort[1]);
                }
            } else {
                $query->leftJoin('r.Producto esu');
                $query->orderBy('esu.name' . ' ' . $sort[1]);
            }
        } elseif ($sort_column[0] == 'concurso_categoria_id') {
            $query->leftJoin('r.ConcursoCategoria esu');
            $query->orderBy('esu.name' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'user_id') {
            $query->leftJoin('r.User esu');
            $query->orderBy('esu.username' . ' ' . $sort[1]);
        } else {
            if ($sort[0] != "") {
                $query->addOrderBy($sort[0] . ' ' . $sort[1]);
            } else {
                $query->addOrderBy('created_at desc');
            }
        }

        return $query;
    }

    public function executeShow(sfWebRequest $request) {
        $this->concurso = $this->getRoute()->getObject();

        $this->n_concursos_destacados = Doctrine::getTable('concurso')
                ->createQuery('c')
                ->where('c.destacado = true')
                ->andWhere('c.concurso_estado_id=2 or c.concurso_estado_id=3')
                ->count();

        $this->n_concursos_destacados_tiempo = array();
        $this->n_concursos_destacados_tiempo[1] = Doctrine::getTable('ConcursosDestacadosTemporales')
                ->createQuery('c')
                ->andWhere('tipo_tiempo_id=1')
                ->count();
        $this->n_concursos_destacados_tiempo[2] = Doctrine::getTable('ConcursosDestacadosTemporales')
                ->createQuery('c')
                ->andWhere('tipo_tiempo_id=2')
                ->count();
        $this->n_concursos_destacados_tiempo[3] = Doctrine::getTable('ConcursosDestacadosTemporales')
                ->createQuery('c')
                ->andWhere('tipo_tiempo_id=3')
                ->count();

        $this->puntos = Doctrine::getTable('ColaboradorPuntoDefinicion')->createQuery()->where('is_automatic = false')->execute();
        $this->comentarios = Doctrine::getTable('ComentarioConcurso')->findBy('concurso_id', $this->concurso->getId());
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->concurso = $this->form->getObject();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->concurso = $this->form->getObject();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $concurso = $this->getRoute()->getObject();
        $this->forward('concursos_pendientes_product', 'editProducto');
    }

    public function executeEditProducto(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
        $concurso = Doctrine::getTable('Concurso')->findOneBy('id', $this->id);
        $this->form = new ConcursoProductoFormBackend($concurso);
        $this->form->setDefaults($this->form->getDefaultValuesConcurso());

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('concurso'), $request->getFiles('concurso'));
            if ($this->form->isValid()) {
                $id = $this->form->save();
                $notice = "The item was updated successfully.";
                $this->getUser()->setFlash('notice', $notice);                
                $this->redirect('concursos_pendientes_product/show?id=' . $id);
            }
        }
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $request_parameters = $request->getParameter($form->getName());
        $request_parameters['contribucion']['user_id'] = $request_parameters['user_id'];
        $form->bind($request_parameters, $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $concurso_beneficio = $form->save();
            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $concurso_beneficio)));
            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . 'El elemento se ha creado correctamente y ahora puede crear otro elemento.');
                $this->redirect('@concurso_concursos_pendientes_product_new');
            } else {
                $notice = "The item was created successfully.";
                $this->getUser()->setFlash('notice', $notice);
                $this->redirect('concursos_pendientes_product/show?id=' . $concurso_beneficio->getId());
            }
        }
        else
        {          
          $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
        return false;
    }

}
