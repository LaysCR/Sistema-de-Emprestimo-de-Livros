<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "rbk_books";
    protected $primaryKey = "bk_id";

    protected $fillable = [
        'bk_name', 'bk_author', 'pub_id', 'bk_owner', 'bk_description'
    ];

    protected $hidden = [
        'remember_token'
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function publisher()
    {
      return $this->belongsTo(Publisher::class);
    }

    public function tag()
    {
      return $this->hasMany()(Tag::class);
    }
}
