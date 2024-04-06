<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Web Sekolah</title>
  </head>
  <body>
    <section class="">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-6 text-black p-5">
              <h3 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px;">Silahkan Login</h3>
              @foreach ($errors->all() as $error)
                <p class="text-danger">
                {{ $error }}
                {{-- email dan kata sandi yang Anda masukkan tidak sesuai --}}
                </p>
              @endforeach      
              <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-outline mb-4">
                  <input type="email" name="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="form-outline mb-4">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
                  <button type="submit" class="btn btn-primary w-100">Masuk </button>
            </form>
          </div>

          <div class="col-md-6 px-0 d-none d-sm-block text-center">
            <img src="{{ asset('assets/dist/img/inventory.jpg') }}" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: center;width:100%">
          </div>

        </div>
      </div>
    </section>    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 </body>
</html>