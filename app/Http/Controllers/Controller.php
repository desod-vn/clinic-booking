<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

abstract class Controller
{
    protected function apiSuccess(mixed $data = [], string $message = 'Success')
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }

    protected function apiError(string $message = 'Server error', array $errors = [], ?Throwable $exception = null)
    {
        $httpCode = 500;

        if ($exception instanceof ValidationException) {
            $httpCode = 422;
        } elseif ($exception instanceof AuthenticationException) {
            $httpCode = 401;
        } elseif ($exception instanceof AuthorizationException) {
            $httpCode = 403;
        } elseif ($exception instanceof ModelNotFoundException) {
            $httpCode = 404;
        } elseif ($exception instanceof HttpException) {
            $httpCode = $exception->getStatusCode();
        }

        return response()->json([
            'status' => false,
            'message' => $exception ? $exception->getMessage() : $message,
            'errors' => $errors,
        ], $httpCode);
    }
}
