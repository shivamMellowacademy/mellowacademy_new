<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Please Login Here - Mellow Elements</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="{{ URL::asset('public/admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/admin/assets/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }

        .login-container {
            display: flex;
            height: 100vh;
        }

        .login-left {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #ffffff;
        }

        .login-form-box {
            width: 100%;
            max-width: 420px;
            padding: 40px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            background-color: #fff;
        }

        .logo-box img {
            display: block;
            margin: 0 auto 30px;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-submit {
            border-radius: 8px;
            font-weight: 600;
        }

        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f0f2f5;
            padding: 20px;
        }

        .login-right img {
            max-width: 100%;
            max-height: 80%;
            height: auto;
        }

        @media (max-width: 768px) {
            .login-right {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Left: Login Form -->
    <div class="login-left">
        <div class="login-form-box">

            <div class="logo-box">
                <img src="{{ URL::asset('public/front/assets/images/Logo-01.png') }}" width="130" alt="Logo">
            </div>

            @if(Session::has('errmsg'))                 
                <div class="alert alert-{{ Session::get('message') }} alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('errmsg') }}</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
                {{ Session::forget('message') }}
                {{ Session::forget('errmsg') }}
            @endif

            <form method="post" action="{{ route('login_verification_admin') }}">
                @csrf
                <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email">
                    @if ($errors->has('email'))
                        <small class="text-danger">{{ $errors->first('email') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label>Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="myInput" class="form-control" placeholder="Enter password">
                    @if ($errors->has('password'))
                        <small class="text-danger">{{ $errors->first('password') }}</small>
                    @endif
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" onclick="myFunction()" class="form-check-input" id="showPass">
                    <label class="form-check-label" for="showPass">Show Password</label>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-submit">Sign In</button>
            </form>
        </div>
    </div>

    <!-- Right: Image Section -->
    <div class="login-right">
        <img src="{{ URL::asset('public/admin/assets/images/login_blue.svg') }}" alt="Login Illustration">
    </div>
</div>

<!-- JS -->
<script src="{{ URL::asset('public/admin/assets/plugins/jquery/jquery-3.4.1.min.js')}}"></script>
<script src="{{ URL::asset('public/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script>
    function myFunction() {
        var x = document.getElementById("myInput");
        x.type = x.type === "password" ? "text" : "password";
    }
</script>

</body>
</html>
