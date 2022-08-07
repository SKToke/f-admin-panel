<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public const LEVEL_SELECT = [
        'newbie' => 'newbie',
    ];

    public const GENDER_RADIO = [
        'male'   => 'Male',
        'female' => 'Female',
    ];

    public $table = 'teams';

    public $orderable = [
        'id',
        'name',
        'sport.name',
        'creator.name',
        'coach.name',
        'gender',
        'level',
        'oganization_name',
        'oganization_url',
        'division',
        'season',
    ];

    public $filterable = [
        'id',
        'name',
        'sport.name',
        'creator.name',
        'coach.name',
        'gender',
        'level',
        'oganization_name',
        'oganization_url',
        'division',
        'season',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'sport_id',
        'creator_id',
        'coach_id',
        'gender',
        'level',
        'oganization_name',
        'oganization_url',
        'division',
        'season',
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function coach()
    {
        return $this->belongsTo(User::class);
    }

    public function getGenderLabelAttribute($value)
    {
        return static::GENDER_RADIO[$this->gender] ?? null;
    }

    public function getLevelLabelAttribute($value)
    {
        return static::LEVEL_SELECT[$this->level] ?? null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
