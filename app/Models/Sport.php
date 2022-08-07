<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sport extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public const IS_REQUIRE_CHOOSE_ROLE_RADIO = [
        '0' => 'No',
        '1' => 'Yes',
    ];

    public $table = 'sports';

    public $orderable = [
        'id',
        'name',
        'description',
        'creator.name',
        'max_player_per_team',
        'min_player_per_team',
        'is_require_choose_role',
        'updated_at',
    ];

    public $filterable = [
        'id',
        'name',
        'description',
        'creator.name',
        'max_player_per_team',
        'min_player_per_team',
        'is_require_choose_role',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'creator_id',
        'max_player_per_team',
        'min_player_per_team',
        'is_require_choose_role',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function getIsRequireChooseRoleLabelAttribute($value)
    {
        return static::IS_REQUIRE_CHOOSE_ROLE_RADIO[$this->is_require_choose_role] ?? null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
