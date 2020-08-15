<?php

namespace App\Http\Controllers;

use App\Model\Vote_Jawaban;
use App\Model\Vote_Pertanyaan;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function votePertanyaan(Request $request)
    {
        $pertanyaan = Vote_Pertanyaan::where('pertanyaan_id', $request->pertanyaan_id)->first();
        if ($pertanyaan == null) {
            if ($request->vote == 'upvote') {
                Vote_Pertanyaan::create([
                    'pertanyaan_id' => $request->pertanyaan_id,
                    'vote_up' => 1,
                    'vote_down' => 0,
                    'user_id' => Auth()->User()->id,
                ]);
            } elseif ($request->vote == 'downvote') {
                Vote_Pertanyaan::create([
                    'pertanyaan_id' => $request->pertanyaan_id,
                    'vote_up' => 1,
                    'vote_down' => 1,
                    'user_id' => Auth()->User()->id,
                ]);
            }
        } else {
            $hvote = Vote_Pertanyaan::where('pertanyaan_id', $request->pertanyaan_id);
            if ($request->vote == 'upvote') {
                $hvote->update([
                    'vote_up' => $pertanyaan->vote_up + 1,
                    'vote_down' => $pertanyaan->vote_down + 0,
                ]);
            } elseif ($request->vote == 'downvote') {
                $hvote->update([
                    'vote_up' => $pertanyaan->vote_up + 0,
                    'vote_down' => $pertanyaan->vote_down + 1,
                ]);
            }
        }
        return redirect()->back()->with('status', 'Terima Kasih Atas Vote Anda');
    }

    public function voteJawaban(Request $request)
    {
        $jawaban = Vote_Jawaban::where('jawaban_id', $request->jawaban_id)->first();
        if($jawaban == null){
            if ($request->vote == 'positif') {
                Vote_Jawaban::create([
                    'jawaban_id' => $request->jawaban_id,
                    'vote_positif' => 1,
                    'vote_negatif' => 0,
                    'user_id' => Auth()->User()->id,
                ]);
            } elseif ($request->vote == 'negatif') {
                Vote_Jawaban::create([
                    'jawaban_id' => $request->jawaban_id,
                    'vote_positif' => 1,
                    'vote_negatif' => 1,
                    'user_id' => Auth()->User()->id,
                ]);
            }
        }else{
            $hvote = Vote_Jawaban::where('jawaban_id', $request->jawaban_id);
            if ($request->vote == 'positif') {
                $hvote->update([
                    'vote_positif' => $jawaban->vote_positif + 1,
                    'vote_negatif' => $jawaban->vote_negatif + 0,
                ]);
            } elseif ($request->vote == 'negatif') {
                $hvote->update([
                    'vote_positif' => $jawaban->vote_positif + 0,
                    'vote_negatif' => $jawaban->vote_negatif + 1,
                ]);
            }
        }
        return redirect()->back()->with('status', 'Terima Kasih Atas Vote Anda');
    }
}
