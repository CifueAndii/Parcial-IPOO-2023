<?php
class Empresa{
    /*1. Se registra la siguiente información: denominación, dirección, la colección de clientes, colección de
     motos y la colección de ventas realizadas.*/
    private $denominacion;
    private $direccion;
    private $refColClientes;
    private $refColMotos;
    private $refColVentas;

    //2. Método constructor que recibe como parámetros los valores iniciales para los atributos de la clase.
    public function __construct($denominacion,$direccion,$clientes,$motos,$ventas){
        $this->denominacion = $denominacion;
        $this->direccion = $direccion;
        $this->refColClientes = $clientes;
        $this->refColMotos = $motos;
        $this->refColVentas = $ventas;
    }

    //3. Los métodos de acceso para cada una de las variables instancias de la clase.
    public function getDenominacion(){
        return $this->denominacion;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getRefColClientes(){
        return $this->refColClientes;
    }
    public function getRefColMotos(){
        return $this->refColMotos;
    }
    public function getRefColVentas(){
        return $this->refColVentas;
    }

    public function setDenominacion($denominacion){
        $this->denominacion = $denominacion;
    }
    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }
    public function setRefColClientes($clientes){
        $this->refColClientes = $clientes;
    }
    public function setRefColMotos($motos){
        $this->refColMotos = $motos;
    }
    public function setRefColVentas($ventas){
        $this->refColVentas = $ventas;
    }

    //4. Redefinir el método _toString para que retorne la información de los atributos de la clase
    public function __toString(){
        return "Denominacion: " . $this->getDenominacion() . "\n" .
               "Direccion: " . $this->getDireccion() . "\n" .
               "Clientes: \n" . $this->mostrarClientes() . "\n" .
               "Motos: \n" . $this->mostrarMotos() . "\n" .
               "Ventas: \n" . $this->mostrarVentas() . "\n";
    }

    public function mostrarClientes(){
        $colClientes = $this->getRefColClientes();
        $cantClientes = count($colClientes);
        $cadena = "";
        $nroCliente = 1;
        for($i=0;$i<$cantClientes;$i++){
            $unCliente = $colClientes[$i];
            $cadena = $cadena . " Cliente Nro " . $nroCliente . ":\n" . $unCliente . "\n";
            $nroCliente++;
        }
        return $cadena;
    }

    public function mostrarMotos(){
        $colMotos = $this->getRefColMotos();
        $cantMotos = count($colMotos);
        $cadena = "";
        $nroMoto = 1;
        for($i=0;$i<$cantMotos;$i++){
            $unaMoto = $colMotos[$i];
            $cadena = $cadena . " Moto Nro " . $nroMoto . ":\n" . $unaMoto . "\n";
            $nroMoto++;
        }
        return $cadena;
    }

    public function mostrarVentas(){
        $colVentas = $this->getRefColVentas();
        $cantVentas = count($colVentas);
        $cadena = "";
        $nroVenta = 1;
        for($i=0;$i<$cantVentas;$i++){
            $unaVenta = $colVentas[$i];
            $cadena = $cadena . " Venta Nro " . $nroVenta . ":\n" . $unaVenta . "\n";
            $nroVenta++;
        }
        return $cadena;
    }
    /*5. Implementar el método retornarMoto($codigoMoto) que recorre la colección de motos de la Empresa y
     retorna la referencia al objeto moto cuyo código coincide con el recibido por parámetro. */
    public function retornarMoto($codigoMoto){
        $colMotos = $this->getRefColMotos();
        $cantMotos = count($colMotos);
        $i = 0;
        $objMoto = null;

        while($i<$cantMotos && $objMoto == null){
            $unaMoto = $colMotos[$i];
            if($unaMoto->getCodigo() == $codigoMoto){
                $objMoto = $unaMoto;
            }
            $i++;
        }
        return $objMoto;
    }

    /*6. Implementar el método registrarVenta($colCodigosMoto, $objCliente) método que recibe por
     parámetro una colección de códigos de motos, la cual es recorrida, y por cada elemento de la colección
     se busca el objeto moto correspondiente al código y se incorpora a la colección de motos de la instancia
     Venta que debe ser creada. Recordar que no todos los clientes ni todas las motos, están disponibles
     para registrar una venta en un momento determinado.
     El método debe setear los variables instancias de venta que corresponda y retornar el importe final de la venta. */
    public function registrarVenta($colCodigosMoto,$objCliente){
        $colVentas = $this->getRefColVentas();
        $cantCodigos = count($colCodigosMoto);
        $importeFinal = -1;
        $objVenta = null;

        for($i=0;$i<$cantCodigos;$i++){
            $unCodigo = $colCodigosMoto[$i];
            $objMoto = $this->retornarMoto($unCodigo);
            if($objMoto != null && !$objCliente->getDadoBaja()){
                if($objVenta == null){
                    $objVenta = new Venta($this->ultimoNumVenta(),$objCliente,[],0);
                }
                $objVenta->incorporarMoto($objMoto);
            }
        }
        
        if($objVenta != null){
            $importeFinal = $objVenta->getPrecioFinal();
            $colVentas [] = $objVenta;
            $this->setRefColVentas($colVentas);
        }
        return $importeFinal;
    }

    public function ultimoNumVenta(){
        $colVentas = $this->getRefColVentas();
        $cantVentas = count($colVentas);
        
        if($cantVentas == 0){
            $nroVenta = 1;
        }else{
            $nroVenta = $colVentas[$cantVentas - 1]->getNumero() + 1;
        }
        return $nroVenta;
    }

    /*7. Implementar el método retornarVentasXCliente($tipo,$numDoc) que recibe por parámetro el tipo y
     número de documento de un Cliente y retorna una colección con las ventas realizadas al cliente. */
     public function retornarVentasXCliente($tipo,$numDoc){
        $colVentas = $this->getRefColVentas();
        $cantVentas = count($colVentas);
        $ventasCliente = null;

        for($i=0;$i<$cantVentas;$i++){
            $unaVenta = $colVentas[$i];
            $unCliente = $unaVenta->getRefCliente();
            if($unCliente->getTipoDoc() == $tipo && $unCliente->getNroDoc() == $numDoc){
                $ventasCliente [] = $unaVenta;
            }
        }
        return $ventasCliente;
     }

    //----------------------------Metodos 2 Parcial------------------------------------------
    /*1. Implementar el método informarSumaVentasNacionales() que recorre la colección de ventas realizadas por la
     empresa y retorna el importe total de ventas Nacionales realizadas por la empresa.
     (*IMPORTANTE: invocar a los métodos implementados en la clase venta cuando crea necesario) */
    public function informarSumaVentasNacionales(){
        $colVentas = $this->getRefColVentas();
        $importeTotal = 0;

        for($i=0;$i<count($colVentas);$i++){
            $unaVenta = $colVentas[$i];
            $totalUnaVentaNacional = $unaVenta->retornarTotalVentaNacional();
            $importeTotal = $importeTotal + $totalUnaVentaNacional;
        }
        return $importeTotal;
    }
    /*2. Implementar el método informarVentasImportadas() que recorre la colección de ventas realizadas por la empresa y
     retorna una colección de ventas de motos importadas. Si en la venta al menos una de las motos es importada la
     venta debe ser informada.
     (*IMPORTANTE: invocar a los métodos implementados en la clase venta cuando crea necesario) */
    public function informarVentasImportadas(){
        $colVentas = $this->getRefColVentas();
        $colVentasMotosImportadas = array();

        for($i=0;$i<count($colVentas);$i++){
            $unaVenta = $colVentas[$i];
            $ventaMotosImportadas = $unaVenta->retornarMotosImportadas();
            if(!empty($ventaMotosImportadas)){
                $colVentasMotosImportadas [] = $ventaMotosImportadas;
            }
            
        }
        return $colVentasMotosImportadas;
    } 
}