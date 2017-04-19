<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Book;
use App\Models\Role;
use App\Models\Loan;
use App\Models\Notification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $primaryKey = "id";

    protected $fillable = [
        'name', 'email', 'password', 'user_rle_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Check if admin
    public function isAdmin()
    {
      if('name' == 'admin'){
        return true;
      }
      return false;
    }

    public function book()
    {
      return $this->hasMany(Book::class);
    }

    public function role()
    {
      return $this->hasOne(Role::class, 'rle_id', 'user_rle_id');
    }

    public function loan()
    {
      return $this->hasMany(Loan::class);
    }

    public function notification()
    {
      return $this->hasMany(Notification::class);
    }
}
