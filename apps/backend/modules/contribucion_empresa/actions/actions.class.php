<?php

require_once dirname(__FILE__) . '/../lib/contribucion_empresaGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/contribucion_empresaGeneratorHelper.class.php';

/**
 * contribucion_empresa actions.
 *
 * @package    symfony
 * @subpackage contribucion_empresa
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contribucion_empresaActions extends autoContribucion_empresaActions {

    protected function buildQuery() {
        $query = parent::buildQuery();

        $query->innerJoin('r.Concurso co');
        $query->andWhere('principal=false');
        $query->andWhere('co.concurso_tipo_id = 1');
        //$query->addWhere('contribucion_estado_id=?', 2);

        $filter_column = $this->getUser()->getAttribute('contribucion_empresa.filters', null, 'admin_module');

        $this->filtershow = $filter_column;

        $sort = $this->getSort();
        $sort_column = $this->getUser()->getAttribute('contribucion_empresa.sort', null, 'admin_module');

        if ($sort_column[0] == 'concurso_id') {
            if (array_key_exists('columname', $_GET)) {
                if ($_GET['columname'] == 'concurso') {
                    $query->orderBy('co.name' . ' ' . $sort[1]);
                }
                if ($_GET['columname'] == 'resume_name') {
                    $query->orderBy('r.name' . ' ' . $sort[1]);
                }
                if ($_GET['columname'] == 'empresa') {
                    $query->leftJoin('co.Empresa esu');
                    $query->orderBy('esu.name' . ' ' . $sort[1]);
                }
                if ($_GET['columname'] == 'provincia') {
                    $query->leftJoin('co.States s');
                    $query->orderBy('s.name' . ' ' . $sort[1]);
                }
                if ($_GET['columname'] == 'localidad') {
                    $query->leftJoin('co.City c');
                    $query->orderBy('c.name' . ' ' . $sort[1]);
                }
            } elseif (isset($sort_column[2]) && !empty($sort_column[0])) {
                if ($sort_column[2] == 'concurso') {
                    $query->orderBy('co.name' . ' ' . $sort[1]);
                }
                if ($sort_column[2] == 'resume_name') {
                    $query->orderBy('r.name' . ' ' . $sort[1]);
                }
                if ($sort_column[2] == 'empresa') {
                    $query->leftJoin('co.Empresa esu');
                    $query->orderBy('esu.name' . ' ' . $sort[1]);
                }
                if ($sort_column[2] == 'provincia') {
                    $query->leftJoin('co.States s');
                    $query->orderBy('s.name' . ' ' . $sort[1]);
                }
                if ($sort_column[2] == 'localidad') {
                    $query->leftJoin('co.City c');
                    $query->orderBy('c.name' . ' ' . $sort[1]);
                }
            }
        } elseif ($sort_column[0] == 'contribucion_estado_id') {
            //$query->leftJoin('co.Concurso esu');
            $query->orderBy('r.ContribucionEstado.name' . ' ' . $sort[1]);
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

    protected function only_estado() {
        $query = parent::buildQuery();

        $query->andWhere('principal=false');
        $query->addWhere('contribucion_estado_id=?', 1);

        return $query;
    }

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

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $contribucion = $form->save();
            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ? 's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $contribucion)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@contribucion_contribucion_empresa_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect('contribucion_empresa/show?id=' . $contribucion->getId());
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeDownload_pdfIncidencia(sfWebRequest $request) {
        $this->forward404Unless($contribucion = Doctrine::getTable('contribucion')->findOneBy('id', $request->getParameter('id')));

        $pdf = new PDFClass();
        $pdf->AddPage();
        $pdf->Image(dirname(__FILE__) . '/../../../../../web/images/logo_auditoscopia_espanol_pequeno_jpg.jpg', 150, 8, 40);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Write(5, $contribucion->getName());
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 11);
        $pdf->WriteHTML(html_entity_decode($contribucion->getIncidencia()));


        $pdf->Output(sprintf($contribucion->getName() . '.pdf'), 'D');
        throw new sfStopException();
    }

}
