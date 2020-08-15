@extends('layouts/user/master')
@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Detail Pertanyaan Yang Dibuat</h3>
        <div class="right">
            <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
        </div>
    </div>
    <div class="panel-body">
        <h3>Pertanyaan</h3>
        <div class="jumbotron">
            <h3 class="display-4">{{ $pertanyaan->judul }}</h3>
            <p class="lead">{{ $pertanyaan->isi_pertanyaan }}</p>
            <p class="lead">
                @foreach($pertanyaan->tags as $tag)
                <a href="#" class="btn btn-info btn-xs">{{$tag->name}}</a>
                @endforeach
            </p>
            <hr class="my-4">
            <p>
                <form action="{{ route('forum.vote.pertanyaan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pertanyaan_id" value="{{ $pertanyaan->id }}">
                    <button type="submit" name="vote" value="upvote"><i class="lnr lnr lnr-thumbs-up mx-3"></i></button>
                    <span class="label label-success">{{ $vote->vote_up }}</span>
                    <button type="submit" name="vote" value="downvote"><i
                            class="lnr lnr lnr-thumbs-down mx-3"></i></button> <span
                        class="label label-danger">{{ $vote->vote_down }}</span>
                </form>
                <hr class="my-4">
                <form role="form" action="{{ route('komenper') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pertanyaan_id" value="{{ $pertanyaan->id }}">
                    <div class="input-group">
                        <input class="form-control" placeholder="Komentari Pertanyaan ini" name="isi_komentar"
                            type="text">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Gas!</button>
                        </span>
                    </div><br>
                </form>
                @forelse ($komenpe as $kp)
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <label>{{ $kp->user->name }}</label>
                    <i class="fa fa-check-circle"> {{ $kp->isi_komentar }}</i>
                </div>
                @empty
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <label></label>
                    <i class="fa fa-check-circle"> Belum Ada Komentar</i>
                </div>
                @endforelse
            </p>
        </div>
    </div>
    <div class="panel-footer">
        <h3>Jawaban</h3>
        <div class="jumbotron jumbotron-fluid">
            @forelse ($jawab as $j)
            <div class="container">
                <p class="lead">{{ $j->isi_jawaban }}</p>
            </div>
            @if ($votejaw == null)
            <form action="{{ route('forum.vote.jawaban') }}" method="POST">
                    @csrf
                    <input type="hidden" name="jawaban_id" value="{{ $j->id }}">
                    <button type="submit" name="vote" value="positif"><i class="lnr lnr lnr-thumbs-up mx-3"></i></button>
                    <span class="label label-success">0</span>
                    <button type="submit" name="vote" value="negatif"><i
                            class="lnr lnr lnr-thumbs-down mx-3"></i></button> <span
                        class="label label-danger">0</span>
                </form>
            @else
            <form action="{{ route('forum.vote.jawaban') }}" method="POST">
                    @csrf
                    <input type="hidden" name="jawaban_id" value="{{ $j->id }}">
                    <button type="submit" name="vote" value="positif"><i class="lnr lnr lnr-thumbs-up mx-3"></i></button>
                    <span class="label label-success">{{ $votejaw->vote_positif }}</span>
                    <button type="submit" name="vote" value="negatif"><i
                            class="lnr lnr lnr-thumbs-down mx-3"></i></button> <span
                        class="label label-danger">{{ $votejaw->vote_negatif }}</span>
                </form>
            @endif
            <br><br>
            <form action="{{ route('komenjaw') }}" method="POST">
                @csrf
                <input type="hidden" name="jawaban_id" value="{{ $j->id }}">
                <div class="input-group">
                <input class="form-control" placeholder="Komentari Jawaban ini" name="isi_komentar" type="text">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Gas!</button>
                </span>
            </div>
            </form>
            <br>
            @forelse ($komenja::orderby('id','desc')->where('jawaban_id',$j->id)->get() as $jawaban)
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <label>{{ $jawaban->user->name }}</label>
                <i class="fa fa-check-circle"> {{ $jawaban->isi_komentar }}</i>
            </div>
            @empty
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <label></label>
                <i class="fa fa-check-circle"> Tidak Ada Komentar</i>
            </div>
            @endforelse
            @empty
            <div class="container">
                <p class="lead">Belum Ada Jawaban</p>
            </div>
            @endforelse
            <form action="{{ route('forum.create.jawaban') }}" method="POST">
                @csrf
                <input type="hidden" name="pertanyaan_id" value="{{ $pertanyaan->id }}">
                <div class="form-group">
                    <label for="jawaban">Masukan Jawaban</label>
                    <textarea class="form-control" id="jawaban" rows="3" name="isi_jawaban"></textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Masukan</button>
            </form>
        </div>
        <div class="row">
            <div class="col-md-6"><span class="panel-note"></span></div>
            <div class="col-md-6 text-right"><a href="{{ route('ownquestion.index') }}"
                    class="btn btn-sm btn-primary">Back</a></div>
        </div>
    </div>
</div>
@endsection
