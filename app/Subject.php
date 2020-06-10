<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Subject extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function question(){
        return $this->hasMany(Question::class);
    }
    public function paper(){
        return $this->hasMany(Paper::class);
    }
}
