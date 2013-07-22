<?php

include_partial('heirarchy_ranking', array('hierarchy_ranking_pager' => $hierarchy_ranking_pager,
    'user' => isset($user) ? $user : null,
    'hierarchy_list' => $hierarchy_list,
    'uri' => $uri,
    'page_value' => $page));
?>