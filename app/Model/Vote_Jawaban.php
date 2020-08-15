<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vote_Jawaban extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vote_jawaban';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
