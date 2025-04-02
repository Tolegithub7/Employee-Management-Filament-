<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\State;
use App\Models\Employee;

class Country extends Model
{
    protected $fillable = ['name', 'code', 'phonecode'];
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
    public function employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
