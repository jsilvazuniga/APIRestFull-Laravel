<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CategoryResource;

class Category extends Model
{
    public $resource = CategoryResource::class;

    protected $fillable = [
        'name',
        'description'
    ];

    public function products()
    {   //una categoria puede tener varios productos
        return $this->belongsToMany(Product::class);
    }

      /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot',
    ];
}
