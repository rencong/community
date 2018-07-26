@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" role="main">
                <form method="post" action="{{route('user.register.post')}}" accept-charset="UTF-8">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>姓名：</label>
                        <input class="form-control" type="text" name="name">
                    </div>

                    <div class="form-group">
                        <label>邮件：</label>
                        <input class="form-control" type="email" name="email">
                    </div>

                    <div class="form-group">
                        <label>密码：</label>
                        <input class="form-control" type="password" name="password">
                    </div>

                    <div class="form-group">
                        <label>确认密码：</label>
                        <input class="form-control" type="password" name="password_confirmation">
                    </div>

                    <button type="submit" class="btn btn-primary form-control">马上注册</button>
                </form>
            </div>
        </div>
    </div>
@endsection