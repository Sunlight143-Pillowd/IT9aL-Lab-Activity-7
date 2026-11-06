<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Psy\Readline\Hoa\FileLinkRead;

class Student extends Model
{
    protected $table = 'student';
    protected $fillable = [
        'student_number',
        'name',
        'course',
        'age',
        'email',
    ];
}
