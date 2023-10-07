<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'course_id',
        'employee_id',
        'student_id'
    ];

    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }

    public function student_class()
    {
        return $this->belongsTo(Student_Class::class);
    }
}
