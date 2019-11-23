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

     /**
     * Adds the condition for searching the User comment.
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @param string search term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function laratablesSearchUserComments($query, $searchValue)
    {
        return $query->orWhereHas('comments', function ($query) use($searchValue) {
            $query->where('content', 'like', "%". $searchValue ."%");
        });
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date',
    ];

    /**
     * Display currency symbol with format in salary column value.
     *
     * @param \Illuminate\Support\Collection
     * @return \Illuminate\Support\Collection
     */
    public static function laratablesModifyCollection($users)
    {
        return $users->map(function ($user) {
            $user->salary = "$". number_format($user->salary); // $ for currency
            return $user;
        });
    }

    /**
     * Adds the condition for searching the salary if custom/modify for display.
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @param string search term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function laratablesSearchSalary($query, $searchValue)
    {
        if ($searchSalary = filter_var($searchValue, FILTER_SANITIZE_NUMBER_INT)) {
            return $query->orWhere('salary', 'like', '%'. $searchSalary. '%');
        }
    }
}
