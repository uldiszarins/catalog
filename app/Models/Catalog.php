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
        'category' => [
            'required'
        ],
        'name' => [
            'required',
            'string',
            'min:2',
            'max:255',
        ],
        'inventory_number' => [
            'required',
        ],
        'language' => [
            'required',
        ],
        'author' => [
            'required',
            'string',
            'min:2',
            'max:255'
        ],
        'year' => [
            'required',
            'date_format:Y',
            'gt:1900',
        ],
        'location' => [
            'nullable',
            'string',
            'max:255',
        ]
    ];
}
