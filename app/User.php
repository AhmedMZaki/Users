<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function SearchForUser($name)
    {

        return self::query()
            ->select('name')  // just select the name if need all user info use * , else use ['name','email']
            ->where('name', 'like', '%'.self::optimzeSearchInput(trim($name)).'%')
            ->get();
    }

    public static function optimzeSearchInput($name)
    {
        $patterns = array("/إ|أ|آ/", "/ي|ئ/", "/ة/", "/ؤ/");
        $replacements = array("ا", "ى", "ه", "و");
       return preg_replace($patterns, $replacements, $name);
    }
}
