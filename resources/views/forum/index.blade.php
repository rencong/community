@extends('app')
@section('content')
    <div class="container">

        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron">
            <h2>欢迎来到小聪社区
                <a class="btn btn-lg btn-primary pull-right" href="{{route('discussion.create')}}"
                   role="button">发布新的帖子</a>
            </h2>

        </div>

        <div class="row">
            <div class="col-md-9" role="main">
                @foreach($discussions as $discussion)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img src="{{$discussion->user->avatar}}" class="media-object img-circle" alt="64x64"
                                     style="width: 64px;height: 64px">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{{route('discussion.show',['id'=>$discussion->id])}}">{{$discussion->title}}</a>
                                <div class="media-conversation-meta">
                                <span class="media-conversation-replies">
                                    <a href="#">{{count($discussion->comments)}}</a>回复
                                </span>
                                </div>
                            </h4>

                            {{$discussion->user->name}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection