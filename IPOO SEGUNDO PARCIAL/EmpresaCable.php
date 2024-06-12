<?php

class EmpresaCable{

     //ATRIBUTOS
     private $coleccionPlanes;
     private $coleccionContratos;
 
     //CONSTRUCTOR
     public function __construct($coleccionPlanes, $coleccionContratos)
     {
         $this->coleccionPlanes = $coleccionPlanes;
         $this->coleccionContratos = $coleccionContratos;
     }
 
     //OBSERVADORES
     public function getColeccionPlanes()
     {
         return $this->coleccionPlanes;
     }
 
     public function getColeccionContratos()
     {
         return $this->coleccionContratos;
     }
 
     //MODIFICADORES
     public function setColeccionPlanes($coleccionPlanes)
     {
         $this->coleccionPlanes = $coleccionPlanes;
     }
 
     public function setColeccionContratos($coleccionContratos)
     {
         $this->coleccionContratos = $coleccionContratos;
     }
 
     //METODO toString
     public function __toString()
     {
         return "----------PLANES----------\n" . $this->coltoString($this->getColeccionPlanes()) .
         "\n----------CONTRATOS----------\n" . $this->coltoString($this->getColeccionContratos());
     }
 
     public function coltoString($coleccion)
     {
         $retorno = "";
         foreach ($coleccion as $obj) {
             $retorno .= $obj . "\n------------------------------\n";
         }
         return $retorno;
     }
 
     public function incorporarPlan($objPlan)
     {
         $planes = $this->getColeccionPlanes();
         $esValido = true;
     
         $i = 0;
         while ($esValido && $i < count($planes)) {
             if ($planes[$i]->getIncluyeMG() === $objPlan->getIncluyeMG()) {
                 $esValido = false;
             }
             $i++;
         }
     
         if ($esValido) {
             $j = 0;
             while ($j < count($planes) && $esValido) {
                 $canalesExistentes = $planes[$j]->getColeccionCanales();
                 $canalesNuevos = $objPlan->getColeccionCanales();
                 $k = 0;
                 while ($k < count($canalesExistentes) && $k < count($canalesNuevos) && $esValido) {
                     if ($canalesExistentes[$k] === $canalesNuevos[$k]) {
                         $esValido = false;
                     }
                     $k++;
                 }
                 $j++;
             }
         }
     
         if ($esValido) {
             $planes[] = $objPlan;
             $this->setColeccionPlanes($planes);
         }
     
         return $esValido;
     }
     
     public function incorporarContrato($objPlan, $objCliente, $fechaInicio, $fechaVencimiento, $esWeb)
     {
         $contratos = $this->getColeccionContratos();
         $nuevoContrato = $esWeb
             ? new ContratoViaWeb($fechaInicio, $fechaVencimiento, $objPlan, "Al dia", 0, true, $objCliente)
             : new ContratoViaEmpresa($fechaInicio, $fechaVencimiento, $objPlan, "Al dia", 0, true, $objCliente);
         $contratos[] = $nuevoContrato;
         $this->setColeccionContratos($contratos);
     }
     
     public function retornarImporteContratos($codigoPlan)
     {
         $totalImporte = 0;
         foreach ($this->getColeccionContratos() as $contrato) {
             if ($contrato->getObjPlan()->getCodigo() === $codigoPlan) {
                 $totalImporte += $contrato->calcularImporte();
             }
         }
         return $totalImporte;
     }
     
     public function pagarContrato($contrato)
     {
         $contrato->actualizarEstadoContrato();
         return $contrato->calcularImporte();
     }
     
}

?>