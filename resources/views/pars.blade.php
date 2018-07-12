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

                        {{--@if()--}}
                        <div>
                            <h3>{{$video['caption']}}</h3>

                            <iframe src="{{$video['iframe_video']}}" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

                            <p id="desc">{{$video['description']}}</p>
                            <button onclick="showForm()" id="edit" type="submit" class="btn btn-primary">
                                edit description
                            </button>


                            <form hidden id="edit_desc" class="form-horizontal" role="form" method="post" action="{{url('/pars',$video->id)}}" type="hidden">
                                {{method_field('PUT')}}
                                {{csrf_field()}}
                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description" class="col-md-4 control-label"></label>

                                    <div class="col-md-10">
                                        <input  id="description" type="textarea" class="form-control" name="description" value="{{ old('description',$video->description) }}" required autofocus>


                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=" col-md-8 col-md-offset-8">
                                        <input onclick="showDesc()" id="save" type="submit" class="btn btn-primary" value="save">

                                    </div>
                                </div>
                            </form>
                            <form class="form-delete" method="post" action="{{ url('/pars/'.$video->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="submit" value="delete">
                            </form>
                            <hr>
                        </div>

                            {{--@endif--}}

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
