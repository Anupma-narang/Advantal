<?php

function signin_link_to($user, $name, $internal_uri, $options = array())
{
    if ($user->isAuthenticated())
        return link_to($name, $internal_uri, $options);
    else {
//		if((isset($options['getref'])) && ($options['getref']==true))
//			sfContext::getInstance()->getUser()->setReferer($internal_uri);
        return "<a href='#" . $options['dialog_id'] . "' id='" . $options['href_id'] . "'>$name</a>";
    }
}

function signin_url_for($user, $internal_uri, $uri_params = array(), $options = array())
{
    if ($user->isAuthenticated()) {
        return url_for($internal_uri, $uri_params, $options);
    } else {
        return '#login_required';
    }
}
