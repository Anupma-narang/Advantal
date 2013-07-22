<?php use_helper('I18N', 'Date') ?>
<?php include_partial('user_company_case_study_request/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Editar caso de éxito de Empresa/Entidad', array(), 'messages') ?></h1>

  <?php include_partial('user_company_case_study_request/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('user_company_case_study_request/form_header', array('user_company_case_study_request' => $user_company_case_study_request, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('user_company_case_study_request/form', array('user_company_case_study_request' => $user_company_case_study_request, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('user_company_case_study_request/form_footer', array('user_company_case_study_request' => $user_company_case_study_request, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
