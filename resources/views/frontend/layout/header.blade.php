<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trang thi trực tuyến</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="/common/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="/common/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="/frontend/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <!-- JQUERY SCRIPTS -->
    <script src="/common/js/jquery-2.2.3.min.js"></script>

    <script src="/common/js/bootstrap.js"></script>

    <script src="/common/js/jquery.countdown.min.js"></script>

    <script src="/frontend/js/script.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">Thi Online</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Trang chủ</a></li>
                <li><a href="/quiz/subjects">Làm bài thi</a></li>
            </ul>
            <ul class="nav navbar-nav pull-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Đăng nhập</a></li>
                    <li><a href="{{ url('/register') }}">Đăng xuất</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
	                                                 document.getElementById('logout-form').submit();">
                                    Đăng xuất
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
</body>
</html>