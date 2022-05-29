<?php

namespace App\Models;

use App\Traits\Epoch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use Epoch, HasFactory;

    protected $table = 'product_categories';

    protected $fillable = [
        'name',
    ];
}
