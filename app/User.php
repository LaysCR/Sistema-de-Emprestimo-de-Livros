<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "rbk_users";
    protected $primaryKey = "usr_id";

    protected $fillable = [
        'usr_name', 'usr_email', 'usr_password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'usr_password', 'remember_token',
    ];

    public function book()
    {
      $this->hasMany(Book::class);
    }
}
