@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="text-center">
                <img src="{{\Illuminate\Support\Facades\Auth::user()->avatar}}" width="120" class="img-circle"
                alt="">
                <form method="post" action="{{route('user.change.avatar')}}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <input type="file" name="avatar">


                <button type="submit" class="btn btn-primary form-control">上传头像</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>

    </script>
@endsection