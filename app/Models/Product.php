<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'image',
        'quantity',
        'price',
        'type_id',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}