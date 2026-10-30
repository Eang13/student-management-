<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'student_name', 'email', 'gender',
        'enrollment_date', 'description', 'department_id',
    ];

    protected $casts = ['enrollment_date' => 'date'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'dept_id');
    }

    /** Years enrolled, calculated from enrollment_date. */
    public function getYearsEnrolledAttribute(): float
    {
        return round(abs($this->enrollment_date->diffInYears(now())), 1);
    }
}
