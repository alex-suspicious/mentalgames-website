<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use App\Additions\User\HasBackgroundPhoto;
use Laravel\Sanctum\HasApiTokens;

use App\Models\SubscriptionUser;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use HasBackgroundPhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'url',
        'bio',
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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
        'background_photo_url',
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

    function getSubscribersCountAttribute() {
        return SubscriptionUser::where('author', $this->attributes['id'])->count();
    }

    function getSubscribedCountAttribute() {
        return SubscriptionUser::where('subscriber', $this->attributes['id'])->count();
    }

    // I use numbers instead of bools to then show if user is on mobile platform
    function getOnlineAttribute() {
        $session = DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
            ->where('user_id', $this->attributes['id'])
            ->orderBy('last_activity', 'desc')
            ->first();

        if( !$session )
            return 0;

        $difference = time() - $session->last_activity;
        if( $difference < 25 )
            return 1;

        return 0;
    }
}
