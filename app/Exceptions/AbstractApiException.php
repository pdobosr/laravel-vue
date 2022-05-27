<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Throwable;

abstract class AbstractApiException extends \Exception
{
    private $httpCode;

    private $errors;

    public function __construct(
        string $message = '',
        array $errors = [],
        int $httpCode = Response::HTTP_UNPROCESSABLE_ENTITY,
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->httpCode = $httpCode;
        $this->errors = $errors;
    }

    public function getErrorHttpCode()
    {
        return $this->httpCode;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
