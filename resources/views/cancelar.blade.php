
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
      <title>CANCELAR EL PROCESO DE INICIO DE SECCIÓN</title>
  </head>
  <body style="background-color: #1b3b5f; color: #ffffff; font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
    <div style="text-align: center; background-color: #2e517a; padding: 60px; border-radius: 15px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);">
        <h1 style="color: #f0f0f0; font-size: 36px; font-weight: bold; border: 2px solid #f0f0f0; padding: 20px; border-radius: 10px; background-color: #3a6fa5; display: inline-block; margin-bottom: 20px;">
            ⚠️ Autenticación Cancelada ⚠️
        </h1>
        <p style="color: #d1d1d1; font-size: 18px; margin-top: 0;">Parece que has cancelado el proceso de autenticación con Google. Si esto fue un error, por favor intenta nuevamente.</p>
        <a href="/auth/google" style="background-color: #3a6fa5; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 20px; display: inline-block; transition: background-color 0.3s;">Ir al Inicio de Sesión</a>
    </div>
  </body>
</html>
