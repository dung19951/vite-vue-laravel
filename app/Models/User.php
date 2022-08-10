<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

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

    protected $appends = ['profile_thumbnail','thumbnail'];

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

    public function getProfileThumbnailAttribute()
{
    //Check if media has collection and return default.jpg if false
    if ($this->media->isEmpty()) {
        return 'default.jpg';
    } else {
        return $this->media->first()->getUrl('profile_thumbnail');
    }  
}

public function getThumbnailAttribute()
{
    //Check if media has collection and return default.jpg if false
    if ($this->media->isEmpty()) {
        return 'default.jpg';
    } else {
        return $this->media->first()->getUrl('thumbnail');
    }  
}
}
