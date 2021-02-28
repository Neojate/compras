<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    protected $table = 'lista';
    protected $fillable = ['user_id', 'name', 'description', 'market', 'total_price'];

    public function Productos() {
        return $this->hasMany(Product::class);
    }
}
