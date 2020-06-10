<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperType extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
