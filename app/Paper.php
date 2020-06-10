<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_id',
        'paper_type_id',
    ];

    public function paperType() {
        return $this->belongsTo(PaperType::class);
    }

  public function subject(){
        return $this->belongsTo(Subject::class);
  }
}
