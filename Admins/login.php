<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_valido = 'admin';
    $password_valido = '1234';

    $usuario = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($usuario === $usuario_valido && $password === $password_valido) {
        $_SESSION['logueado'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Usuario o contraseña incorrectos';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/superhero/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h3 class="text-center">Inicio de sesión</h3>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <label for="username">Usuario</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
