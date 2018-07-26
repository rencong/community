@extends('app')
@section('content')
    <div class="container">

        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img src="{{$discussion->user->avatar}}" class="media-object img-circle" alt="64x64"
                             style="width: 64px;height: 64px">
                    </a>

                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{$discussion->title}}
                        @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->id==$discussion->user_id)
                            <a class="btn btn-lg btn-primary pull-right"
                               href="{{route('discussion.edit',['id'=>$discussion->id])}}"
                               role="button">修改帖子</a>
                        @endif
                    </h4>
                    {{$discussion->user->name}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9" role="main">
                <div class="blog-post">
                    {{$discussion->body}}
                </div>
            </div>
        </div>
    </div>
@endsection