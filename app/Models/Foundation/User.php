<?php

namespace Someline\Models\Foundation;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Someline\Image\Models\Traits\SomelineHasImageablesTrait;
use Someline\Model\Foundation\User as BaseUser;

class User extends BaseUser
{
    use SomelineHasImageablesTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $primaryKey='user_id';
    protected $fillable = [
        'name', 'email', 'password',
        'gender', 'birthday', 'country', 'timezone', 'locale', 'username', 'phone_number', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->hasMany(Post::class,'user_id','user_id');
    }

    /**
     * Called when model is created
     * Other events available are in BaseModelEvents
     */
    public function onCreated()
    {
        parent::onCreated();

    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
