<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait RestExceptionHandlerTrait
{
    protected $request;
    protected $e;

    /**
    * Creates a new JSON response based on exception type.
    *
    * @param Request $request
    * @param Exception $e
    * @return \Illuminate\Http\JsonResponse
    */
    protected function getJsonResponseForException(Request $request, Exception $e)
    {
        $this->request = $request;
        $this->e       = $e;

        if ($e instanceof ModelNotFoundException) {
            return $this->modelNotFound();
        }

        if ($e instanceof ValidationException) {
            return $this->validation();
        }

        if ($e instanceof HttpException && $e->getStatusCode() == 403) {
            return $this->badRequest('Unauthorized Access', 403);
        }

        return $this->badRequest();
    }

    /**
    * Returns json response for generic bad request.
    *
    * @param string $message
    * @param int $statusCode
    * @return \Illuminate\Http\JsonResponse
    */
    protected function badRequest($message='Bad request', $statusCode=400)
    {
        return $this->jsonResponse(['error' => $message], $statusCode);
    }

    /**
    * Returns json response for Eloquent model not found exception.
    *
    * @param string $message
    * @param int $statusCode
    * @return \Illuminate\Http\JsonResponse
    */
    protected function modelNotFound($message='Resource not found', $statusCode=404)
    {
        return $this->jsonResponse(['error' => $message], $statusCode);
    }

    /**
    * Returns json response for ValidationException
    *
    * @param string $message
    * @param int $statusCode
    * @return \Illuminate\Http\JsonResponse
    */
    protected function validation($message='Validation Failed', $statusCode=422)
    {
        return $this->jsonResponse(['errors' => $this->e->validator->messages()], $statusCode);
    }

    /**
    * Returns json response.
    *
    * @param array|null $payload
    * @param int $statusCode
    * @return \Illuminate\Http\JsonResponse
    */
    protected function jsonResponse(array $payload=null, $statusCode=404)
    {
        $payload = $payload ?: [];

        return response()->json($payload, $statusCode);
    }
}
