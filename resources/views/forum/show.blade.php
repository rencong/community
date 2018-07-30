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
            <div class="col-md-9" role="main" id="post">
                <div class="blog-post">
                    {!!$discussion->body!!}
                    {{--                    {{$discussion->body}}--}}
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
                <div class="media" v-for="comment in comments">
                    <div class="media-left">
                        <a href="#">
                            <img v-bind:src="comment.avatar" class="media-object img-circle" alt="64x64"
                                 style="width: 32px;height: 32px">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">@{{comment.name}}</h4>
                        @{{comment.body}}
                    </div>
                </div>
                <hr>
                @if(\Illuminate\Support\Facades\Auth::check())
                    <form method="post" action="{{route('comment.store',['discussion_id'=>$discussion->id])}}"
                          accept-charset="UTF-8" @submit="onSubmitForm">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <textarea class="form-control" name="body" v-model="newComment.body"></textarea>
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

@section('footer')
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');
        new Vue({
            el: '#post',
            data: {
                comments: [],
                newComment: {
                    name: '{{\Illuminate\Support\Facades\Auth::user()->name}}',
                    avatar: '{{\Illuminate\Support\Facades\Auth::user()->avatar}}',
                    body: ''
                },
                newPost: {
                    discussion_id: '{{$discussion->id}}',
                    user_id: '{{\Illuminate\Support\Facades\Auth::user()->id}}',
                    body: ''
                }
            },
            methods: {
                onSubmitForm: function (e) {
                    e.preventDefault();
                    var that = this;
                    var comment = this.newComment;
                    var post = this.newPost;
                    post.body = comment.body;
                    this.$http.post('/comment/create', post).then(response => {
                        that.comments.push(comment);
                    });
                    this.newComment = {
                        name: '{{\Illuminate\Support\Facades\Auth::user()->name}}',
                        avatar: '{{\Illuminate\Support\Facades\Auth::user()->avatar}}',
                        body: ''
                    };

                }
            }
        })
    </script>

@endsection