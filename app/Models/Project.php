<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends BaseModel
{
    use HasUuids;

    protected $fillable = [
        'name',
        'description',
    ];

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }
}
