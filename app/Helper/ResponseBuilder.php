<?php

namespace App\Helper;

use stdClass;

class ResponseBuilder
{
    public static function json($msg = "", $data = [], $http_status_code = 200, $errors = NULL, $headers = [])
    {
        if (empty($data)) {
            $data = new stdClass();
        }

        if (empty($errors)) {
            $errors = new stdClass();
        }

        $body = [
            "message" => $msg,
            "errors" => $errors,
            "data"  => $data,
        ];

        return response()->json($body, $http_status_code, $headers, JSON_UNESCAPED_UNICODE);
    }
}
