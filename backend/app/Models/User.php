<?php namespace App\Models;

use Event;
use Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Notifications\Notifiable;

class User extends BaseUser
{
    use Notifiable;

    /*
    Password reset emails now use the new Laravel notifications feature.
    If you would like to customize the notification sent when sending password reset links,
    you should override the  sendPasswordResetNotification  method
    of the Illuminate\Auth\Passwords\CanResetPassword trait.
    */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'password',
        'image',
        'phone_number',
        'private_phone_number',
        'job_title',
        'key_skill',
        'public_key',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->password = bcrypt($user->password);
        });
    }

    /* We need it instead of Presenter for populate drop downs */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

}
