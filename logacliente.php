<?php
    //recebendo os dados enviados pelo formulário
    $recid=$_POST["fid"];
    //conectando com o banco de dados
    include_once("conecta.php");
    //conferindo se existe um usuário e senha na tabela que seja igual ao recebido
    $login=mysqli_query($conexao, "SELECT * FROM clientes WHERE id='$recid'");
    
    //validando o login
    if(mysqli_num_rows($login) > 0){
        $dados=mysqli_fetch_array($login);
        $reccliente=$dados["nome"];
	session_start();
        $_SESSION["cliente"]=$reccliente;
        $_SESSION["codcliente"]=$recid;
        header("location:locacoes.php");
    }else{
        header("location:locacoes.php?info=1");
    }
?>