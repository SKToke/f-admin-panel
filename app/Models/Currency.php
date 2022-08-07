<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
//    use SoftDeletes;

    public $table = 'currencies';

    protected $fillable = [
        'code',
        'name',
        'symbol',
    ];

    public $orderable = [
        'id',
        'code',
        'name',
        'symbol',
    ];

    public $filterable = [
        'id',
        'name',
        'code',
        'symbol',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

}
