<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'coach_id',
        'title',
        'description',
        'duration',
        'picture',
    ];

    // Relations
    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

}
