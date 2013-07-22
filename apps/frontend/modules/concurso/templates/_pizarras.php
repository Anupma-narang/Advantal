 <div style="clear: both"></div>
 <?php if(count($pizarras)) { ?>
 <h3>Pizarra</h3>             

              
              <div id="pizarra">
              <?php 
                        
                            echo "<ul class='lista'>";
                        foreach($pizarras as $k=>$pizarra) : ?>
                            <li class="elem <?php if($k==0) echo "active"; ?>"  id="pizarra-<?php echo $k;?>" speed="<?php echo $pizarra['velocidad'];?>" objid="<?php echo $pizarra['id']; ?>">
                                <div class="name"><?php echo $pizarra['name']; ?></div>
                                <div class="text"><p><?php echo html_entity_decode($pizarra['text']); ?></p></div>
                            </li>    
                        <?php endforeach; 
                                echo "</ul>";
                        ?>
                            
                </div>

 <a href="javascript:void(0)" id="next-p">siguiente</a>
<?php } ?>                
 
 
 <script>
    tempo = 0; 
    num = $('#pizarra ul > li').size();
    pos = 0; 
    //setInterval("pizarra()",1000);
    
    
    $('#next-p').click(function() {
        tempo = 0;
       
        $('#pizarra-'+pos).animate({marginTop:"-150px"}, 1000, function() {
                 $('#pizarra-'+pos).css('marginTop','150px');
                 pos++;
                 if(pos==num) pos = 0;
                  
                 $('#pizarra-'+pos).animate({marginTop:"0px"}, 1000, function() {
                      
                 });
                  
                  
                 
                 // Animation complete.
              });
    });
    
    function pizarra()
    { 
        ids = '';
        $('#pizarra ul li').each(function() {
                ids += $(this).attr('objid')+",";
        });
        
        $.get('<?php echo url_for('concurso/pizarra'); ?>?num='+num+'&ids='+ids,function(data) {
            
            if(data) {
                num++;
                $('#pizarra ul').append(data);
            }
        });
        
              speed = $('#pizarra-'+pos).attr('speed'); 
              
              if(tempo>=speed) {
                  
              tempo = 0;
              
              $('#pizarra-'+pos).animate({marginTop:"-150px"}, 1000, function() {
                 $('#pizarra-'+pos).css('marginTop','150px');
                 pos++;
                 if(pos==num) pos = 0;
                  
                 $('#pizarra-'+pos).animate({marginTop:"0px"}, 1000, function() {
                      
                 });
                  
                  
                 
                 // Animation complete.
              });
              /*$('#pizarra-'+pos).slideUp(1000, function() {
                  pos++;
                  if(pos==num) pos = 0;
                  $('#pizarra-'+pos).slideDown(1000);
              }); */}
          tempo++;
    }

</script>
