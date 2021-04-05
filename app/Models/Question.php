<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function responses()
    {
        return $this->hasMany(SurveyResponse::class);
    }
}
