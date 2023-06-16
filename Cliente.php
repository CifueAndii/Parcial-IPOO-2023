<?php
class Cliente{
    /*0. Se registra la siguiente información: nombre, apellido, si está o no dado de baja, el tipo y el número de
     documento. Si un cliente está dado de baja, no puede registrar compras desde el momento de su baja.*/
    private $nombre;
    private $apellido;
    private $dadoBaja;
    private $tipoDoc;
    private $nroDoc;

    //1. Método constructor que recibe como parámetros los valores iniciales para los atributos.
    public function __construct($nombre,$apellido,$dadoBaja,$tipoDoc,$numDoc){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dadoBaja = $dadoBaja;
        $this->tipoDoc = $tipoDoc;
        $this->nroDoc = $numDoc;
    }

    //2. Los métodos de acceso de cada uno de los atributos de la clase.
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getDadoBaja(){
        return $this->dadoBaja;
    }
    public function getTipoDoc(){
        return $this->tipoDoc;
    }
    public function getNroDoc(){
        return $this->nroDoc;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setApellido($apellido){
        $this->apellido = $apellido;
    }
    public function setDadoBaja($dadoBaja){
        $this->dadoBaja = $dadoBaja;
    }
    public function setTipoDoc($tipoDoc){
        $this->tipoDoc = $tipoDoc;
    }
    public function setNroDoc($nroDoc){
        $this->nroDoc = $nroDoc;
    }


    //3. Redefinir el método _toString para que retorne la información de los atributos de la clase.
    public function __toString(){
        return "  Nombre: " . $this->getNombre() . "\n" .
               "  Apellido: " . $this->getApellido() . "\n" .
               "  Dado de Baja: " . $this->mostrarBaja() . "\n" .
               "  Tipo de Doc: " . $this->getTipoDoc() . "\n" .
               "  Num de Doc: " . $this->getNroDoc() . "\n";
    }

    public function mostrarBaja(){
        $estadoBaja = $this->getDadoBaja();

        if($estadoBaja){
            $mensaje = "Si";
        }else{
            $mensaje = "No";
        }
        return $mensaje;
    }
}