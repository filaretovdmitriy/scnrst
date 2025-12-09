<?php

namespace App\Exceptions\AiClient;

class AiClientAuthException extends AiClientException
{
    public function __construct(string $message = 'Ошибка авторизации AI клиента', int $code = 401)
    {
        parent::__construct($message, $code);
    }
}
