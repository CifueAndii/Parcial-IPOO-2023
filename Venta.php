<?php
class Venta{
    /*1. Se registra la siguiente información: número, fecha, referencia al cliente, referencia a una colección de
     motos y el precio final. */
    private $numero;
    private $fecha;
    private $refCliente;
    private $refColMotos;
    private $precioFinal;

    //2. Método constructor que recibe como parámetros cada uno de los valores a ser asignados a cada atributo de la clase.
    public function __construct($nro,$cliente,$colMotos,$precioFinal){
        $this->numero = $nro;
        $this->fecha = getdate();
        $this->refCliente = $cliente;
        $this->refColMotos = $colMotos;
        $this->precioFinal = $precioFinal;
    }

    //3. Los métodos de acceso de cada uno de los atributos de la clase.
    public function getNumero(){
        return $this->numero;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getRefCliente(){
        return $this->refCliente;
    }
    public function getRefColMotos(){
        return $this->refColMotos;
    }
    public function getPrecioFinal(){
        return $this->precioFinal;
    }

    public function setNumero($nro){
        $this->numero = $nro;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    public function setRefCliente($cliente){
        $this->refCliente = $cliente;
    }
    public function setRefColMotos($motos){
        $this->refColMotos = $motos;
    }
    public function setPrecioFinal($precioFinal){
        $this->precioFinal = $precioFinal;
    }

    //4. Redefinir el método _toString para que retorne la información de los atributos de la clase.
    public function __toString(){
        return " Numero: " . $this->getNumero() . "\n" .
               " Fecha: " . $this->mostrarFecha() . "\n" .
               " Cliente: \n" . $this->getRefCliente() . "\n" .
               " Motos: \n" . $this->mostrarMotos() . "\n" .
               " Precio Final: " . $this->getPrecioFinal() . "\n";
    }

    public function mostrarMotos(){
        $colMotos = $this->getRefColMotos();
        $cantMotos = $this->cantMotos();
        $cadena = "";
        $nroMoto = 1;
        for($i=0;$i<$cantMotos;$i++){
            $unaMoto = $colMotos[$i];
            $cadena = $cadena . "Moto Nro " . $nroMoto . ":\n" . $unaMoto . "\n";
            $nroMoto++;
        }
        return $cadena;
    }

    public function mostrarFecha(){
        $fecha = $this->getFecha();
        return $fecha["mday"] . "/" . $fecha["mon"] . "/" . $fecha["year"];
    }

    public function cantMotos(){
        $colMotos = $this->getRefColMotos();
        $cantMotos = count($colMotos);
        return $cantMotos;
    }
    
    /*5. Implementar el método incorporarMoto($objMoto) que recibe por parámetro un objeto moto y lo
     incorpora a la colección de motos de la venta, siempre y cuando sea posible la venta. El método cada
     vez que incorpora una moto a la venta, debe actualizar la variable instancia precio final de la venta.
     Utilizar el método que calcula el precio de venta de la moto donde crea necesario. */
    public function incorporarMoto($objMoto){
        $colMotos = $this->getRefColMotos();
        if($objMoto->getEsActiva()){
            $colMotos [] = $objMoto;
            $precioMoto = $objMoto->darPrecioVenta();
            $this->setRefColMotos($colMotos);
            $this->setPrecioFinal($this->getPrecioFinal() + $precioMoto);
        }
    }

    //----------------------------Metodos 2 Parcial------------------------------------------
    //1. Implementar el método retornarTotalVentaNacional() que retorna la sumatoria del precio venta de cada una de las motos Nacionales vinculadas a la venta.
    public function retornarTotalVentaNacional(){
        $colMotos = $this->getRefColMotos();
        $cantMotos = $this->cantMotos();
        $sumatoriaPrecioVenta = 0;

        for($i=0;$i<$cantMotos;$i++){
            $unaMoto = $colMotos[$i];
            if($unaMoto instanceof MotoNacional){
                $precioVenta = $unaMoto->darPrecioVenta();
                $sumatoriaPrecioVenta = $sumatoriaPrecioVenta + $precioVenta;
            }
        }
        return $sumatoriaPrecioVenta;
    }
    /*2. Implementar el método retornarMotosImportadas() que retorna una colección de motos importadas vinculadas a la
         venta. Si la venta solo se corresponde con motos Nacionales la colección retornada debe ser vacía. */
    public function retornarMotosImportadas(){
        $colMotos = $this->getRefColMotos();
        $cantMotos = $this->cantMotos();
        $colMotosImportadas = array();

        for($i=0;$i<$cantMotos;$i++){
            $unaMoto = $colMotos[$i];
            if($unaMoto instanceof MotoImportada){
                $colMotosImportadas [] = $unaMoto;
            }
        }
        return $colMotosImportadas;
    }
}