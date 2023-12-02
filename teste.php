<?php

include_once('global.php');

$especialidades = new Especialidades(
    "Ortodentista"
);
$dentista = new Dentista(
    'Dra. Maria',
    'maria@example.com',
    '987-654-3210',
    '98765432101',
    'CROSP54321',
    $especialidades,
    10.0,
    'Casa',
    '456',
    'Centro',
    'Cidade B',
    'Estado Y'
);



?>