<?php

namespace App\Traits;

trait CommonTrait
{
    public function sendResponse($response, $statusCode = 200)
    {
        $cresponse['status'] = 'success';
        $cresponse['success'] = true;
        $cresponse['data'] = $response;
        return response()->json($cresponse, $statusCode, array('Content-Type'=>'application/json', 'charset'=>'utf-8' ));

    }

    public function sendError($error, $code = 404)
    {
        $response = $this->getFormatedErrors($error, $code);
        return response()->json($response, 404);
    }

    public function getFormatedErrors($error, $code)
    {
        return [
            'stausCode' => $code,
            'status' => 'error',
            'success' => false,
            'errors' => $error,
        ];
    }
}
