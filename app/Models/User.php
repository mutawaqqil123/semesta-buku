<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'token_user'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function booted()
    {
        static::creating(function ($user) {
            $user->token_user = Str::random(16);
        });

        static::created(function ($user) {
            $user->profile()->create([
                'token_profile' => Str::random(16),
            ]);
        });

        static::updating(function ($user) {
            $user->token_user = Str::random(16);
            $user->profile()->update([
                'token_profile' => Str::random(16),
            ]);
        });
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function subscription()
    {
        return $this->hasMany(Subscription::class, 'user_id', 'id');
    }

    public function blog()
    {
        return $this->hasMany(Blog::class, 'user_id', 'id');
    }

}
