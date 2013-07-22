<?php

require_once dirname(__FILE__) . '/../lib/concursos_pendientes_empresaGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/concursos_pendientes_empresaGeneratorHelper.class.php';

/**
 * concursos_pendientes_empresa actions.
 *
 * @package    symfony
 * @subpackage concursos_pendientes_empresa
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class concursos_pendientes_empresaActions extends autoConcursos_pendientes_empresaActions {

    public function preExecute() {
        $this->configuration = new concursos_pendientes_empresaGeneratorConfiguration();
        if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName()))) {
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }
        $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

        $this->helper = new concursos_pendientes_empresaGeneratorHelper();
        parent::preExecute();
    }

    protected function buildQuery() {
        $query = parent::buildQuery();

        //Query customization
        $query->addWhere('concurso_estado_id=?', 1)
                ->addWhere('concurso_tipo_id=?', 1);

        $filter_column = $this->getUser()->getAttribute('concursos_pendientes_empresa.filters', null, 'admin_module');

        $this->filtershow = $filter_column;


        $sort = $this->getSort();
        $sort_column = $this->getUser()->getAttribute('concursos_pendientes_empresa.sort', null, 'admin_module');
        if ($sort_column[0] == 'empresa_id') {
            if (array_key_exists('columnname', $_GET)) {
                if ($_GET['columnname'] == 'sector') {
                    $query->leftJoin('r.Empresa esu');
                    $query->orderBy('esu.EmpresaSectorUno.name' . ' ' . $sort[1]);
                } elseif ($_GET['columnname'] == 'subsector') {
                    $query->leftJoin('r.Empresa esu');
                    $query->orderBy('esu.EmpresaSectorDos.name' . ' ' . $sort[1]);
                } elseif ($_GET['columnname'] == 'tresector') {
                    $query->leftJoin('r.Empresa esu');
                    $query->orderBy('esu.EmpresaSectorTres.name' . ' ' . $sort[1]);
                } else {
                    $query->leftJoin('r.Empresa esu');
                    $query->orderBy('esu.name' . ' ' . $sort[1]);
                }
            } else {
                $query->leftJoin('r.Empresa esu');
                $query->orderBy('esu.name' . ' ' . $sort[1]);
            }
        } elseif ($sort_column[0] == 'states_id') {
            $query->leftJoin('r.States esu');
            $query->orderBy('esu.name' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'city_id') {
            $query->leftJoin('r.City esu');
            $query->orderBy('esu.name' . ' ' . $sort[1]);
        } elseif ($sort_column[0] == 'concurso_categoria_id') {
            $query->leftJoin('r.ConcursoCategoria esu');
            $query->orderBy('esu.name' . ' ' . $sort[1]);
        } else {
            if ($sort[0] != "") {
                $query->addOrderBy($sort[0] . ' ' . $sort[1]);
            } else {
                $query->addOrderBy('created_at desc');
            }
        }
        
        // $query->addOrderBy('created_at DESC');
        
        //echo $query->getSqlQuery();exit;
        
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

    public function executeEdit(sfWebRequest $request) {
        $concurso = $this->getRoute()->getObject();
        if ($concurso->getConcursoTipoId() == 1) {
            $this->forward('concursos_pendientes_empresa', 'editEmpresa');
        } else {
            $this->forward404('El concurso no es correcto.');
        }
    }

    public function executeEditEmpresa(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
        $concurso = Doctrine::getTable('Concurso')->findOneBy('id', $this->id);
        $this->form = new ConcursoEmpresaFormBackend($concurso);
        $this->form->setDefaults($this->form->getDefaultValuesConcurso());

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('concurso'), $request->getFiles('concurso'));
            if ($this->form->isValid()) {
                $id = $this->form->save();
                $notice = "The item was updated successfully.";
                $this->getUser()->setFlash('notice', $notice);
                $this->redirect('concursos_pendientes_empresa/show?id=' . $id);
            }
        }
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $request_parameters = $request->getParameter($form->getName());
        $request_parameters['contribucion']['user_id'] = $request_parameters['user_id'];
        $form->bind($request_parameters, $request->getFiles($form->getName()));
        if ($form->isValid()) {

            $concurso_beneficio = $form->save();
            //return $concurso_beneficio;
            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $concurso_beneficio)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . 'El elemento se ha creado correctamente y ahora puede crear otro elemento.');
                $this->redirect('@concurso_concursos_pendientes_empresa_new');
            } else {
              
                $notice = "The item was created successfully.";                
                $this->getUser()->setFlash('notice', $notice);
                $this->redirect('concursos_pendientes_empresa/show?id=' . $concurso_beneficio->getId());
            }
        }
        else
        {
          $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
        return false;
    }

}
