<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'name', 'slug', 'image', 'icon'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name', // Ganti dengan atribut yang ingin diambil sebagai sumber slug
            ],
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
