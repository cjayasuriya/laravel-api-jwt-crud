<?php

namespace App\Models\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Product extends Model
{
    use HasApiTokens, Notifiable;

    protected $table = 'products';

    protected $fillable = [
        'sku', 'name', 'brand', 'model', 'uom', 'prices', 'weight', 'weightUnit', 'sizes', 'sizeUnit',
        'description', 'imgPath', 'meta', 'statusID', 'status', 'cuid', 'uuid'
    ];

}
