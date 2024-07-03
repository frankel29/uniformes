<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        <link rel="stylesheet" href="{{asset('assets/estilos.css')}}">
    </head>

    <body>
    <section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Registro</h2>
              <p class="text-white-50 mb-5">Llena todos los campos!</p>



              <form action="{{route('register')}}" method="post">
                @csrf 
                <div data-mdb-input-init class="form-outline form-white mb-4">
                  <input type="text" name="Nombre" id="idnombre" class="form-control form-control-lg" />
                  <label class="form-label" for="typeEmailX">Nombre</label>
                </div>
                <div data-mdb-input-init class="form-outline form-white mb-4">
                  <input type="text" name="Apellido" id="idapellido" class="form-control form-control-lg" />
                  <label class="form-label" for="typeEmailX">Apellido</label>
                </div>
                <div data-mdb-input-init class="form-outline form-white mb-4">
                  <input type="text" name="Teléfono" id="idtelefono" class="form-control form-control-lg" />
                  <label class="form-label" for="typeEmailX">Teléfono</label>
                </div>
                <div data-mdb-input-init class="form-outline form-white mb-4">
                  <input type="email" name="Correo electrónico" id="typeEmailX" class="form-control form-control-lg" />
                  <label class="form-label" for="typeEmailX">Correo electrónico</label>
                </div>

                <div data-mdb-input-init class="form-outline form-white mb-4">
                  <input type="password" name="password" id="typePasswordX" class="form-control form-control-lg" />
                  <label class="form-label" for="typePasswordX">Contraseña</label>
                </div>
                <div data-mdb-input-init class="form-outline form-white mb-4">
                  <input type="password" name="password confirmation" id="typePasswordX2" class="form-control form-control-lg" />
                  <label class="form-label" for="typePasswordX">Confirmar Contraseña</label>
                </div>

                <!-- <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">¿Olvidaste tu contraseña?</a></p> -->
                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Registrarse</button>
              </form>


              <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div>
            </div>
            <div>
              <p class="mb-0">Volver a login<a href="{{route('login')}}" class="text-white-50 fw-bold">Volver</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
