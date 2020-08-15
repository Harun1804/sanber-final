<?php

namespace App\Http\Controllers;

use App\Model\Jawaban;
use App\Model\KomentarJawaban;
use App\Model\KomentarPertanyaan;
use App\Model\Pertanyaan;
use Illuminate\Http\Request;
use App\Model\Tag;
use App\Model\Vote_Jawaban;
use App\Model\Vote_Pertanyaan;
use Illuminate\Support\Facades\Auth;

class PertanyaanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pertanyaan = $user->forum;
        // $pertanyaan = Pertanyaan::orderBy('id', 'desc')->paginate(10);
        return view('pertanyaan.index', compact('pertanyaan'));
    }

    public function create()
    {
        return view('pertanyaan.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'isi_pertanyaan' => 'required'
        ]);

        $tags_arr = explode(",", $request["tags"]);
        $tag_ids = [];
        foreach ($tags_arr as $tag_name) {
            $tag = Tag::where("name", $tag_name)->first();
            if ($tag) {
                $tag_ids[] = $tag->id;
            } else {
                $new_tag = Tag::create(["name" => $tag_name]);
                $tag_ids[] = $new_tag->id;
            }
        }

        $post = Pertanyaan::create([
            'judul' => $request->judul,
            'isi_pertanyaan' => $request->isi_pertanyaan,
            'user_id' => Auth()->User()->id
        ]);
        $post->tags()->sync($tag_ids);
        return redirect(route('ownquestion.index'))->with('status', 'Pertanyaan Berhasil Dibuat');
    }

    public function show($id)
    {
        $pertanyaan = Pertanyaan::find($id);
        $vote = Vote_Pertanyaan::where('pertanyaan_id', $id)->first();
        $votejaw = new Vote_Jawaban;
        $komenpe = KomentarPertanyaan::orderby('id', 'desc')->where('pertanyaan_id', $id)->get();
        $komenja = new KomentarJawaban;
        $jawab = Jawaban::orderby('id', 'desc')->where('pertanyaan_id', $id)->get();
        return view('pertanyaan.show', compact(['pertanyaan', 'vote', 'komenpe', 'jawab', 'votejaw', 'komenja']));
    }

    public function edit($id)
    {
        $pertanyaan = Pertanyaan::find($id);
        return view('pertanyaan.edit', compact('pertanyaan'));
    }

    public function update(Request $request, $id)
    {

        Pertanyaan::where('id', $id)->update([
            'judul' => $request->judul,
            'isi_pertanyaan' => $request->isi_pertanyaan
        ]);

        return redirect(route('ownquestion.index'))->with('status', 'Pertanyaan Berhasil Diperbaharui');
    }

    public function destroy($id)
    {
        Pertanyaan::destroy($id);
        return redirect(route('ownquestion.index'))->with('status', 'Pertanyaan Berhasil Dihapus');
    }

    public function forum()
    {
        $forum = Pertanyaan::all();

        return view('pertanyaan.forum', compact('forum'));
    }
}
