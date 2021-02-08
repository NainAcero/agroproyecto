<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = "productos";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'SKU',
        'name',
        'slug',
        'short_description',
        'description',
        'regular_price',
        'stock_status',
        'quantity',
        'image',
        'images',
        'category_id'
    ];
}
