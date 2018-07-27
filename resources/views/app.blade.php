<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/libs/js/jquery-3.2.1.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="/libs/js/jquery.form.js"></script>

</head>
<body>
{{--<div class="container">--}}

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Ren Cong</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{route('discussion.index')}}">首页</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(\Illuminate\Support\Facades\Auth::check())
                    <li>
                        <a id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                           class="dropdown-toggle">
                            {{\Illuminate\Support\Facades\Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="#"><i class="fa fa-cog"></i> 更换密码</a></li>
                            <li><a href="{{route('user.avatar')}}"><i class="fa fa-user"></i> 更换头像</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('user.logout') }}"><i class="fa fa-sign-out"></i> 退出</a></li>
                        </ul>
                    </li>
                    <li><img src="{{\Illuminate\Support\Facades\Auth::user()->avatar}}" class="img-circle" width="50">
                    </li>
                @else
                    <li><a href="{{ route('login') }}">登录</a></li>
                    <li><a href="{{route('user.register')}}">注册</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

@if (isset($errors) && $errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach
@endif
@if(\Illuminate\Support\Facades\Session::has('login_error'))
    <div class="alert alert-danger">
        {{ \Illuminate\Support\Facades\Session::get('login_error') }}
    </div>
@endif
@yield('content')
{{--</div>--}}
@yield('footer')
{{--<script src="//cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>--}}
{{--<script src="//cdn.bootcss.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>--}}
</body>
</html>
