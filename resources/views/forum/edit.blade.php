@extends('app')
@section('content')
    @include('editor::head')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" role="main">
                <form method="post" action="{{route('discussion.update',['id'=>$discussion->id])}}"
                      accept-charset="UTF-8">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label>标题：</label>
                        <input class="form-control" type="text" name="title" value="{{$discussion->title}}">
                    </div>

                    <div class="form-group editor">
                        <label>正文：</label>
                        <textarea class="form-control" name="body" id="myEditor">{!! $discussion->body !!}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary form-control pull-right">提交</button>
                </form>
            </div>
        </div>
    </div>
@endsection