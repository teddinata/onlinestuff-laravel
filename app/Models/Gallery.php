<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;


class Gallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id', 'image', 'caption', 'is_default', 'is_featured', 'is_thumbnail'
    ];

    public function getUrlAttribute($url)
    {
        return config('app.url') . Storage::url($url);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
