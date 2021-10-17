<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $table = 'products';
    public $fillable = [
        'name',
        'descreption',
        'discount',
        'Weight',
        'price',
        'country_id',
        'category_id',
        'discount_id',
    ];

}
