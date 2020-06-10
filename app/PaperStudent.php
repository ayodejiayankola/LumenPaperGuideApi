<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperStudent extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'paper_id',
        'status_id',
        'score',
    ];
}
