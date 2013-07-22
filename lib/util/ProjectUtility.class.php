<?php

/**
 * Clase de utilidad. Utility
 */
class ProjectUtility
{

    const JSON_SUCCESS = 'success';
    const JSON_ERROR = 'error';


    /**
     * Decora el objecto Response con los headers de un JSON
     *
     * @param sfWebResponse $response
     */
    public static function decorateJsonResponse(sfWebResponse $response)
    {
        $response->setContentType('application/json');
        // prevent response caching on client side
        $response->addCacheControlHttpHeader('no-cache, must-revalidate');
//    $response->setHttpHeader('Expires', 'Mon, 26 Jul 1997 05:00:00 GMT');
    }

}