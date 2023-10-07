<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nis',
        'nisn',
        'name',
        'gender',
        'age',
        'jurusan',
        'name_ortu',
        'phone_ortu',
        'tahun_masuk',
        'tahun_lulus',
        'is_verified',
        'verified_at'
    ];

    public function student_class()
    {
        return $this->hasMany(Student_Class::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }
}
