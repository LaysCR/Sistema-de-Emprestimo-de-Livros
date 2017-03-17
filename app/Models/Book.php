<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['book_name', 'book_author', 'book_owner', 'book_description'];

    protected $hidden = ['publisher_id', 'remember_token'];

    public function user() {
      return $this->belongsTo(User::class);
    }

    public function publisher() {
      return $this->hasMany(Publishers::class);
    }

    public function tag() {
      return $this->hasMany(Tags::class);
    }
}
