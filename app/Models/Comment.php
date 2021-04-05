<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
