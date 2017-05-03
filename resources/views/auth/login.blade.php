<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Đăng nhập hệ thống quản trị</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="/common/css/bootstrap.css" rel="stylesheet"/>
    <!-- FONTAWESOME STYLES-->
    <link href="/common/css/font-awesome.css" rel="stylesheet"/>
    <!-- CUSTOM STYLES-->
    <link href="/auth/login.css" rel="stylesheet"/>

    <!-- JQUERY SCRIPTS -->
    <script src="/common/js/jquery-2.2.3.min.js"></script>

    <script src="/common/js/bootstrap.js"></script>

    <script src="/common/js/jquery.countdown.min.js"></script>
</head>
<body>
<div class="container">
    <h2 class="text-center" style="color: white">Đăng nhập hệ thống</h2>
    <div class="card card-container">
        <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png"/>
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <span id="reauth-email" class="reauth-email"></span>
            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address"
                   value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="help-block">
                   <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <div id="remember" class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
        </form><!-- /form -->
        <a href="#" class="forgot-password">
            Forgot the password?
        </a>
    </div><!-- /card-container -->
</div><!-- /container -->
</body>