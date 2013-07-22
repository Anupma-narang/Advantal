<?php

/**
 * concurso actions.
 *
 * @package    auditoscopia
 * @subpackage concurso
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contribucionActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeShow(sfWebRequest $request)
	{
		//$this->concurso=Doctrine::getTable("Concurso")->findOneById($request->getParameter("id"));
	}
	 
	public function executeConfirm(sfWebRequest $request)
	{
		//$this->forward('default', 'module');
	}

	public function executeIndex(sfWebRequest $request)
	{
		//            $this->tipo=$request->getParameter("tipo");
		//            if(!$this->tipo){
		//                $this->tipo="empresa";
		//                $this->valor=1;
		//            }

		//            if($this->tipo=="empresa"){
		//                $this->valor=1;
		//            } else if($this->tipo=="producto"){
		//                $this->valor=2;
		//            }
		//            $this->concursos=Doctrine::getTable("Concurso")->createQuery()->where($this->tipo."_id=?",$this->valor)->execute();
		//      }
		}

		public function executeNew(sfWebRequest $request)
		{
			$this->form = new ContribucionForm();
			//$this->tipo=$request->getParameter("tipo");
		}

		public function executeCreate(sfWebRequest $request)
		{


			$this->forward404Unless($request->isMethod('post'));

			$this->form = new ContribucionForm();

			$this->processForm($request, $this->form);

			$this->setTemplate('new');
		}



		protected function processForm(sfWebRequest $request, sfForm $form)
		{
			$form->bind($request->getParameter($form->getName()));
			if ($form->isValid()){
				$contribucion = $form->save();
				$this->redirect('contribucion/confirm?id='.$contribucion->id);
			}
		}
	}
