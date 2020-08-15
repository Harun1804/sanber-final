<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';
    protected $fillable = ['isi_jawaban', 'pertanyaan_id', 'user_id'];
}
