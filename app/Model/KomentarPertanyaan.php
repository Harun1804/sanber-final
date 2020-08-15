<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KomentarPertanyaan extends Model
{
    protected $table = 'komentar_pertanyaan';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function pertanyaan()
    {
        return $this->belongsTo('App\Model\Pertanyaan', 'pertanyaan_id');
    }
}
