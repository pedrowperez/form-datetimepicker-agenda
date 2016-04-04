<?php

// Inclui o arquivo de configura��o
include('config.php');

// Variav�l para preencher o erro (se existir)
$erro = false;

// Verifica se algo foi postado para publicar ou editar
if (isset($_POST) && !empty($_POST)) {
    // Cria as vari�veis
    foreach ($_POST as $chave => $valor) {
        $$chave = $valor;

        // Verifica se existe algum campo em branco
        if (empty($valor)) {
            // Preenche o erro
            $erro = 'Existem campos em branco.';
        }
    }

    // Verifica se as vari�veis foram configuradas
    if (empty($inputName) || empty($inputEmail) || empty($inputPhone) || empty($inputClinica) || empty($inputDatetime)) {
        $erro = 'Existem campos em branco.';
    }

    // Verifica se o usu�rio existe
    $pdo_verifica = $conexao_pdo->prepare('SELECT * FROM si_agendamento WHERE id_ag = ?');
    $pdo_verifica->execute(array($inputDatetime));

    // Captura os dados da linha
    $id_ag = $pdo_verifica->fetch();
    $id_ag = $id_ag['id_ag'];

    // Verifica se tem algum erro
    if (!$erro) {
        // Se o usu�rio existir, atualiza
        if (!empty($id_ag)) {
            $pdo_insere = $conexao_pdo->prepare('UPDATE si_agendamento SET inputName_ag=?, inputEmail_ag=?, inputPhone_ag=?, inputClinica_ag=?, inputDatetime_ag=? WHERE id_ag=?');
            $pdo_insere->execute(array($inputName, $inputEmail, $inputPhone, $inputClinica, $inputDatetime, $id_ag));

            // Se o usu�rio n�o existir, cadastra novo
        } else {
            $pdo_insere = $conexao_pdo->prepare('INSERT INTO si_agendamento (inputName_ag, inputEmail_ag, inputPhone_ag, inputClinica_ag, inputDatetime_ag) VALUES (?, ?, ?, ?, ?)');
            $pdo_insere->execute(array($inputName, $inputEmail, $inputPhone, $inputClinica, $inputDatetime));
        }
    }
}
if ($_POST) {

    $quebra_linha = "\n";
    $emailsender = "contato@sociedadetucci.org";
    $nomeremetente = $_REQUEST['inputName'];
    $emaildestinatario = "contato@sociedadetucci.org";
    $assunto = "[AGENDA] SITE SUZI";
    $email = $_REQUEST['inputEmail'];
    $phone = $_REQUEST['inputPhone'];
    $clinica = $_POST['inputClinica'];
    $mensagem = $_REQUEST['inputMessage'];
    $agendamento = $_REQUEST['inputDatetime'];

    $mensagemHTML = 'Ol� , ' . $nomeremetente . ' tem um recado para voce.
Existe uma nova mensagem para voce diretamente do site da Suzi !
Nome: ' . $nomeremetente . ' 
E-mail:  ' . $email . '
Telefone: ' . $phone . '
Clinica: ' . $clinica . '
Mensagem:  ' . $mensagem . '
Agendamento: ' . $agendamento . '';

    $headers = "MIME-Version: 1.1" . $quebra_linha;
    $headers = "Content-type: text/html; charset=UTF-8" . $quebra_linha;
    $headers = "From: " . $emailsender . $quebra_linha;
    $headers = "Reply-To: " . $emailsender . $quebra_linha;
}
?>