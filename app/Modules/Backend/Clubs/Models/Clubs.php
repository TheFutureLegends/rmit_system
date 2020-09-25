<?php

namespace App\Modules\Backend\Clubs\Models;

use App\Modules\Backend\Events\Models\Events;
use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Spatie\MediaLibrary\InteractsWithMedia; // v8
use Spatie\MediaLibrary\MediaCollections\Models\Media; // v8
use Spatie\MediaLibrary\HasMedia; // v8
// use Spatie\MediaLibrary\MediaCollections\File; // v8
use Webpatser\Uuid\Uuid;
// v8

class Clubs extends Model implements HasMedia
{
    use Sluggable, InteractsWithMedia;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clubs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'president_id', 'advisor_id', 'abbreviation',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    /**
     * Defining collection name
     *
     * @var array
     */
    public array $collectionName = ['logo'];

    /**
     * Defining new media collection
     *
     * @var null
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->useDisk(env("MEDIA_DISK"))
            ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png'])
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('main')
                    ->width(950)
                    ->height(580);

                $this
                    ->addMediaConversion('avatar')
                    ->width(100)
                    ->height(100);

                $this
                    ->addMediaConversion('bio')
                    ->width(150)
                    ->height(150);
                $this
                    ->addMediaConversion('thumb')
                    ->width(40)
                    ->height(40);
            });
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            do {
                $model->id = (string) Uuid::generate(4);
            } while ($model->where($model->getKeyName(), $model->id)->first() != null);
        });
    }

    protected function getColumns()
    {
        return Schema::getColumnListing($this->table);
    }

    public function getMetaAttribute($value)
    {
        return json_decode($value, true);
    }

    public function scopeExclude($query, $value = array())
    {
        return $query->select(array_diff($this->getColumns(), (array) $value));
    }

    /**
     * Get the user who is the president of club
     */
    public function president()
    {
        return $this->belongsTo(User::class, 'president_id');
    }

    /**
     * Get the user who is the advisor of club
     */
    public function advisor()
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }

    /**
     * Get a listing of events belong to the club
     */
    public function event()
    {
        return $this->hasMany(Events::class, 'club_id', 'id');
    }
}
