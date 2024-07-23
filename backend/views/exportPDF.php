<?php

/** @var Created by: Abel Eusébio Alberto Wamana */
/** @varE - mail  : abelwamana@gmail.com*/
/** @var Tel: +244 927 487 045*/
/** @var Eu Creio! Eu Creio! Eu Creio em Jesús Cristo meu Senhor e Rei */

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output();

