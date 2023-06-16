<?php
class Moto{
    /*1. Se registra la siguiente información: código, costo, año fabricación, descripción, porcentaje
     incremento anual, activa (atributo que va a contener un valor true, si la moto está disponible para la
     venta y false en caso contrario).*/
    private $codigo;
    private $costo;
    private $anioFabricacion;
    private $descripcion;
    private $porcIncremento;
    private $esActiva;

    //2. Método constructor que recibe como parámetros los valores iniciales para los atributos definidos en la clase.
    public function __construct($codigo,$costo,$anioFab,$descripcion,$porcentaje,$estado){
        $this->codigo = $codigo;
        $this->costo = $costo;
        $this->anioFabricacion = $anioFab;
        $this->descripcion = $descripcion;
        $this->porcIncremento = $porcentaje;
        $this->esActiva = $estado;
    }

    //3. Los métodos de acceso de cada uno de los atributos de la clase.
    public function getCodigo(){
        return $this->codigo;
    }
    public function getCosto(){
        return $this->costo;
    }
    public function getAnioFabricacion(){
        return $this->anioFabricacion;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function getPorcIncremento(){
        return $this->porcIncremento;
    }
    public function getEsActiva(){
        return $this->esActiva;
    }

    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    public function setCosto($costo){
        $this->costo = $costo;
    }
    public function setAnioFabricacion($anioFab){
        $this->anioFabricacion = $anioFab;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    public function setPorcIncremento($porcentaje){
        $this->porcIncremento = $porcentaje;
    }
    public function setEsActiva($esActiva){
        $this->esActiva = $esActiva;
    }


    //4. Redefinir el método toString para que retorne la información de los atributos de la clase.
    public function __toString(){
        return "  Codigo: " . $this->getCodigo() . "\n" .
               "  Costo: " . $this->getCosto() . "\n" .
               "  Anio Fabricacion: " . $this->getAnioFabricacion() . "\n" .
               "  Descripcion: " . $this->getDescripcion() . "\n" .
               "  Porc Incremento Anual: " . $this->getPorcIncremento() . "\n" .
               "  Es Activa?: " . $this->mostrarEstado() . "\n";
    }

    public function mostrarEstado(){
        $estadoMoto = $this->getEsActiva();

        if($estadoMoto){
            $mensaje = "Si";
        }else{
            $mensaje = "No";
        }
        return $mensaje;
    }

    /*5. Implementar el método darPrecioVenta el cual calcula el valor por el cual puede ser vendida una moto.
     Si la moto no se encuentra disponible para la venta retorna un valor < 0. Si la moto está disponible para
     la venta, el método realiza el siguiente cálculo:
                            $_venta = $_compra + $_compra * (anio * por_inc_anual)
     donde $_compra: es el costo de la moto.
     anio: cantidad de años transcurridos desde que se fabricó la moto.
     por_inc_anual: porcentaje de incremento anual de la moto. */
    public function darPrecioVenta(){
        $estadoMoto = $this->getEsActiva();
        $costo = $this->getCosto();
        $anios = getdate()["year"] - $this->getAnioFabricacion();
        $porcIncremento = $this->getPorcIncremento();
        $precioVenta = -1;

        if($estadoMoto){
            $precioVenta = $costo + $costo * ($anios * $porcIncremento);
        }

        return $precioVenta;
    }
}