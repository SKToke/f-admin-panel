<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public const ANNOUNCEMENT_TYPE_SELECT = [
        'announcement' => 'Announcement',
        'news' => 'News',
    ];

    public const STATUS_SELECT = [
        'publish' => 'Publish',
        'unpublish' => 'Unpublish',
    ];

    public $table = 'announcements';

    public $orderable = [
        'id',
        'type',
        'sport.name',
        'title',
        'about',
        'start_date',
        'end_date',
        'status',
        'is_set_role',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $filterable = [
        'id',
        'type',
        'sport.name',
        'title',
        'about',
        'start_date',
        'end_date',
        'status',
        'is_set_role',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'type',
        'sport.name',
        'title',
        'about',
        'start_date',
        'end_date',
        'status',
        'is_set_role',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // protected $casts = [
    //   'status' => StatusEnum::class . ':nullable'
    // ];

    public function getEventTypeLabelAttribute($value)
    {
        return static::STATUS_SELECT[$this->status] ?? null;
    }

    //public function sport()
   // {
   //     return $this->belongsTo(Sport::class);
   // }

    public function getApplicationTypeLabelAttribute($value)
    {
        return static::ANNOUNCEMENT_TYPE_SELECT[$this->type] ?? null;
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
        $this->attributes['start_date'] = $value
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
        $this->attributes['end_date'] = $value
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

//      public function countEventByStatus($status): mixed
//    {
//         return $this->where('status', $status)->count();
//     }


}
