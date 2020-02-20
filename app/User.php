<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use MustVerifyEmail, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'traveller_name', 'image', 'email', 'password', 'score',
    ];


    protected $attributes = [
            'image' => "pre_profile_image/SizBONBQJhQ6VjTnulHGXG3pGavd4ZSzAVf6mv4v.png",
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

    protected static function boot(){
      parent::boot();

      static::created(function ($user){
          $user->profile()->create([
            'description' => 'よろしくお願いします。'
          ]);
      });
    }

    public function subscribing(){
      return $this->belongsToMany(Album::class);
    }

    public function givenStars(){
      return $this->belongsToMany(Post::class);
    }

    public function comments(){
      return $this->hasMany(Comment::class)->orderBy('created_at', 'DESC');
    }

    public function albums(){
      return $this->hasMany(Album::class)->orderBy('created_at', 'DESC');
    }

    public function posts(){
      return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function profile(){
      return $this->hasOne(Profile::class);
    }

}
