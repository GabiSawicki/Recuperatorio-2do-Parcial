<?php
class ContratoViaWeb extends Contrato
{

    private $descuento;


    public function __construct($fechaInicio, $fechaVencimiento, $ObjPlan, $Costo, $SeRenueva, $ObjCliente)
    {
        parent::__construct($fechaInicio, $fechaVencimiento, $ObjPlan, $Costo, $SeRenueva, $ObjCliente);
        $this->descuento = 10;
    }

    public function getDescuento()
    {
        return $this->descuento;
    }

    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }

    public function calcularImporte()
    {
        $importeFinal = parent::calcularImporte();
        $importeFinal -= $importeFinal * 0.1;
        return $importeFinal;
    }
}