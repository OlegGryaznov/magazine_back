<?php

namespace App\Traits;


use Illuminate\Support\Facades\Log;

trait LogTrait
{
    public function log(\Exception $exception)
    {
        Log::info($exception->getMessage(), [
            'file' => $exception->getFile(),
            'function' => __FUNCTION__,
            'line' => $exception->getLine(),
            'code' => $exception->getCode(),
        ]);
    }
}
