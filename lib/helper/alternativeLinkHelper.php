<?php

function authenticated_link_to($user, $authenticated_link_text, $authenticated_link_uri, $unauthenticated_link_text, $unauthenticated_link_uri, $authenticated_options = array(), $unauthenticated_options = array())
{
    if ($user->isAuthenticated())
    {
        return link_to($authenticated_link_text, $authenticated_link_uri, $authenticated_options);
    }
    else
    {
        return link_to($unauthenticated_link_text, $unauthenticated_link_uri, $unauthenticated_options);
    }
}