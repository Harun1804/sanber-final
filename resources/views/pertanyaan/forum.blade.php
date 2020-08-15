@extends('layouts/user/master')
@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Pertanyaan</h3>
        <div class="right">
            <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
            <a href="{{ route('ownquestion.create') }}" class="btn-toggle-minified"><i
                    class="lnr lnr-plus-circle"></i></a>
        </div>
    </div>
    <div class="panel-body no-padding">
        <table class="table table-striped">

            <tbody>

                <div class="row">
                    @foreach($forum as $data)
                    <div class="col-md-4">

                        <!-- PANEL WITH FOOTER -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="title">{{$data->author->name }}</h3>
                                <span class="date">{{$data->created_at}}</span>
                            </div>
                            <div class="panel-body">
                                <h3>{{$data->judul}}</h3>
                                <p>{{$data->isi_pertanyaan}}</p>
                                <p class="lead">
                                    @forelse($data->tags as $tag) <!-- tags berasal dari model -->
                                    <a href="#" class="btn btn-warning btn-xs">{{$tag->name}}</a>
                                    @empty
                                    <button class="btn btn-warning btn-xs">Pertanyaan Ini Tidak Memiliki Tag</button>
                                    @endforelse
                                </p>
                            </div>

                            <div class="panel-footer">
                                <a href="{{ url('/forum/'.$data->id.'/detail') }}" class="btn btn-sm btn-info">Show</a>
                            </div>
                        </div>
                        <!-- END PANEL WITH FOOTER -->

                    </div>
                    @endforeach
                </div>

            </tbody>
        </table>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-6"><span class="panel-note"></span></div>
            <div class="col-md-6 text-right"></div>
        </div>
    </div>
</div>
@endsection
