<?php
include_once 'Empresa.php';
include_once 'Venta.php';
include_once 'Moto.php';
include_once 'MotoNacional.php';
include_once 'MotoImportada.php';
include_once 'Cliente.php';

//1. Cree 2 instancias de la clase Cliente: $objCliente1, $objCliente2.
$objCliente1 = new Cliente("Alberto","Juarez",false,"CI",42105074);
$objCliente2 = new Cliente("Luis","Fort",false,"DNI",47050124);
/*2. Cree 3 objetos Motos con la información visualizada en la tabla: código, costo, año fabricación,
     descripción, porcentaje incremento anual, activo entre otros.
     TABLA MOTOS NACIONALES:
        código   costo   anio_fabricacion         Descripcion       porc_increment   activo     porc_descuento
          11    2230000        2022          Benelli Imperiale 400       85%          true            10
          12     584000        2021            Zanella Zr 150 Ohc        70%          true            10
          13     999900        2023      Zanella Patagonian Eagle 250    55%          false                     
     TABLA MOTOS IMPORTADAS:
        código   costo   anio_fabricacion         Descripcion                         porc_increment   activo     pais_imp    $impesto_imp
          14    12499900        2020  Pitbike Enduro Motocross Apollo Aiii 190cc Plr       100%         true      Francia        6244400     */
$objMoto11 = new MotoNacional(11,2230000,2022,"Benelli Imperiale 400",85,true,10);
$objMoto12 = new MotoNacional(12,584000,2021,"Zanella Zr 150 Ohc",70,true,10);
$objMoto13 = new MotoNacional(13,999900,2023,"Zanella Patagonian Eagle 250",55,false,0);

$objMoto14 = new MotoImportada(14,12499900,2020,"Pitbike Enduro Motocross Apollo Aiii 190cc Plr",100,true,"Francia",6244400);
/*3. Se crea un objeto Empresa con la siguiente información: denominación =” Alta Gama”, dirección= “Av
     Argentina 123”, colección de motos= [$obMoto11, $obMoto12, $obMoto13,$objMoto14] , colección de clientes =
     [$objCliente1, $objCliente2 ], la colección de ventas realizadas=[]. */
$objEmpresa = new Empresa("Alta Gama","Av Argentina 123",[$objCliente1,$objCliente2],[$objMoto11,$objMoto12,$objMoto13,$objMoto14],[]);
/*4. Invocar al método registrarVenta($colCodigosMoto, $objCliente) de la Clase Empresa donde el
     $objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el
     punto 1) y la colección de códigos de motos es la siguiente [11,12,13,14]. Visualizar el resultado obtenido. */
$importe = $objEmpresa->registrarVenta([11,12,13,14],$objCliente2);
echo "4. El importe es: $" . $importe . "\n";
/*5. Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde el
     $objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el
     punto 1) y la colección de códigos de motos es la siguiente [13,14]. Visualizar el resultado obtenido. */
$importe = $objEmpresa->registrarVenta([13,14],$objCliente2);
echo "5. El importe es: $" . $importe . "\n";
/*6. Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde el
     $objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el
     punto 1) y la colección de códigos de motos es la siguiente [14,2]. Visualizar el resultado obtenido. */
$importe = $objEmpresa->registrarVenta([14,2],$objCliente2);
echo "6. El importe es: $" . $importe . "\n";
//7. Invocar al método informarVentasImportadas(). Visualizar el resultado obtenido.
$ventasMotosImportadas = $objEmpresa->informarVentasImportadas();
echo "7. " . mostrarVentas($ventasMotosImportadas);
//8. Invocar al método informarSumaVentasNacionales(). Visualizar el resultado obtenido.
echo "8. La suma de ventas nacionales es: $" . $objEmpresa->informarSumaVentasNacionales() . "\n";

// ----------------------------------------------------------------------------------------------------
function mostrarVentas($ventas){
    $nroVenta = 1;
    if($ventas == null){
        $mensaje = "La venta es nula\n";
    }else{
        $mensaje = "Ventas de motos importadas: \n";
        for($i=0;$i<count($ventas);$i++){
          $mensaje = $mensaje . "Venta " . $nroVenta . " :" . "\n" . 
                    $ventas[$i][0] . "\n";
          $nroVenta++;
        }
    }
    return $mensaje;
    
}
//9. Realizar un echo de la variable Empresa creada en 2.
echo "----------------------------------------------------------------------------------------------------\n";
echo "Datos Empresa: " . "\n";
echo $objEmpresa->__toString();