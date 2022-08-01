<?php
    //conexão com o banco de dados
    include_once("conecta.php");

    //recebendo os dados enviados pelo formulário
    $recnome=$_POST["fnome"];
    $reccpf=$_POST["fcpf"];
    $reccel=$_POST["fcel"];
    $reccep=$_POST["fcep"];
    $recend=$_POST["fend"];
    $recnum=$_POST["fnum"];
    $reccomp=$_POST["fcomp"];
    $recbairro=$_POST["fbairro"];
    $reccidade=$_POST["fcidade"];
    $recuf=$_POST["fuf"];
    $enderecocompleto=$recend." - ".$recnum." - ".$reccomp." - ".$recbairro." - ".$reccidade." - ".$recuf;
    //antes de incluir cabe verificar se já não existe o CPF na tabela, num sistema real
    //gravando do banco de dados
    mysqli_query($conexao, "INSERT INTO clientes (nome, cpf, celular,cep,endereco) VALUES ('$recnome', '$reccpf', '$reccel', '$reccep','$enderecocompleto')");

    //redirecionando
    header("location: usuarios.php");
?>