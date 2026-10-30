<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $primaryKey = 'dept_id';

    protected $fillable = ['dept_name', 'manager_id', 'location_id'];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'department_id', 'dept_id');
    }
}
