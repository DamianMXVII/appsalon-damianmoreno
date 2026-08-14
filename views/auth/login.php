<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia session</p>
<?php
include __DIR__ . '/../templates/alertas.php';
?>
<form class="formulario" method="post" action="/">
    <div class="campo">
        <label for="email">Corrreo:</label>
        <input type="email" name="email" id="email" placeholder="Tu correo">
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Tu password" id="password">
    </div>

    <input type="submit" class="boton" value="Iniciar sesion">

    <div class="acciones">
        <a href="/crear-cuenta">No tienes cuenta? Crear cuenta</a>
        <a href="/olvide">Olvidaste tu contrasena?</a>

    </div>
    
</form>