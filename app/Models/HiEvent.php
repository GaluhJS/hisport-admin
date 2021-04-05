<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class HiEvent extends Model implements HasMedia
{
    use HasAdvancedFilter, SoftDeletes, HasMediaTrait;

    public $table = 'hi_events';

    protected $dates = [
        'start_date',
        'finish_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'event_banner',
        'game_type_label',
        'game_level_label',
        'player_type_label',
    ];

    const PLAYER_TYPE_RADIO = [
        [
            'label' => 'Person',
            'value' => '1',
        ],
        [
            'label' => 'Team',
            'value' => '2',
        ],
    ];

    const GAME_TYPE_RADIO = [
        [
            'label' => 'Public',
            'value' => '1',
        ],
        [
            'label' => 'Private',
            'value' => '2',
        ],
    ];

    const GAME_LEVEL_RADIO = [
        [
            'label' => 'Fun Game',
            'value' => 'F',
        ],
        [
            'label' => 'Tournament',
            'value' => 'T',
        ],
    ];

    protected $orderable = [
        'id',
        'game.name',
        'name',
        'game_type',
        'game_level',
        'price',
        'player_type',
        'start_date',
        'finish_date',
        'format',
        'venue',
        'fee',
    ];

    protected $filterable = [
        'id',
        'game.name',
        'name',
        'game_type',
        'game_level',
        'price',
        'player_type',
        'start_date',
        'finish_date',
        'format',
        'venue',
        'fee',
    ];

    protected $fillable = [
        'game_id',
        'name',
        'game_type',
        'game_level',
        'price',
        'player_type',
        'start_date',
        'finish_date',
        'format',
        'information',
        'venue',
        'fee',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $thumbnailWidth  = 50;
        $thumbnailHeight = 50;

        $thumbnailPreviewWidth  = 120;
        $thumbnailPreviewHeight = 120;

        $this->addMediaConversion('thumbnail')
            ->width($thumbnailWidth)
            ->height($thumbnailHeight)
            ->fit('crop', $thumbnailWidth, $thumbnailHeight);
        $this->addMediaConversion('preview_thumbnail')
            ->width($thumbnailPreviewWidth)
            ->height($thumbnailPreviewHeight)
            ->fit('crop', $thumbnailPreviewWidth, $thumbnailPreviewHeight);
    }

    public function game()
    {
        return $this->belongsTo(HiGame::class);
    }

    public function getEventBannerAttribute()
    {
        return $this->getMedia('hi_event_event_banner')->map(function ($item) {
            $media                      = $item->toArray();
            $media['url']               = $item->getUrl();
            $media['thumbnail']         = $item->getUrl('thumbnail');
            $media['preview_thumbnail'] = $item->getUrl('preview_thumbnail');

            return $media;
        });
    }

    public function getGameTypeLabelAttribute()
    {
        return collect(static::GAME_TYPE_RADIO)->firstWhere('value', $this->game_type)['label'] ?? '';
    }

    public function getGameLevelLabelAttribute()
    {
        return collect(static::GAME_LEVEL_RADIO)->firstWhere('value', $this->game_level)['label'] ?? '';
    }

    public function getPlayerTypeLabelAttribute()
    {
        return collect(static::PLAYER_TYPE_RADIO)->firstWhere('value', $this->player_type)['label'] ?? '';
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('project.datetime_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getFinishDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setFinishDateAttribute($value)
    {
        $this->attributes['finish_date'] = $value ? Carbon::createFromFormat(config('project.datetime_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}
