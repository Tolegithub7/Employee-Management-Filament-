<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Employee;

class Department extends Model
{
    protected $fillable = [
        'name', ' team_id'
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
