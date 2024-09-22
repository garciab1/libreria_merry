
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
           body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-image: url('{{ asset('images/fondo.gif') }}');
      background-size: cover;
  }

    </style>
    <title>FORMULARIO DE REGISTRO E INICIO SESIÓN</title>
</head>
<body>

    <div class="container-form register">
        <div class="information">
            <div class="info-childs">
              <img src="{{asset('images/icono.png')}}" alt="" style="height: 200px">
              <h2>Libreria Merry</h2>
              <p>¡Bienvenido de nuevo! tu pones la idea y nosotros los materiales.</p>
                
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Por favor inicia sesión</h2>
                <div class="icons">
                  <a href="{{ url('auth/google') }}">
                    <!--<i class='bx bxl-google'></i>-->
                 
                  <button id="googleSignInBtn" class="btn btn-primary btn-lg">
                    <img src="https://img.icons8.com/color/16/000000/google-logo.png"/> Iniciar sesión con Google
                </button>
              </a>
                </div>
                <!--
                <p>o inicia sesión con tus credenciales</p>
                <form class="form form-register" novalidate>
                    <div>
                        <label>
                            <i class='bx bx-user' ></i>
                            <input type="text" placeholder="Nombre Usuario" name="userName" >
                        </label>
                    </div>
                  
                   <div>
                        <label>
                            <i class='bx bx-lock-alt' ></i>
                            <input type="password" placeholder="Contraseña" name="userPassword">
                        </label>
                   </div>
                   
                    <input type="submit" value="Iniciar sesión">
                    <div class="alerta-error">Todos los campos son obligatorios</div>
                    <div class="alerta-exito">Te registraste correctamente</div>
                </form>
              -->
            </div>
        </div>
    </div>


    
    <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
