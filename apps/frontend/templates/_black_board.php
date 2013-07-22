<?php $context = sfContext::getInstance() ?>

<div id="block_board" >
  <span id="bm_next"><a href="javascript:void(0)" ><?php echo __('siguiente mensaje') ?></a></span>
  <section class="border-box-n " id="bb-heading" >
    <div class="header-left"><div class="header-right"></div></div>
    <div class="top-left">
      <div class="top-right">

        <span class="bb-head">
          <h2><?php echo __('LA PIZARRA') ?></h2>
        </span>
      </div>
    </div>

  </section>
  <section class="border-box-n blackboard-message" >
    <div class="header-left"><div class="header-right"></div></div>
    <div class="top-left">
      <div class="top-right">
        <div id="blackboard-message">
        </div>
      </div>
    </div>
    <div class="bottom-left">
      <div class="bottom-right"></div>
    </div>
  </section>
</div>
<script type="text/javascript">
  //get windows height
  var windowHeight = $(window).height(); 
  //get blackboard section
  var section = "<?php echo isset($section) ? $section : '' ?>";
  //get blackboard rank
  var rank = "<?php echo $sf_user->getHierarchy(); ?>";
  
  var index = 0;
  //set scroll speed
  var speed =500;
  //set list limit
  var limit= 10;
  
  $('document').ready(function(){
    displayBlackboard();
  });
  
  function displayBlackboard(){
    //fetch black borad records
    var request = $.ajax({
      url: "<?php echo url_for('blackboard_list') ?>",
      data: {'section':section, 'rank': rank},
      success: function(content){
        //add black board records
        $("#blackboard-message").html(content);
        if($("#blackboard-message li").length){
          //show black borad messages
          
        }else{
          //hide blackboard
          $('#block_board').hide();
        }
        
      }
    });
    if(typeof request_list != 'undefined'){
      request_list.push(request);
    }
     
  }
</script>