<?php

namespace App\Modules\Backend\Events\Models;

use App\Modules\Backend\Clubs\Models\Clubs;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Spatie\MediaLibrary\HasMedia; // v8
use Spatie\MediaLibrary\InteractsWithMedia; // v8
use Spatie\MediaLibrary\MediaCollections\File; // v8
use Spatie\MediaLibrary\MediaCollections\Models\Media; // v8
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
// use App\Modules\Backend\Comment\Models\Comment;

class Events extends Model implements HasMedia
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
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'author_id', 'club_id', 'start_at', 'end_at', 'status'
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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    protected $dates = ['start_at', 'end_at'];

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

    /**
     * Defining new media collection
     *
     * @var null
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
            ->useDisk(env("MEDIA_DISK"))
            ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png'])
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                // $this
                //     ->addMediaConversion('main')
                //     ->width(950)
                //     ->height(580);
                $this
                    ->addMediaConversion('home')
                    ->width(195)
                    ->height(180);
                $this
                    ->addMediaConversion('list')
                    ->width(362)
                    ->height(222);
                $this
                    ->addMediaConversion('detail')
                    ->width(752)
                    ->height(353);
                $this
                    ->addMediaConversion('thumb')
                    ->width(62)
                    ->height(62);
            });

        $this->addMediaCollection('file')
            ->useDisk(env("MEDIA_DISK"))
            ->acceptsFile(function (File $file) {
                return $file->mimeType === 'application/pdf';
            });
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
     * Scope a query to only include available event.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where([
            ['end_at', '>', Carbon::now(config('app.timezone'))->isoFormat('Y-MM-DD H:mm:ss')],
            ['status', '=', 1]
        ]);
    }

    /**
     * Get the club that owns the event.
     */
    public function club()
    {
        return $this->belongsTo(Clubs::class, 'club_id');
    }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class, 'event_id')->whereNull('reply_id')->orderBy('created_at', 'DESC');
    // }

}
