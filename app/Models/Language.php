<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'language',
    ];

    public const VALIDATION_RULES = [
        'language' => [
            'string',
            'min:2',
            'max:100',
            'required',
        ],
    ];
}
