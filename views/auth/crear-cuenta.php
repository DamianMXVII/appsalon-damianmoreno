<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario</p>

<?php 

include_once __DIR__ . '/../templates/alertas.php';

?>


<form class="formulario" action="/crear-cuenta" method="post">
    <div class="campo">
        <label for="nombre">Nombre:</label>
        <input name="nombre" type="name" id="nombre" placeholder="Tu nombre" value="<?php echo s($usuario->nombre); ?>">
    </div>
    <div class="campo">
        <label for="apellido">Apellido:</label>
        <input name="apellido" type="name" id="apellido" placeholder="Tu apellido" value="<?php echo s($usuario->apellido); ?>">
    </div>
    <div class="campo">
        <label for="telefono">Telefono:</label>
        <input name="telefono" type="tel" id="telefono" placeholder="Tu telefono" value="<?php echo s($usuario->telefono); ?>">
    </div>
    <div class="campo">
        <label for="email">Email:</label>
        <input name="email" type="email" id="email" placeholder="Tu email" value="<?php echo s($usuario->email); ?>">
    </div>
    <div class="campo">
        <label for="password">Password:</label>
        <input name="password" type="password" id="password" placeholder="Tu password">
    </div>

    <input type="submit" class="boton" value="Crear cuenta">

</form>
    <div class="acciones">
        <a href="/">Inicar Sesion</a>
        <a href="/olvide">Olvidaste tu contrasena?</a>

    </div>