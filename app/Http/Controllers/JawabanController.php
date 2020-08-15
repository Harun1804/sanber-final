<?php

namespace App\Http\Controllers;

use App\Model\Jawaban;
use Illuminate\Http\Request;
use App\Model\Pertanyaan;

class JawabanController extends Controller
{
    public function index()
    {
        $jawaban = Jawaban::orderBy('id', 'desc')->paginate(10);
        return view('jawaban.index', compact('jawaban'));
    }

    public function store(Request $request)
    {
        Jawaban::create([
            'isi_jawaban' => $request->isi_jawaban,
            'pertanyaan_id' => $request->pertanyaan_id,
            'user_id' => Auth()->User()->id,
        ]);

        return redirect()->back()->with('success', 'Jawaban telah tersimpan');
    }
}
