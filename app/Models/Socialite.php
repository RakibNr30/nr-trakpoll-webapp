<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socialite extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'google_client_id',
        'google_client_secret',
        'facebook_client_id',
        'facebook_client_secret',
        'app_secret_key',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'google_client_id' => 'string',
        'google_client_secret' => 'string',
        'facebook_client_id' => 'string',
        'facebook_client_secret' => 'string',
        'app_secret_key' => 'string',
    ];
}

