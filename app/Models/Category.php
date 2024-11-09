<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'name',
        'active',
    ];
}
