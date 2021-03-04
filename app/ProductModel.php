<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['title','slug','short_description','description','price','image','fk_category',
        'created_at', 'updated_at','deleted_at'];
}
