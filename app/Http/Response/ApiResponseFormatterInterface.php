<?php

namespace App\Http\Response;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

interface ApiResponseFormatterInterface extends ResponseFactory
{
    /**
     * @param string $message
     * @param array $data
     * @param int $status
     * @param array $parameters
     *
     * @return JsonResponse
     */
    public function success(string $message, array $data = [], int $status = Response::HTTP_OK, array $parameters = []);

    /**
     * @param string $message
     * @param array $errors
     * @param int $status
     * @param array $parameters
     *
     * @return JsonResponse
     */
    public function error(string $message, array $errors = [], int $status = Response::HTTP_UNPROCESSABLE_ENTITY, array $parameters = []);
}
