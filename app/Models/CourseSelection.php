<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSelection extends Model
{
    use HasFactory;

    public function college()
{
    return $this->belongsTo(College::class);
}

public function batch()
{
    return $this->belongsTo(Batch::class);
}

public function department()
{
    return $this->belongsTo(Department::class);
}

public function section()
{
    return $this->belongsTo(Section::class);
}
public function course()
{
    return $this->belongsTo(Course::class);
}

    protected $fillable = [
        'college_id',
        'batch_id',
        'department_id',
        'section_id',
        'course_id',
    ];
}
