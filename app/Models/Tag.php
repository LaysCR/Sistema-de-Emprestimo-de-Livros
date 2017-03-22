<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "rbk_tags";
    protected $primaryKey = "tg_id";

    public function user()
    {
      $this->belongsToMany(Book::class);
    }
}
