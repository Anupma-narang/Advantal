<?php if (count($blackboard_list)): ?>
    <div id="blackboard-content">
        <ul class="bb_ul">
            <?php foreach ($blackboard_list as $index => $blackboard): ?>

                <li class="bb_<?php echo $index ?> bb_list" data-speed="<?php echo $blackboard['velocidad']; ?>">
                    <span class="bb_space"></span>
                    <span class="bb_title"><?php echo $blackboard['name']; ?></span>
                    <span class="bb_description"><?php echo html_entity_decode($blackboard['text']); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <script type="text/javascript">
        var speed = Array();
        var height = Array();
        var li_count = 0;
        var li_index = 0;
        $('document').ready(function(){
            $('#bm_next').unbind('click').bind('click', function(){
                if(li_index+1 >= li_count){
                    $('.bb_ul').css('top','0px');
                }else{
                    $('.bb_ul').css('top','0px');
                    for(var pos = 0 ; pos<=li_index ; pos++){
                        $('.bb_ul').css('top',($('.bb_ul').position().top- height[pos]) +'px');
                    }
                
                }
              
                slide(li_index+1);
            });
            li_count = $('#blackboard-content li').length;
            $('#blackboard-content li').each(function(index,obj){
                speed[index] = $(obj).data('speed');
                height[index] = $(obj).find('.bb_space').height() + $(obj).find('.bb_title').height() + $(obj).find('.bb_description').height();
            });
            slide(0);
            
            
        });
          
        function slide(index){
            
            if(index >= li_count){
                displayBlackboard();
                index = 0;
                $('.bb_ul').css('top','0px');
            }
            li_index = index;
            //console.log(li_index);
            $('.bb_ul').stop();
            $('.bb_ul').animate({
                top: '-='+height[index]
            }, speed[index],'linear', function() {
                slide(index+1);
            });
        }
    </script>
<?php endif; ?>


