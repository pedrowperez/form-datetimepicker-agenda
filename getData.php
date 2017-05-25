<?php

// Variáveis da conexão
$base_dados  = '####';
$usuario_bd  = '####';
$senha_bd    = '#####';
$host_db     = '######';
$charset_db  = 'UTF8';

// Concatenação das variáveis para detalhes da classe PDO
$detalhes_pdo  = 'mysql:host=' . $host_db . ';';
$detalhes_pdo .= 'dbname='. $base_dados . ';';
$detalhes_pdo .= 'charset=' . $charset_db . ';';

$conexao_pdo = new PDO($detalhes_pdo, $usuario_bd, $senha_bd);
$query = $conexao_pdo->query('SELECT TIME_FORMAT(`inputDatetime_ag`, '%H:%i') FROM suzitereza.si_agendamento')->fetchAll();

echo json_encode($query);
