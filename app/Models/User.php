<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [];

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


    /**
     * Get all of the post's addresses.
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Get all the post's phoneable.
     */
    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }


    /**
     * add local scope for getting users wherever it needs
     * @param $query
     */
    public function scopeAgent($query)
    {
        try {
            if (session()->get('user_role') === 'agent' && session()->has('agent_id')) {
                $query->where('agent_id', session()->get('agent_id'));
            }
        } catch (NotFoundExceptionInterface | ContainerExceptionInterface $e) {
        }
    }

    /**
     * get user wallet
     * @return Builder|Wallet|null
     */
    public function wallet(): Builder|Wallet|null
    {
        return Wallet::whereAgentId($this->id)?->first();
    }

    /**
     *  add local scope for setting agent_id to users wherever it needs
     */
    public function scopeAgentCreate()
    {
        static::creating(function ($model) {
            if (session()->get('user_role') === 'agent' && session()->has('agent_id')) {
                $model->agent_id = session()->get('agent_id');
                $model->role = 'agent';
            }
        });
    }

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            Wallet::create([
                'agent_id' => $model->id,
                'agent_username' => $model->username,
                'balance' => 0,
                'updated_at' => null,
            ]);
        });
    }
}
