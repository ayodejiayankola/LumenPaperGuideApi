<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Question extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_no',
        'answers',
        'subject_id',
    ];

    public function subject() {
        return $this->belongsTo(Subject::class);
    }
}
