<?php

namespace App\DTOs;

use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(public string $name, public string $email, public string $password)
    {
    }
}
