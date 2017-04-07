<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Book;

class Loan extends Model
{
    protected $table = "rbk_loans";
    protected $primaryKey = "ln_id";

    public function user()
    {
      return $this->belongsTo(User::class, 'ln_user_id', 'id');
    }

    public function book()
    {
      return $this->hasOne(Book::class, 'bk_id', 'ln_bk_id');
    }
}
