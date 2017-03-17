<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Book-Tag extends Model
{
    protected $hidden = ['book_id', 'tag_id', 'remember_token'];

    public function book() {
      return $this->hasMany(Books::class);
    }

    public function tag() {
      return $this->hasMany(Books::class);
    }
}
