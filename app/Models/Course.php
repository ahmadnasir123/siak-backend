<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'kelas_id'
    ];

    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }
}
