<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'category',
        'name',
        'inventory_number',
        'language',
        'author',
        'year',
        'page_count',
        'photo',
        'location',
    ];

    public const VALIDATION_RULES = [
        'name' => [
            'string',
            'min:2',
            'max:255',
        ],
    ];
}
