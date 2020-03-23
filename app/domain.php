<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class domain extends Model
{
    protected $fillable = [
        'title', 'url', 'email', 'img', 'shortdescription', 'description', 'paid', 'published'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subcategory(){
        return $this->belongsTo(subcategory::class);
    }
}
