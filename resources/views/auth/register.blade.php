<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ asset('assets/index2.html')}}"><b>Registrasi</a>
  </div>
  <div class="box box-warning">
    <!-- /.box-header -->
    <div class="box-body">
      <form role="form" action="{{ route('register') }}" method="POST">
        @csrf
        <!-- text input -->
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="name" class="form-control" placeholder="Masukan Nama" value="{{ old('name') }}" autocomplete="off">
          @error('name')
          <div class="invalid-feedback text-danger" style="display: block">
              {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" placeholder="Masukan Email" value="{{old('email')}}" autocomplete="off">
          @error('email')
          <div class="invalid-feedback text-danger" style="display: block">
              {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-group">
            <label>Kata Sandi</label>
            <input type="password" name="password" class="form-control" placeholder="Masukan Kata Sandi" autocomplete="off">
            @error('password')
            <div class="invalid-feedback text-danger" style="display: block">
                {{ $message }}
            </div>
            @enderror  
        </div>
        <div class="form-group">
            <label>Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Masukan Konfirmasi Kata Sandi">
            @error('pasword_confirmation')
            <div class="invalid-feedback text-danger" style="display: block">
                {{ $message }}
            </div>
            @enderror  
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary w-100">Registrasi</button>
        </div>
      </form>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{ asset('assets/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
