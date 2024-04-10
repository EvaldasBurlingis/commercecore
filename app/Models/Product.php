<?php

namespace App\Models;

use App\Traits\PriceTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use PriceTrait;

    protected $fillable = [
        'name',
        'price',
    ];

    protected $casts = [
        'price' => 'float',
    ];
}
