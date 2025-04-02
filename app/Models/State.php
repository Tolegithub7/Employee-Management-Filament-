<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Country;
use App\Models\Employee;

class State extends Model
{
    protected $fillable = ['name', 'country_id'];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
