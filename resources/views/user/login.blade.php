@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" role="main">
                <form method="post" action="{{route('user.login.post')}}" accept-charset="UTF-8">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label>邮件：</label>
                        <input class="form-control" type="email" name="email">
                    </div>

                    <div class="form-group">
                        <label>密码：</label>
                        <input class="form-control" type="password" name="password">
                    </div>

                    <button type="submit" class="btn btn-primary form-control">登录</button>
                </form>
            </div>
        </div>
    </div>
@endsection