<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }




     // 自分をフォローしているユーザー
    public function followers()
    {

        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');

    }



    // 自分がフォローしているユーザー
    public function following()
    {

        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');

    }


    // 指定されたユーザーをフォローしているかどうか
    public function isFollowing($user)
    {
        $userId = $user->id; // $userのIDを取得
        return $this->following->contains($userId);

    }



}
