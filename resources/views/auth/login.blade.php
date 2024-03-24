<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Form</title>
<!-- Bootstrap CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background-color: #605ca8;
    }
    .login-container {
        max-width: 500px;
        margin: 150px auto;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }
    .login-container h4 {
        /* margin-bottom: 30px; */
        text-align: center;
    }
    .login-container img {
        width: 100%;
        border-radius: 10px;
        margin-bottom: 20px;
    }
</style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="login-container">
                <h4 class="text-center"><b>SYSTEM INVENTORY</b></h4>
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>               
                @endforeach
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    {{-- <div class="mb-3 form-check">
                        <input type="checkbox" id="remember" name="remember" class="form-check-input">
                        <label for="remember" class="form-check-label">Remember me</label>
                    </div> --}}
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                {{-- <p class="mt-3">Don't have an account? <a href="{{ route('register') }}">Register here</a></p> --}}
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>