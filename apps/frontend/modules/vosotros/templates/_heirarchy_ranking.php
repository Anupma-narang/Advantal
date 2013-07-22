<?php $list_count = count($hierarchy_ranking_pager->getResults()); ?>
<?php if ($list_count): ?>
    <?php $page = $hierarchy_ranking_pager->getPage(); ?>
    <div class="cr-block-left block">
        <?php foreach ($hierarchy_ranking_pager as $index => $raking_user): ?>
            <?php $position = (($page - 1) * 20) + $index + 1; ?>
            <?php if ($position <= 3): ?>
                <?php $box_class = 'c-first-third'; ?>
                <?php $rank_class = 'c-rank-first'; ?>
            <?php elseif ($position <= 10): ?>
                <?php $box_class = 'c-first-ten'; ?>
                <?php $rank_class = 'c-rank-ten'; ?>
            <?php else: ?>
                <?php $box_class = ''; ?>
                <?php $rank_class = ''; ?>
            <?php endif; ?>
            <?php if (isset($user)): ?>
                <?php if ($user->getId() == $raking_user->getId()): ?>
                    <?php $box_class = 'c-you'; ?>
                    <?php $rank_class = ''; ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($index == 10): ?>
            </div>
            <div class="cr-block-right block ">
            <?php endif; ?>
            <div class="cr-rank-block block" id="box<?php echo $raking_user->getId() ?>">
                <!-- contributors rank -->
                <span class="c-rank block <?php echo $rank_class; ?>"><?php echo (20 * ($page - 1) + $index + 1); ?></span>
                <div class="cr-content block <?php echo $box_class; ?>" data-user-id ="<?php echo $raking_user->getId() ?>">

                    <?php if (isset($user) && $user->getId() == $raking_user->getId()): ?>
                        <span class="box width100 blue"><?php echo __('TÚ') ?></span>
                    <?php else: ?>
                        <span class="box width100"><?php echo $raking_user->getUsername() ?></span>
                    <?php endif; ?>

                    <span class="box width100  verde"><?php echo $hierarchy_list[$raking_user->getHierarchy()]; ?></span>
                    <span class="box width100 caja"><?php echo __('Puntos acumulados:') ?></span>
                    <span class="box width100 caja-value"><?php echo $sf_user->getMoneyInFormat($raking_user->getAccumulatedPoints()); ?></span>
                    <?php if ($raking_user->getImage()): ?>
                        <?php echo image_tag(sfConfig::get('sf_user_image_path') . $raking_user->getImage(), array('class' => 'c-profile')) ?>
                    <?php else: ?>
                        <?php echo image_tag(sfConfig::get('sf_user_image_path') . 'default.png', array('class' => 'c-profile')) ?>
                    <?php endif; ?>
                    <div class="a-content"></div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
    <div class="buscador">
        <p><a class="resetForm" href="#content_vosotros" title="Vuelve al ranking de colaboradores"><?php print __('vuelve al ranking') ?></a></p>
    </div>

    <div id="content_laslistas_right" class="buscador">
        <?php if ($hierarchy_ranking_pager->haveToPaginate()): ?>
            <div class="pagination">
                <?php print link_to_function(image_tag('/images/first.png', array('title' => 'Primera')), 'pager(' . $hierarchy_ranking_pager->getFirstPage() . ')', array('href' => '/vosotros/hierarchyRanking', 'data-page' => $hierarchy_ranking_pager->getFirstPage())) ?>
                <?php print link_to_function(image_tag('/images/previous.png', array('title' => 'Anterior')), 'pager(' . $hierarchy_ranking_pager->getPreviousPage() . ')', array('href' => '/vosotros/hierarchyRanking', 'data-page' => $hierarchy_ranking_pager->getPreviousPage())) ?>
                <?php
                $pages = array();
                foreach ($hierarchy_ranking_pager->getLinks() as $page) {
                    $pages[] = ($page == $hierarchy_ranking_pager->getPage()) ? $page : link_to_function($page, 'pager(' . $page . ')', array('href' => '/vosotros/hierarchyRanking', 'data-page' => $page));
                }
                print implode(' - ', $pages);
                ?>
                <?php print link_to_function(image_tag('/images/next.png', array('title' => 'Siguiente')), 'pager(' . $hierarchy_ranking_pager->getNextPage() . ')', array('href' => '/vosotros/hierarchyRanking', 'data-page' => $hierarchy_ranking_pager->getNextPage())) ?>
                <?php print link_to_function(image_tag('/images/last.png', array('title' => 'Última')), 'pager(' . $hierarchy_ranking_pager->getLastPage() . ')', array('href' => '/vosotros/hierarchyRanking', 'data-page' => $hierarchy_ranking_pager->getLastPage())) ?>
            </div>
        <?php endif; ?>
    </div>

<?php else: ?>
    <div class="border-box left-box">
        <div class="top-left">
            <div class="top-right">
                <div>
                    <p><?php echo __('No hemos encontrado colaboradores con estas características.') ?></p>
                    <p><a class="resetForm" href="javascript:void(0)" title="Vuelve al ranking de colaboradores"><?php print __('vuelve al ranking') ?></a></p>
                </div>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>
<?php endif; ?>
<div class="content pequeno hidden " id="user_login_box">
    <section class="border-box-n b-alert">
        <div class="header-left"><div class="header-right"></div></div>
        <div class="top-left">
            <div class="top-right">
                <p>Para <strong>ver esa información</strong> necesitas ser colaborador.</p>
                <ul class="bundle">
                    <li>
                        <a data-path="/guard/login?redirect=<?php echo $uri ?>/page/<?php echo $page_value; ?>" id="login-uri" href="/guard/login?redirect=<?php echo $uri ?>/page/<?php echo $page_value; ?>"  title="ya soy colaborador">ya soy colaborador.</a></li>
                    <li>
                        ¿Aún no eres colaborador? ¡<a href="/frontend_dev.php/registro" target="_blank" title="Crea una cuenta">Crea una cuenta</a> ahora!
                    </li>
                </ul>
                <br>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>
</div>
<?php include_partial('global/black_board', array('section' => 'RC')) ?>
<a href="#user_login_box" id="user_login_box_anchor" class="hidden lightbox-i">login</a>
<script type="text/javascript">
    $('document').ready(function() {
        $('.resetForm').unbind('click').bind('click', function() {
            $('#hierarchy_ranking_user').val('');
            $('#hierarchy_ranking_hierarchy').val('0');
            $('#page-index').val(1);
            $('html, body').animate({scrollTop: $('#content_vosotros').position().top}, 'fast');
            showRewardRanking("<?php echo url_for('hierarchy_ranking'); ?>");
        });
        //user contest and contribution list action
        $(".cr-content").bind('click', function() {
            var base_tr = $(this);
            //if content is empty
            if (!$(base_tr).find('.a-content').html()) {
                //remove contents from all box
                $(".user-contribution-contest-list").remove();
                //request for records
                $.ajax({
                    url: '/vosotros/getUsersHierarchyHistory',
                    data: {'user_id': $(this).data('user-id'), 'box': '<?php echo $sf_request->getParameter('box') ?>'},
                    type: 'POST',
                    success: function(data) {
                        $('.a-content').html('');
                        $('.caja').show();
                        $('.caja-value').show();
                        $(base_tr).find('.a-content').html(data);
                        // $(base_tr).find('.caja').hide();
                        // $(base_tr).find('.caja-value').hide();
                    }
                });
            }
            //empty the content
            else {
                // $(base_tr).find('.a-content').html('');
            }
        });
    });
</script>