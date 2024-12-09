<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;


class ErrorServices
{

    public function __construct(){}

    public function handleError(callable $request)
    {
        try {

            return $request();

        } catch (\Exception $e) {

            Log::error("Error Inesperado", [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'code' => $e->getCode()
            ]);

            return back();
            
        }
    }
}
