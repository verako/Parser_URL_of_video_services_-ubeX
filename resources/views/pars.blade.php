@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <p>{{$text}}</p>
                        <iframe src="https://www.youtube.com/embed/tgbNymZ7vqY" width="420" height="345"></iframe>
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
