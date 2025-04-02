<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\State;
use App\Models\Employee;

class City extends Model
{
    protected $fillable = ['name', 'state_id'];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
    public function employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
