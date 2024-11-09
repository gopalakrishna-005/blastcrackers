<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;



class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'name',
        'thumbnail',
        'active',
        'previous_price',
        'active_price',
        'category_id',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
