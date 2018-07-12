@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">My selection of videos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($myvideo as $video)
                        <div>
                            <h3>{{$video['caption']}}</h3>

                            <iframe src="{{$video['iframe_video']}}" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            <p>{{$video['description']}}</p>
                            <hr>
                        </div>



                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
