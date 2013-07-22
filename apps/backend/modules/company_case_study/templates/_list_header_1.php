<ul id="submenu_concursos">
  <li>
     <?php echo link_to( __('Casos de empresa/entidad'), url_for('user_company_case_study_request'),array('title' => __('Casos de empresa/entidad'))); ?>
  </li>
  <li>
    <?php echo link_to( __('Casos de product'), url_for('user_product_case_study_request'),array('title' => __('Casos de product'))); ?>
  </li>
</ul>