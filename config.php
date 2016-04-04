<?php
/**
 * Este arquivo contém as configurações necessárias para
 * o sistema de login funcionar corretamente.
 */

/* Define o limite de tempo da sessão em 60 minutos */
session_cache_expire(60);

// Inicia a sessão

session_start();
// Variável que verifica se o usuário está logado
if ( ! isset( $_SESSION['logado'] ) ) {
    $_SESSION['logado'] = false;
}

// Erro do login
$_SESSION['login_erro'] = false;
 
// Variáveis da conexão
$base_dados  = 'suzitereza';
$usuario_bd  = 'suzitereza';
$senha_bd    = 'Dktt8798**';
$host_db     = '179.188.16.2';
$charset_db  = 'UTF8';
$conexao_pdo = null;

// Concatenação das variáveis para detalhes da classe PDO
$detalhes_pdo  = 'mysql:host=' . $host_db . ';';
$detalhes_pdo .= 'dbname='. $base_dados . ';';
$detalhes_pdo .= 'charset=' . $charset_db . ';';

// Tenta conectar
try {
    // Cria a conexão PDO com a base de dados
    $conexao_pdo = new PDO($detalhes_pdo, $usuario_bd, $senha_bd);
} catch (PDOException $e) {
    // Se der algo errado, mostra o erro PDO
    print "Erro: " . $e->getMessage() . "<br/>";
   
    // Mata o script
    die();
}
?>