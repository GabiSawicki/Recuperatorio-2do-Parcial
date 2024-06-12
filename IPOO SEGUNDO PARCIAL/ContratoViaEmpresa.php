<?php
class ContratoViaEmpresa extends Contrato
{
    public function __construct($fechaInicio, $fechaVencimiento, $ObjPlan, $Costo, $SeRenueva, $ObjCliente)
    {
        parent::__construct($fechaInicio, $fechaVencimiento, $ObjPlan, $Costo, $SeRenueva, $ObjCliente);
    }
}