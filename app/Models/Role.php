<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $table = "rbk_roles";
    protected $primaryKey = "rle_id";

    public function user()
    {
      return $this->belongsToMany(User::class);
    }
}
