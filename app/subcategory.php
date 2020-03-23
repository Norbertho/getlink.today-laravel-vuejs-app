<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
   public function Category()
   {
       return $this->belongsTo(Category::class);
   }
   public function domains(){
       return $this->hasMany(domain::class);
   }
}
