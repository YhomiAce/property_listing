<?php

namespace App\Traits;

trait HttpResponseTrait {
    protected function success($data, string $message= null, int $code = 200)
    {
        return response()->json([
            "success"=> true,
            'message' => $message,
            'data' => $data
        ], $code);
    }
    protected function error($data = null, string $message= null, int $code)
    {
        return response()->json([
            "success"=> false,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}