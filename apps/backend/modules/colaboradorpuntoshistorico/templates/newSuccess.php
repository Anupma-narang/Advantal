<?php use_helper('I18N', 'Date') ?>
<?php include_partial('colaboradorpuntoshistorico/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Nueva entrada en el Histórico', array(), 'messages') ?></h1>

  <?php include_partial('colaboradorpuntoshistorico/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('colaboradorpuntoshistorico/form_header', array('colaboradorpuntoshistorico' => $colaboradorpuntoshistorico, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('colaboradorpuntoshistorico/form', array('colaboradorpuntoshistorico' => $colaboradorpuntoshistorico, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('colaboradorpuntoshistorico/form_footer', array('colaboradorpuntoshistorico' => $colaboradorpuntoshistorico, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>  
</div>

<?php use_javascript('jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/JqueryAutocomplete.css') ?>

<style type="text/css">
    .newclass{
        background-color: #FF3333;
        border: medium none;
        color: #DD3333;
        margin: 0 0 7px;
    }
</style>

<script type="text/javascript">
  
  function checkValue(e)
  {
    return true;
		var keyCode = e.which		

		// allow backsapce comma number and point
		if( (keyCode == 8) || (keyCode == 44) || (keyCode == 46) || (keyCode >= 48 && keyCode <= 57) || (keyCode == 96) || (keyCode == 13) || (keyCode == 0) || (keyCode == 45))
		{	
			return true;
		}
		
		return false;
  }
  
</script>
