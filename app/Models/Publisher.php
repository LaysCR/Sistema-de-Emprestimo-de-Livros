<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    //

    public function book() {
      return $this->belongsTo(Books::class);
    }
}