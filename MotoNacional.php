<?php
//1. Implementar la jerarquía de herencia que corresponda para implementar las motos Nacionales e Importadas.
/*Con el objetivo de incentivar el consumo de productos Nacionales, se desea almacenar un porcentaje de descuento en las motos Nacionales que
será aplicado al momento de la venta (por defecto el valor del descuento es del 15%). */
class MotoNacional extends Moto{
    //2. Incorporar los atributos que se requieren para el nuevo requerimiento de la empresa.
    private $porcDescuento;

    public function __construct($codigo,$costo,$anioFab,$descripcion,$porcentaje,$estado,$porcDescuento){
        parent::__construct($codigo,$costo,$anioFab,$descripcion,$porcentaje,$estado);
        $this->porcDescuento = $porcDescuento;
    }

    public function getPorcDescuento(){
        return $this->porcDescuento;
    }

    public function setPorcDescuento($descuento){
        $this->porcDescuento = $descuento;
    }

    //3. Redefinir el método toString para que retorne la información de los atributos de la clase.
    public function __toString(){
        $cadena = parent::__toString();
        return $cadena . "  Porc Descuento: " . $this->getPorcDescuento() . "\n";
    }

    /*4. Redefinir el método darPrecioVenta para que en el caso de las motos nacionales aplique el porcentaje de descuento
     sobre el valor calculado inicialmente. */
    public function darPrecioVenta(){
        $precioVenta = parent::darPrecioVenta();
        if($this->getPorcDescuento() == 0){
            $this->setPorcDescuento(15);
        }
        $precioVenta = $precioVenta - ($precioVenta * $this->getPorcDescuento() / 100);
        return $precioVenta;
    }
}