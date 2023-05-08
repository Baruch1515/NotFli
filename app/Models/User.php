<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    public function likes()
{
    return $this->hasMany(Like::class);
}
public function follow(User $user)
{
    return $this->follows()->save($user);
}

public function follows()
{
    return $this->belongsToMany(User::class, 'follows', 'user_id', 'followed_user_id');
}


public function followers()
{
    return $this->belongsToMany(User::class, 'follows', 'followed_user_id', 'user_id');
}

public function followersCount()
{
    return $this->followers()->count();
}
public function following(User $user)
{
    return $this->follows()->where('followed_user_id', $user->id)->exists();
}
public function unfollow(User $user)
{
    $this->follows()->detach($user->id);
}


}
