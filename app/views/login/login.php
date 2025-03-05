<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url() ?>">Proyecto Tienda</a>
    </div>
  </nav>

  <!-- Contenedor principal para el login -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white text-center">
            <h2>Login</h2>
          </div>
          <div class="card-body">
            <form action="<?= base_url() ?>login/login" method="post">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input required name="username" type="text" id="username" class="form-control" placeholder="Ingrese su usuario">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input required name="password" type="password" id="password" class="form-control" placeholder="Ingrese su contraseña">
              </div>
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember">
                  <label class="form-check-label" for="remember">Recordarme</label>
                </div>
                <a href="#" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Login</button>
              </div>
            </form>
            <div class="mt-3 text-center">
              <small>
                ¿No tienes una cuenta? <a href="<?= base_url() ?>login/register" class="text-danger text-decoration-none">Regístrate</a>
              </small>
              <?php if (isset($data[0])): ?>
                <div class="alert alert-danger mt-2" role="alert">
                  <?= htmlspecialchars($data[0]) ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5 d-none d-md-block">
        <img src="<?= base_url() ?>assets/img/draw2.webp" alt="Imagen de Login" class="img-fluid">
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-primary text-white py-3 mt-4">
    <div class="container d-flex justify-content-between align-items-center">
      <div>
        &copy; <?= date("Y") ?> Mi Proyecto. Todos los derechos reservados.
      </div>
      <div>
        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS Bundle (incluye Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>