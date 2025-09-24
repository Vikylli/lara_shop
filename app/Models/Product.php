<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
     protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'status_id',
        'img',
        'price',
        'old_price',
    ];

      public function sluggable()
    {
        return [
            'slug'=> [
                'source'=> 'title'
            ]
            ];
    }


        

       public function category()
    {
        return $this->belongsTo(Category::class);
    }
       public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function getImage()
    {
        if (!$this->img){
            return asset('no-image.png');
        } else{
            return asset("assets/front/images/{$this->img}");
        }
    }
}
