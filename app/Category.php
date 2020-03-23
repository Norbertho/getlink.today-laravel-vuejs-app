<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subcategories(){
        return $this->hasMany(subcategory::class);
    }
    public function domains(){
        return $this->hasMany(domain::class);
    }
}
