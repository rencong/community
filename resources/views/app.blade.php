<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}
    {{--<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">--}}
    {{--<script src="/libs/js/jquery-3.2.1.min.js"></script>--}}
    {{--<script src="/libs/js/icheck.min.js"></script>--}}
    {{--<script src="/libs/js/moment-with-locales.min.js"></script>--}}
    {{--<script src="/libs/js/anchor-ui.min.js"></script>--}}
    {{--<script src="/libs/js/notify.min.js"></script>--}}
    {{--<script src="/libs/js/jquery.cookie.min.js"></script>--}}
    {{--<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>--}}
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
{{--<div class="container">--}}
    @if (isset($errors) && $errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
    @endif
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
                    <li><a href="../navbar/">登录</a></li>
                    <li><a href="../navbar-fixed-top/">注册</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    @yield('content')
{{--</div>--}}
@yield('footer')
</body>
</html>
