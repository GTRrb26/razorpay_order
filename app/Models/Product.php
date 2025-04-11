<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';


    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
}
