<?php

namespace App\Exceptions\AiClient;

class AiClientResponseException extends AiClientException
{
    public function __construct(string $message = "Ошибка ответа от AI сервиса", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
