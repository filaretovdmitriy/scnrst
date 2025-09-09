<?php

namespace App\Models;

use App\Enums\ScriptStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    protected $casts = [
        'status' => ScriptStatus::class,
    ];
}
