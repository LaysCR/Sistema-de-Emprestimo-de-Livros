<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = "rbk_publishers";
    protected $primaryKey = "pub_id";

    public function book()
    {
      return $this->hasMany(Book::class);
    }
}
