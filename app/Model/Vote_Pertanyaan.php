<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vote_Pertanyaan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vote_pertanyaan';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
}
