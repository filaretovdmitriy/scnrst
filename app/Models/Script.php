<?php

namespace App\Models;

use App\Enums\ScriptStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Script extends Model
{
    use HasFactory;

    protected $table = 'scripts';

    protected $fillable = [
        'name',
        'description',
        'duration',
        'status',
    ];

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ScriptStatus::from($value),
        );
    }
}
