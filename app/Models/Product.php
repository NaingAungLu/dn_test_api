<?php

namespace App\Models;

use App\Traits\Epoch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use Epoch, HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'category_id',
        'image',
    ];

    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    public function getImageUrlAttribute()
    {
        return Storage::url($this->image);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }
}
