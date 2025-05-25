<!doctype html>
<html lang="es">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/login/css/style.css">

</head>

<body class="img js-fullheight" style="background-image: url(login/images/fondo.jpg); backdrop-filter: blur(10px);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">SISTEMA TESORERÍA</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Inicia Sesión</h3>
                        <form method="POST" class="signin-form" action="{{ route('identificacion') }}">
                            @csrf
                            <div class="form-group my-5">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Ingrese su usuario" name="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group my-5">
                                <input id="password-field" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Ingrese su contraseña" name="password">
                                <span toggle="#password-field"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit"
                                    class="form-control px-3" style="background: #202528">Ingresar</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Recordarme
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="/login/js/jquery.min.js"></script>
    <script src="/login/js/popper.js"></script>
    <script src="/login/js/bootstrap.min.js"></script>
    <script src="/login/js/main.js"></script>

</body>

</html>
