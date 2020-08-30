
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود</title>
    <link rel="stylesheet" type="text/css" href="loginResources/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="loginResources/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="loginResources/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="loginResources/css/iofrm-theme3.css">
    <link rel="stylesheet" type="text/css" href="loginResources/css/farsi_fonts.css">
    {{--<link rel="icon" href="/loginResources/images/logo3.png"/>--}}
    <link rel="icon" href="/dashbord/dist/img/mylogo.png"/>
</head>
<body>
<div class="form-body" class="container-fluid">
    <div class="website-logo">
        {{--<a href="">--}}
            {{--<div class="logo">--}}
                {{--<img class="logo-size"  src="/dashbord/dist/img/mylogo.png" alt="">--}}
            {{--</div>--}}
        {{--</a>--}}
    </div>
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                {{--<h3> املاک سیب سینی </h3>--}}
                {{--<p style="line-height: normal"> سامانه مدیریت فایل و مشتری املاک سیب سینی. </p>--}}
            </div>
        </div>
        <div class="form-holder">
            @if (session()->has('error'))
                <li class="alert alert-danger text-right mb-0">{{ session('error') }}</li>
            @endif
            <div class="form-content pt-5">
                <div class="form-items">
                    <h3>املاک سیب سینی</h3>
                    <p class="mt-4"> سامانه مدیریت فایل و مشتری املاک سیب سینی </p>
                    <div class="page-links mb-5">
                        <a href="login" class="active ml-3">ورود</a>
                    </div>
                    <form method="post" action="/login">
                        @csrf
                        <input class="form-control" type="text" name="username" placeholder=" نام کاربری " required>
                        <input class="form-control" type="password" name="password" placeholder="کلمه عبور" required>
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">ورود</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="loginResources/js/jquery.min.js"></script>
<script type="text/javascript" src="loginResources/js/popper.min.js"></script>
<script type="text/javascript" src="loginResources/js/bootstrap.min.js"></script>
<script type="text/javascript" src="loginResources/js/main.js"></script>
</body>
</html>