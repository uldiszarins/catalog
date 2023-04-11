<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'category_name',
    ];

    public const VALIDATION_RULES = [
        'category_name' => [
            'string',
            'min:2',
            'max:100',
            'required',
        ],
    ];
}
