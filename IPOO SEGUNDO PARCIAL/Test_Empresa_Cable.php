<?php
include 'EmpresaCable.php';
include 'Contrato.php';
include 'Plan.php';
include 'Canal.php';
include 'Cliente.php';
include 'ContratoViaWeb.php';
include 'ContratoViaEmpresa.php';



//A
$empresaCable = new EmpresaCable([], []);

//B
$canal1 = new Canal("interes general", 1000, true);
$canal2 = new Canal("aventura", 2000, false);
$canal3 = new Canal("deportivo", 3000, true);

//C
$array1 = [$canal1, $canal2];
$array2 = [$canal3];
$plan1 = new Plan(111, $array1, 20000, true);
$plan2 = new Plan(123, $array2, 10000, false);

//D
$cliente = new Cliente(45798821, "Gabi", "Sawicki");

//E
$fechaInicio1 = date('d-m-Y');
$fechaVencimiento1 = date('d-m-Y', strtotime($fechaInicio1 . "+ 1 month"));


$contrato1 = new ContratoViaWeb($fechaInicio1, $fechaVencimiento1, $plan1, "Al dia", 0, true, $cliente);
$contrato2 = new ContratoViaWeb($fechaInicio1, $fechaVencimiento1, $plan2, "Al dia", 0, true, $cliente);
$contrato3 = new ContratoViaEmpresa($fechaInicio1, $fechaVencimiento1, $plan1, "Al dia", 0, true, $cliente);

//F
echo "$" . $contrato1->calcularImporte() . "\n";
echo "-----------------------------------------\n";
echo "$" . $contrato2->calcularImporte() . "\n";
echo "-----------------------------------------\n";
echo "$" . $contrato3->calcularImporte() . "\n";
echo "-----------------------------------------\n";

//G
if ($empresaCable->incorporarPlan($plan1)) {
    echo "EXITO\n";
    echo "-----------------------------------------\n";
} else {
    echo "FRACASO\n";
    echo "-----------------------------------------\n";
}

//H
if ($empresaCable->incorporarPlan($plan2)) {
    echo "EXITO\n";
    echo "-----------------------------------------\n";
} else {
    echo "FRACASO\n";
    echo "-----------------------------------------\n";

}

//I & J
$fechaInicio2 = date('d-m-Y');
$fechaVencimiento2 = date('d-m-Y', strtotime($fechaInicio2 . ' +30 days'));
$empresaCable->incorporarContrato($plan2, $cliente, $fechaInicio2, $fechaVencimiento2, false);
$empresaCable->incorporarContrato($plan1, $cliente, $fechaInicio2, $fechaVencimiento2, true);

//K
echo "$" . $empresaCable->pagarContrato($contrato3) . "\n";
echo "-----------------------------------------\n";

//L
echo "$" . $empresaCable->pagarContrato($contrato1) . "\n";
echo "-----------------------------------------\n";

//M
echo "$" . $empresaCable->retornarImporteContratos(111). "\n\n\n";
