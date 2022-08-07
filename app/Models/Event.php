<?php

namespace App\Models;

use App\Enums\EventStatusEnum;
use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public const APPLICATION_TYPE_SELECT = [
        'inndividual' => 'Individual Application',
        'team' => 'Team Application',
    ];

    public const EVENT_TYPE_SELECT = [
        'pick-up' => 'Pick-up Game',
        'league-game' => 'League Game',
        'sport-event' => 'Sports Event',
        'session' => 'Session',
    ];

    public $table = 'events';

    public $orderable = [
        'id',
        'event_type',
        'sport.name',
        'number_of_team',
        'player_per_team',
        'application_type',
        'description',
        'start_date_time',
        'end_date_time',
        'lat',
        'long',
        'max_team',
        'is_paid',
        'max_player_per_team',
        'gender',
        'location',
        'title',
        'caption',
        'start_age',
        'end_age',
        'fee',
        'is_public',
        'status',
        'is_set_role',
        'event_type',
        'number_of_team',
        'description',
        'player_per_team',
        'is_unlimit_max',
        'about',
        'mechanics',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $filterable = [
        'id',
        'event_type',
        'sport.name',
        'number_of_team',
        'player_per_team',
        'application_type',
        'description',
        'start_date_time',
        'end_date_time',
        'lat',
        'long',
        'max_team',
        'is_paid',
        'max_player_per_team',
        'gender',
        'location',
        'title',
        'caption',
        'start_age',
        'end_age',
        'fee',
        'is_public',
        'status',
        'is_set_role',
        'event_type',
        'number_of_team',
        'description',
        'player_per_team',
        'is_unlimit_max',
        'about',
        'mechanics',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'start_date_time',
        'end_date_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'event_type',
        'sport_id',
        'number_of_team',
        'player_per_team',
        'application_type',
        'description',
        'start_date_time',
        'end_date_time',
        'lat',
        'long',
        'max_team',
        'is_paid',
        'max_player_per_team',
        'gender',
        'location',
        'title',
        'caption',
        'start_age',
        'end_age',
        'fee',
        'is_public',
        'status',
        'is_set_role',
        'event_type',
        'number_of_team',
        'description',
        'player_per_team',
        'is_unlimit_max',
        'about',
        'mechanics',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
      'status' => EventStatusEnum::class . ':nullable'
    ];

    public function getEventTypeLabelAttribute($value)
    {
        return static::EVENT_TYPE_SELECT[$this->event_type] ?? null;
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function getApplicationTypeLabelAttribute($value)
    {
        return static::APPLICATION_TYPE_SELECT[$this->application_type] ?? null;
    }

    public function getStartDateTimeAttribute($value)
    {
        return $value
            ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(
                config('project.datetime_format')
            )
            : null;
    }

    public function setStartDateTimeAttribute($value)
    {
        $this->attributes['start_date_time'] = $value
            ? Carbon::createFromFormat(
                config('project.datetime_format'),
                $value
            )->format('Y-m-d H:i:s')
            : null;
    }

    public function getEndDateTimeAttribute($value)
    {
        return $value
            ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(
                config('project.datetime_format')
            )
            : null;
    }

    public function setEndDateTimeAttribute($value)
    {
        $this->attributes['end_date_time'] = $value
            ? Carbon::createFromFormat(
                config('project.datetime_format'),
                $value
            )->format('Y-m-d H:i:s')
            : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * @param $status
     * @return mixed
     */
    public function countEventByStatus($status): mixed
    {
        return $this->where('status', $status)->count();
    }
}
