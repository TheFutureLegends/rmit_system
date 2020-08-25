<?php

namespace App;

use Webpatser\Uuid\Uuid;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Modules\Backend\Clubs\Models\Clubs;
use App\Modules\Backend\Teams\Models\Teams;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasRoles, HasPermissions, InteractsWithMedia;

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    protected $table = 'users';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token', 'about_me',
        // For developing purpose only
        'status'
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

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            do {
                $model->id = (string) Uuid::generate(4);
            } while ($model->where($model->getKeyName(), $model->id)->first() != null);
        });
    }

    /**
     * Defining new media collection
     *
     * @var null
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png'])
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('card')
                    ->width(400)
                    ->height(400);

                $this
                    ->addMediaConversion('profile')
                    ->width(128)
                    ->height(128);

                $this
                    ->addMediaConversion('header')
                    ->width(64)
                    ->height(64);
            });
    }

    public function formatRoleName()
    {
        return format_string((Auth::user()->roles->pluck('name'))[0]);
    }

    public function scopeExcept_Type($query, $value = '')
    {
        return $query->join('teams', 'teams.leader_id', '=', $value)->select('teams.member_id')->toArray();
    }

    /**
     * Get the user who is the president of club
     */
    public function president()
    {
        return $this->hasOne(Clubs::class, 'president_id');
    }

    /**
     * Get the user who is the advisor of club
     */
    public function advisor()
    {
        return $this->hasMany(Clubs::class, 'advisor_id');
    }

    /**
     * Get the user who is the leader.
     */
    public function leader()
    {
        return $this->hasMany(Teams::class, 'leader_id');
    }

    /**
     * Get the user who is the member.
     */
    public function member()
    {
        return $this->hasOne(Teams::class, 'member_id');
    }
}
