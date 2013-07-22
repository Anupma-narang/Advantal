<?php use_helper('I18N', 'Date') ?>
<?php include_partial('pizarra/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Nuevo mensaje de la Pizarra', array(), 'messages') ?></h1>

  <?php include_partial('pizarra/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('pizarra/form_header', array('pizarra' => $pizarra, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    
    <?php include_partial('pizarra/form', array('pizarra' => $pizarra, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('pizarra/form_footer', array('pizarra' => $pizarra, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
     
    $("#pizarra_hasta_month").bind('change',function(){
      updateMonths();
    });
    $("#pizarra_desde_month").bind('change',function(){
      updateMonths();
    });
    
  });
  function updateMonths(){
    if($("#pizarra_hasta_month").val() && $("#pizarra_desde_month").val()){
      $('.month').removeAttr('checked');
      var start = Math.abs($("#pizarra_desde_month").val());
      var end = Math.abs($("#pizarra_hasta_month").val());
      for(var pos=start;pos<=end;pos++){
        $("#pizarra_months_" + pos).attr('checked','checked');
        
      }
    }
  }
</script>