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
            <div>
                <h3 class="title">{{$pertanyaan->author->name }}</h3>
                <span class="date">{{$pertanyaan->created_at}}</span>
            </div>
            <h3 class="display-5">{{ $pertanyaan->judul }}</h3>
            <p class="lead">{{ $pertanyaan->isi_pertanyaan }}</p>
            <p class="lead">
                @foreach($pertanyaan->tags as $tag)
                <a href="#" class="btn btn-info btn-xs">{{$tag->name}}</a>
                @endforeach
            </p>
            <p>
                <i class="lnr lnr lnr-thumbs-up mx-3"><span class="label label-success"> {{ $vote->vote_up }}</span></i>
                <i class="lnr lnr lnr-thumbs-down mx-3"><span class="label label-danger">
                        {{ $vote->vote_down }}</span></i>
            </p>
            <hr class="my-4">
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
            <i class="lnr lnr lnr-thumbs-up mx-3"><span class="label label-success">0</span></i>
            <i class="lnr lnr lnr-thumbs-down mx-3"><span class="label label-danger">0</span></i>
            @else
            <i class="lnr lnr lnr-thumbs-up mx-3"><span class="label label-success"> {{ $votejaw->vote_positif }}</span></i>
            <i class="lnr lnr lnr-thumbs-down mx-3"><span class="label label-danger">{{ $votejaw->vote_negatif }}</span></i>
            @endif
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
        </div>
        <div class="row">
            <div class="col-md-6"><span class="panel-note"></span></div>
            <div class="col-md-6 text-right"><a href="{{ route('ownquestion.index') }}"
                    class="btn btn-sm btn-primary">Back</a></div>
        </div>
    </div>
</div>
@endsection
