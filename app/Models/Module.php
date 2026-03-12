<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Module extends BaseModel
{
    use HasUuids;

    protected $fillable = [
        'project_id',
        'name',
        'description',
        'result',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
