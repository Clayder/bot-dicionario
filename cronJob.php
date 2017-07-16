<?php
require 'autoload.php';

$hora = new DateTime("now");
$min = new DateTime("8:00:00");
$max = new DateTime("23:59:00");

$horaAtual = $hora->format("H:i:s");
$horaMin = $min->format("H:i:s");
$horaMax = $max->format("H:i:s");

// só envia a mensagem entre a hora minima e maxima
if($horaAtual > $horaMin  && $horaAtual < $horaMax){
    $dicionario = new \app\controller\Dicionario();
    $dicionario->getPalavra();
}


