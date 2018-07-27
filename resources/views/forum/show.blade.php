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
                               href="{{route('di scussion.edit',['id'=>$discussion->id])}}"
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
                <hr>
                @foreach($discussion->comments as $comment)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img src="{{$comment->user->avatar}}" class="media-object img-circle" alt="64x64"
                                     style="width: 32px;height: 32px">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{$comment->user->name}}
                            </h4>
                            {{$comment->body}}
                        </div>
                    </div>
                @endforeach
                <hr>
                @if(\Illuminate\Support\Facades\Auth::check())
                    <form method="post" action="{{route('comment.store',['discussion_id'=>$discussion->id])}}"
                          accept-charset="UTF-8">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <textarea class="form-control" name="body"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success form-control pull-right">发表评论</button>
                    </form>
                    @else
                    <a href="{{route('login')}}" class="btn btn-block btn-success">登录参与评论</a>
                @endif
            </div>
        </div>
    </div>
@endsection