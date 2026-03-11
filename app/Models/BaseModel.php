<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::instance($date)
            ->setTimezone(config('app.timezone'))
            ->format('Y-m-d H:i:s');
    }
}
