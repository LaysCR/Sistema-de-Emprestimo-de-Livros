<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //

    public function user()
    {
      $this->belongsToMany(Book::class);
    }
}
