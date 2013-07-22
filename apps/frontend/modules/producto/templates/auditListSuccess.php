<div class="container">
  <?php foreach($product_audit_records as $index => $audit_record):?>
  <a class="l-audita" href="javascript:void(0)" data-company="<?php echo $audit_record['Producto']['id']?>" data-id="<?php echo $audit_record['id']?>">
    <?php echo image_tag('/images/img/television_top.jpg')?>
    <p><?php echo date('Y-m-d', strtotime($audit_record['created_date']))?></p>
  </a>
  <?php endforeach;?>
</div>

<script type="text/javascript">
  var url = "<?php echo '/product/auditaRecord/' ?>";
  
  $(document).ready(function(){
    //when audit button is click
    $('.l-audita').bind('click', function(){
      var audit_id = $(this).data('id');
      var company_id = $(this).data('company');
      //request for audit records
      $.ajax({
        url: url+ 'product/'+ company_id+'/id/'+audit_id,
        success: function(data){
         $('#audit-list-' + company_id).html(data) ; 
         $('.a-list').addClass('hidden');
         $('#audit-list-' + company_id).removeClass('hidden');
        }
        
      })
    });
    
  });
</script>