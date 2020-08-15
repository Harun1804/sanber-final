<?php

namespace App\Http\Controllers;

use App\Model\KomentarJawaban;
use Illuminate\Http\Request;
use App\Model\KomentarPertanyaan;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function store(Request $request)
    {
        KomentarPertanyaan::create([
            'isi_komentar' => $request->isi_komentar,
            'pertanyaan_id' => $request->pertanyaan_id,
            'user_id' => Auth()->User()->id
        ]);
        return redirect()->back()->with('status', 'Komentar Pertanyaan Berhasil Dibuat');
    }

    public function koJaw(Request $request)
    {
        KomentarJawaban::create([
            'isi_komentar' => $request->isi_komentar,
            'jawaban_id' => $request->jawaban_id,
            'user_id' => Auth()->User()->id
        ]);
        return redirect()->back()->with('status', 'Komentar Jawaban Berhasil Dibuat');
    }
}
