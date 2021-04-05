<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $guarded = [];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function responses()
    {
        return $this->hasMany(SurveyResponse::class);
    }
}
