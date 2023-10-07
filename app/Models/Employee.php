<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nip',
        'name',
        'email',
        'gender',
        'age',
        'photo',
        'phone',
        'user_id',
        'position_id',
        'course_id',
        'kelas_id',
        'is_verified',
        'verified_at'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function students()
    {
        return $this->belongsTo(Student::class);
    }
}
