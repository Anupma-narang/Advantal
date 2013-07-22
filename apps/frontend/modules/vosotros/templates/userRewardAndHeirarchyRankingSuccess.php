<div class="con-p">
    <div class="bd-l list-f">
        <?php if (count($reward_ranking_records)): ?>
            <span class="rh-h cbbro-color"><?php echo __('+ recompensas') ?></span>
            <ul class="cn-lt">
                <?php foreach ($reward_ranking_records as $index => $raking_user): ?>
                    <li class="<?php echo $index % 2 ? '' : 'org-back' ?>">
                        <a href="vosotros/rewardRanking/page/1?box=box<?php echo $raking_user->getId() ?>">
                            <div class="cn-l rhb">
                                <span class="block"><?php echo $index + 1 ?></span>
                                <?php $image = $raking_user->getImage() ? $raking_user->getImage() : 'default.png' ?>
                                <?php echo image_tag(basename(sfConfig::get('sf_upload_dir_name')) . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . $image, array('class' => 'block')) ?>
                            </div>
                            <div class="cn-r">

                                <strong class="cn-ep width25 block cbr-color"><?php echo truncate_text($raking_user->getUsername(), 25); ?></strong>
                                <strong class="cbg-color width25 block gr-l"><?php echo truncate_text($hierarchy_list[$raking_user->getHierarchy()], 25); ?></strong>
                                <strong class="cbbro-color width25 block rc-l"><?php echo $sf_user->getMoneyInFormat($raking_user->getMoneySum()) . ' €'; ?></strong>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="bd-r list-f hidden">
        <?php if (count($reward_ranking_records)): ?>
            <span class="rp-h cbb-color"><?php echo __('+ puntos') ?></span>
            <ul class="cn-lt">
                <?php foreach ($hierarchy_ranking_records as $index => $hierarchy_user): ?>
                    <li class="<?php echo $index % 2 ? '' : 'org-back' ?>">
                        <a href="vosotros/hierarchyRanking/page/1?box=box<?php echo $hierarchy_user->getId() ?>">
                            <div class="cn-l rhb">
                                <span class="block"><?php echo $index + 1 ?></span>
                                <?php $image = $raking_user->getImage() ? $raking_user->getImage() : 'default.png' ?>
                                <?php echo image_tag(basename(sfConfig::get('sf_upload_dir_name')) . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . $image, array('class' => 'block')) ?>
                            </div>
                            <div class="cn-r ">

                                <strong class="cn-ep width25 block  blk bold cbr-color"><?php echo $hierarchy_user->getUsername(); ?></strong>
                                <strong class="cbg-color width25 block  gr-l"><?php echo $hierarchy_list[$hierarchy_user->getHierarchy()]; ?></strong>
                                <strong class="cbb-color  width25 block rc-l"><?php echo $sf_user->getMoneyInFormat($hierarchy_user->getAccumulatedPoints()) . ' puntos'; ?></strong>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="b-btn btn-footer">
        <span class="rh-b btn-f" onclick="showList('contenido_home_cuatro_a', 'bd-l')" title="Ver ranking por caja acumulada"></span>
        <span class="rp-b btn-f" onclick="showList('contenido_home_cuatro_a', 'bd-r')" title="Ver ranking por puntos acumulados"></span>
    </div>
    <div class="bd-f ">
        <div class="bd-l-s sview right">

            <form class="s-view hidden" action="/vosotros/rewardRanking" method="POST">
                <input type="text" id="rewar_ranking_user"  name="rewar_ranking[user]"  size="15" maxlength="70">
                <input type="hidden" value="1" name="static"/>
            </form>
            <?php echo link_to('&nbsp;', url_for('reward_ranking'), array('title' => 'Ver todos los colaboradores en el ranking de recompensas', 'class' => 'bt_ver')); ?>
        </div>

        <div class="bd-r-s sview hidden right">


            <form class="s-view hidden" action="/vosotros/hierarchyRanking" method="POST">
                <input type="hidden" value="1" name="static"/>
                <input type="text" id="hierarchy_ranking_user" name="hierarchy_ranking[user]" size="15" maxlength="70">

            </form>
            <?php echo link_to('&nbsp;', url_for('hierarchy_ranking'), array('title' => 'Ver todos los colaboradores en el ranking de puntos acumulados', 'class' => 'bt_ver')); ?>
        </div>


    </div>
</div>
<script type="text/javascript">
            showList('contenido_home_cuatro_a', '<?php echo $sf_user->getAttribute('contenido_home_cuatro_a') ? $sf_user->getAttribute('contenido_home_cuatro_a') : 'bd-l' ?>');
</script>