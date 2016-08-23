<?php

namespace Bormborm\Services\Api;

class ApiHelper
{
    public static function isApiCall($request)
    {
        return $request['host'] ==='api.domain.com';
    }
    public static function generateRouteByRequest(array $request)
    {
        $route = 'api';
        $route .= ucfirst(strtolower($request['method']));
        $route .= ucfirst($request['route']);
        return $route;
    }
    public static function getResponseType(array $request)
    {
        if (isset($request['response_type'])) {
            return $request['response_type'];
        }
        return 'html';
    }

}