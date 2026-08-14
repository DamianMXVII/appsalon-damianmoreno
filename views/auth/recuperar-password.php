<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">coloca tu nuevo password</p>

<?php include __DIR__ . '/../templates/alertas.php'; ?>

<?php if($error) return; ?>
<form class="formulario" method="post">
    <div class="campo">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Nuevo Password">

    </div>
        <input type="submit" class="boton" value="Guardar Password">
    <div class="acciones">
        <a href="/">Inicar Sesion</a>
        <a href="/crear-cuenta">No tienes cuenta? Crear cuenta</a>


    </div>
</form>