<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class HiEventInfo extends Model
{
    use HasAdvancedFilter, SoftDeletes;

    public $table = 'hi_event_infos';

    protected $orderable = [
        'id',
        'event.name',
    ];

    protected $filterable = [
        'id',
        'event.name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'event_id',
        'overview',
        'rules',
        'price',
        'location',
        'contact',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function event()
    {
        return $this->belongsTo(HiEvent::class);
    }
}
