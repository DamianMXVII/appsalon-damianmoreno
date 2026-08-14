<?php

namespace Model;

use Override;

class Servicio extends ActiveRecord{
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    // REGISTRAR ATRIBUTOS
    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    #[Override]
    public function validar()
    {
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->precio){
            self::$alertas['error'][] = 'El precio es obligatorio';
        }
        if(!is_numeric($this->precio)){
            self::$alertas['error'][] = 'El precio no es valido';
        }

        return self::$alertas;

    }

}