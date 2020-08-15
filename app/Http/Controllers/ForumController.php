<?php

namespace App\Http\Controllers;

use App\Model\Jawaban;
use App\Model\KomentarJawaban;
use App\Model\KomentarPertanyaan;
use App\Model\Pertanyaan;
use App\Model\Vote_Jawaban;
use App\Model\Vote_Pertanyaan;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function detail($id)
    {
        $pertanyaan = Pertanyaan::find($id);
        $vote = Vote_Pertanyaan::where('pertanyaan_id', $id)->first();
        $cari_jawab = Jawaban::where('pertanyaan_id', $id)->first();
        $votejaw = Vote_Jawaban::where('jawaban_id', $cari_jawab->id)->first();
        $komenpe = KomentarPertanyaan::orderby('id', 'desc')->where('pertanyaan_id', $id)->get();
        $komenja = new KomentarJawaban;
        $jawab = Jawaban::orderby('id', 'desc')->where('pertanyaan_id', $id)->get();
        return view('pertanyaan.detail_forum', compact(['pertanyaan', 'vote', 'komenpe', 'jawab', 'votejaw', 'komenja']));
    }
}
