<?php

require_once dirname(__FILE__) . '/../lib/giftGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/giftGeneratorHelper.class.php';

/**
 * gift actions.
 *
 * @package    symfony
 * @subpackage gift
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class giftActions extends autoGiftActions {

  protected function buildQuery()
  {
    $tableMethod = $this->configuration->getTableMethod();
    
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }

    $this->filters->setTableMethod($tableMethod);
    
    $filter_column = $this->getUser()->getAttribute('gift.filters', null, 'admin_module');
    $this->filtershow = $filter_column;
    $tempFilters = $this->getFilters();

    // echo "<pre>";print_r($tempFilters);exit;

    if(isset($tempFilters['hierarchy']) && $tempFilters['hierarchy'] != "")
    {
      $hierarchyIds = $tempFilters['hierarchy'];
      $tempFilters['hierarchy'] = '';
    }
    
    $query = $this->filters->buildQuery($tempFilters);    
    
    $this->addSortQuery($query);
    
    $request = sfContext::getInstance()->getRequest();

    
    if(isset($hierarchyIds))
    {
      $hierarchyId = $hierarchyIds[0];
      $filterids = array();

      for($i=$hierarchyId;$i>=1;$i--)
      {
        array_push($filterids, $i);        
      }

      $query->andWhereIn('hierarchy',  $filterids);      
    }
    
    if(! $request->hasParameter('sort') && ! $request->hasParameter('sort_type'))
    {
      $query->orderBy('created_at DESC');
    }


    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();

    return $query;
  }


  public function executeNew(sfWebRequest $request) {
    $this->gift = new Gift();
    $this->gift->setCreatedAt(date('m-d-y H:i:s'));
    $this->form = $this->configuration->getForm($this->gift);
  }

  public function executeIndex(sfWebRequest $request) {
    // sorting
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // pager
    if ($request->getParameter('page')) {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $featured_limit = Doctrine::getTable('Gift')->getFeatreudLimit();

    //if featured limit is more then 10 then show error message
    if ($featured_limit[0]['gift_limit'] >= 6) {
      $this->getUser()->setAttribute('is_limit_exceed', true);
    } else {
      $this->getUser()->setAttribute('is_limit_exceed', false);
    }
  }

  public function executeCreate(sfWebRequest $request) {
    $this->form = $this->configuration->getForm();
    $this->gift = $this->form->getObject();
    $validator_schema = $this->form->getValidatorSchema();
    $validator_schema['image'] = new sfValidatorFile(array(
                'required' => true,
                'path' => sfConfig::get('sf_gift_dir'),
                'mime_types' => 'web_images',
                    ), array('required' => 'Para publicar un regalo en el Escaparate, necesitas incluir una imagen.'));

    $this->processForm($request, $this->form, true);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request) {
    $this->gift = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->gift);
    $puntos = $this->getUser()->getMoneyInFormat($this->gift->getRequirePoints());
    $this->form->setDefault('require_points', $puntos);
  }

  public function executeUpdate(sfWebRequest $request) {
    $this->gift = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->gift);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  protected function processForm(sfWebRequest $request, sfForm $form, $create_flag = false) {
    $request_parameter = $request->getParameter($form->getName());
    if ($create_flag == true) {
      $request_parameter['created_at'] = date('Y-m-d H:i:s');
    }

    $form->bind($request_parameter, $request->getFiles($form->getName()));
    if ($form->isValid()) {

      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $puntos = $request_parameter['require_points'];
        $puntos = str_replace('.', '', $puntos);
        $puntos = str_replace(',', '.', $puntos);
        $form->setValidator('require_points', new sfValidatorString(array()));
        $request_parameter['require_points'] = $puntos;
        $form->bind($request_parameter, $request->getFiles($form->getName()));
        if ($form->isValid()) {
          $gift = $form->save();
          $gift = $form->getObject();
          $file = $form->getValue('image');
          if ($file) {
            $extension = $file->getExtension($file->getOriginalExtension());
            $file_name = substr($gift->getImage(), 0, strpos($gift->getImage(), '.'));
            $thumbnail = new sfThumbnail(90, 90);
            $thumbnail->loadFile($file->getSavedName());
            $thumbnail->save(sfConfig::get('sf_gift_dir') . DIRECTORY_SEPARATOR . 'thumb_' . $file_name . $extension);
            $thumbnail = new sfThumbnail(300, 300);
            $thumbnail->loadFile($file->getSavedName());
            $thumbnail->save(sfConfig::get('sf_gift_dir') . DIRECTORY_SEPARATOR . 'med_' . $file_name . $extension);
          }
        } else {
          $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $gift)));

      if ($request->hasParameter('_save_and_add')) {
        $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

        $this->redirect('@gift_new');
      } else {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'gift', 'sf_subject' => $gift));
      }
    } else {

      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  /**
   * Show Gift details
   * @param sfWebRequest $request
   */
  public function executeShow(sfWebRequest $request) {
    $featured_limit = Doctrine::getTable('Gift')->getFeatreudLimit();

    //if featured limit is more then 10 then show error message
    if ($featured_limit[0]['gift_limit'] >= 6) {
      $this->getUser()->setAttribute('is_limit_exceed', true);
    } else {
      $this->getUser()->setAttribute('is_limit_exceed', false);
    }
    $this->gift = $this->getRoute()->getObject();
  }

  /**
   * Set selected Gift as featured on homepage
   * @param sfWebRequest $request
   */
  public function executeSetFeatured(sfWebRequest $request) {
    //get gift id
    $gift_id = $request->getParameter('id');
    //get contest
    $gift = Doctrine::getTable('Gift')->find($gift_id);
    //get featured limit
    $featured_limit = Doctrine::getTable('Gift')->getFeatreudLimit();

    //if featured limit is more then 10 then show error message
    if ($featured_limit[0]['gift_limit'] >= 6) {
      //show gift contest error message
      $this->getUser()->setFlash('alert', 'No puedes destacar más de 6 regalos del Escaparate en la Home.');
      $this->redirect('gift');
    }

    //make contest as featured
    $gift->setFeatured(true);
    $gift->save();
    $this->getUser()->setFlash('notice', 'Regalo añadido a la Home');
    $this->redirect('gift');
  }

  /**
   * Remove selected Gift from homepage
   * @param sfWebRequest $request
   */
  public function executeRemoveFeatured(sfWebRequest $request) {
    //get gift id
    $gift_id = $request->getParameter('id');
    //get contest
    $gift = Doctrine::getTable('Gift')->find($gift_id);

    $gift->setFeatured(false);
    $gift->setFeaturedOrder(null);
    $gift->save();
    $this->redirect('gift');
  }

  /**
   * Set selected Gift as featured order for homepage
   * @param sfWebRequest $request
   */
  public function executeSetFeaturedOrder(sfWebRequest $request) {
    //get gift id
    $this->gift_id = $request->getParameter('id');
    //get contest
    $gift = Doctrine::getTable('Gift')->find($this->gift_id);
    if ($gift) {
      if ($gift->getFeatured()) {
        $this->gift_featured_order = $gift->getFeaturedOrder() ? $gift->getFeaturedOrder() : '';
        $this->error_message = null;
        //if form is submitted
        if ($request->getMethod() == sfWebRequest::POST) {
          //get contest featured order value
          $this->gift_featured_order = intval($request->getParameter('featured_order'));
          //validated value
          if ($this->gift_featured_order && $this->gift_featured_order > 0 && $this->gift_featured_order <= 10) {
            //save contest
            $gift->setFeaturedOrder($this->gift_featured_order);
            $gift->save();
            $this->getUser()->setFlash('notice', 'Has asignado el orden número ' . $this->gift_featured_order . ' a este elemento de la Home');
            $this->redirect('gift');
          } else {
            $this->error_message = 'Sólo puedes introducir números.';
          }
        }
      } else {
        $this->getUser()->setFlash('alert', 'Para asignar un orden a un elemento de la Home, necesitas primero destacarlo.');
        $this->redirect('gift');
      }
    }
  }

}
