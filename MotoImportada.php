<?php
//1. Implementar la jerarquía de herencia que corresponda para implementar las motos Nacionales e Importadas.
/*Para el caso de las motos importadas, se debe almacenar el país desde el que se importa
y el importe correspondiente a los impuestos de importación que la empresa paga por el ingreso al país. */
class MotoImportada extends Moto{
    //2. Incorporar los atributos que se requieren para el nuevo requerimiento de la empresa.
    private $paisOrigen;
    private $impuesto;

    public function __construct($codigo,$costo,$anioFab,$descripcion,$porcentaje,$estado,$pais,$impuesto){
        parent::__construct($codigo,$costo,$anioFab,$descripcion,$porcentaje,$estado);
        $this->paisOrigen = $pais;
        $this->impuesto = $impuesto;
    }

    public function getPaisOrigen(){
        return $this->paisOrigen;
    }
    public function getImpuesto(){
        return $this->impuesto;
    }

    public function setPaisOrigen($pais){
        $this->paisOrigen = $pais;
    }
    public function setImpuesto($impuesto){
        $this->impuesto = $impuesto;
    }

    //3. Redefinir el método toString para que retorne la información de los atributos de la clase.
    public function __toString(){
        $cadena = parent::__toString();
        return $cadena . "  Pais Origen: " . $this->getPaisOrigen() . "\n" .
               "  Impuesto: " . $this->getImpuesto() . "\n";
    }

    /*4. Redefinir el método darPrecioVenta para el caso de las motos importadas, al valor calculado se debe sumar el
     impuesto que pagó la empresa por su importación. */
    public function darPrecioVenta(){
        $precioVenta = parent::darPrecioVenta();
        $precioVenta = $precioVenta + $this->getImpuesto();
        return $precioVenta;
    }
    
}