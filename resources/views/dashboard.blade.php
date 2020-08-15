@extends('layouts/user/master')
@section('content')
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">Gambaran</h3>
        <p class="panel-subtitle"></p>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="lnr lnr-list"></i></span>
                    <p>
                        <span class="number">{{ $pertanyaan::where('user_id',Auth()->User()->id)->count() }}</span>
                        <span class="title">Pertanyaan</span>
                        <!-- <span class="title">Pertanyaan</span> -->
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="lnr lnr-book"></i></span>
                    <p>
                        <span class="number">{{ $jawaban::where('user_id',Auth()->User()->id)->count() }}</span>
                        <span class="title">Jawab</span>
                    </p>
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="lnr lnr-dice"></i></span>
                    <p>
                        <span class="number">#</span>
                        <span class="title">Point</span>
                    </p>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection
