<?php

namespace Someline\Models\Foundation;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Someline\Image\Models\Traits\SomelineHasImageablesTrait;
use Someline\Model\Foundation\User as BaseUser;

class Post extends BaseUser
{
    use SomelineHasImageablesTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey='post_id';
    protected $fillable = [
        'title', 'body', 'is_recommended'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function user() {
        return $this->belongsTo(User::class,'user_id','user_id');
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
