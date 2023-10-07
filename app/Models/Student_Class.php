<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_Class extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'student_id',
       'kelas_id'
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
