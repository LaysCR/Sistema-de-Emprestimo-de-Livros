<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BookTag extends Model
{

    public function book()
    {
      return $this->hasMany(Book::class);
    }

    public function tag()
    {
      return $this->hasMany(Tag::class);
    }
}
