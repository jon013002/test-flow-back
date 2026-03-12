<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Project extends BaseModel
{
    use HasUuids;
    
    protected $fillable = [
        'name',
        'description',
    ];
}
