<?php

include_partial('reward_ranking', array('reward_ranking_pager' => $reward_ranking_pager,
    'user' => isset($user) ? $user : null,
    'page_value' => $page,
    'uri' => $uri));
?>
