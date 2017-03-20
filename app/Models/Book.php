<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
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
      return $this->hasMany(Publisher::class);
    }

}
