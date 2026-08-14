<?php

namespace Model;

use Model\ActiveRecord;

class CitaServicio extends ActiveRecord{
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['id', 'citasId', 'servicioId'];

    public $id;
    public $citasId;
    public $servicioId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->citasId = $args['citaId'] ?? '';
        $this->servicioId = $args['servicioId'] ?? '';
    }

    }