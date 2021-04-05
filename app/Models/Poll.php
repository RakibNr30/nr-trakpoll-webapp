<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Poll extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'title', 'purpose',
    ];

    public function path()
    {
        return url('admin/polls/'.$this->id) ;
    }

    public function publicpath()
    {
        return url('admin/surveys/'.$this->id.'-'.Str::slug($this->title));
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    
    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}
