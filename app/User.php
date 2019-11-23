<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    /**
     * Get the comments for the User.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Display the relationship data in custom column(userComments).
     *
     * @param \App\User
     * @return string
     */
    public static function laratablesCustomUserComments($user)
    {
        return $user->comments->implode('content', ',');
    }
}
