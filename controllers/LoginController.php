<?php

namespace Controllers;
use Classes\Email;
use Model\Usuario;
use MVC;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // “Crea un objeto de tipo Usuario y pásale todos los datos enviados por el formulario.”
            $auth = new Usuario($_POST); 

            $alertas = $auth->validarLogin();

            
            if(empty($alertas)){
                // Comprovar que exitsa 
                $usuario = Usuario::where('email', $auth->email);

                if($usuario){
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){

                        session_start();
                        $_SESSION['id'] = $usuario->id  ?? null;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apelldio;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;


                        if($usuario->admin === "1"){
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            
                            header('location: /admin');
                        }else{
                            header('location: /cita');

                        }

                    }
                }else{
                    Usuario::setAlerta('error', 'Usuario no encotrado');
                }
            }


        }
    
    $alertas = Usuario::getAlertas();
    $router->render('auth/login',[
        'alertas' => $alertas
    ]);
        
    }

    public static function logout(){
        session_start();

        $_SESSION = [];

        header('location: /');

    }

    public static function olvide(Router $router){
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);

            $alertas = $auth->validarEmail();

            if(empty($alertas)){
                $usuario = Usuario::where('email', $auth->email);

                if($usuario && $usuario->confirmado === "1"){
                    $usuario->crearToken();
                    $usuario->guardar();

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();




                    Usuario::setAlerta('exito', 'Revisa tu correo');

                }else{
                    Usuario::setAlerta('error', 'No se encontro usuario');
                }
            }


        }
                            $alertas = Usuario::getAlertas();

        $router->render('auth/olvide-password',[
            'alertas' => $alertas
        ]);

    }




    public static function recuperar(Router $router){
            $alertas = [];
            $error = false;

            $token = s($_GET['token']);

            $usuario = Usuario::where('token', $token);
                
            if(empty($usuario)){
                Usuario::setAlerta('error', 'Token no valido');
                $error = true;
            }

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $password = new Usuario($_POST);
                $alertas = $password->validarPassword();

                if(empty($alertas)){
                    $usuario->password = null;  
                    $usuario->password = $password->password;
                    $usuario->hashPassword();
                    $usuario->token = null;

                    $resultado = $usuario->guardar();
                    
                    if($resultado){
                        header('location: /');
                    }
                }

            }


        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar-password',[
            'error' => $error, 
            'alertas' => $alertas
        ]);
    }





    public static function crear(Router $router){
        $usuario = new Usuario;

        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if(empty($alertas)){
                $resultado = $usuario->existeUsuario();
                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else{
                    $usuario->hashPassword();
                    $usuario->crearToken();

                    // Enviar email
                    $emial = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    
                    $emial->enviarConfirmacion();

                    //Crear el usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header('location: mensaje');
                    }

                    // debuguear($usuario);
                }
            }

        }
        
        $router->render('auth/crear-cuenta',[
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

        public static function mensaje(Router $router){

        $router->render('auth/mensaje');
    }
        public static function confirmar(Router $router){
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);


        if(empty($usuario)){
            //Token no Valido
            Usuario::setAlerta('error', 'Token no Valido');
        }else{
            // Confirmado
            $usuario->confirmado = 1;
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta Confirmada');



        }

        // debuguear($usuario);

        $alertas = Usuario::getAlertas($alertas);
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }





}
