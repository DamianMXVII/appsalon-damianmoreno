<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Escribe tu correo para recuperar tu password</p>

<?php include __DIR__ . '/../templates/alertas.php'; ?>

<form class="formulario" method="post" action="/olvide">

<div class="campo">
    <label for="email">Email:</label>
    <input id="email" name="email" placeholder="Tu email" type="email">

</div>
    <input class="boton" type="submit" value="enviar">
</form>
    <div class="acciones">
        <a href="/">Inicar Sesion</a>
        <a href="/crear-cuenta">Crear cuenta</a>

    </div>