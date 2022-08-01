<?php
    //recebendo os dados enviados pelo formulário
    $recuser=$_POST["fuser"];
    $recpass=$_POST["fpass"];
    
    //conectando com o banco de dados
    include_once("conecta.php");
    //conferindo se existe um usuário e senha na tabela que seja igual ao recebido
    $login=mysqli_query($conexao, "SELECT * FROM usuarios WHERE user='$recuser' AND pass='$recpass' ");
    
    //validando o login
    if(mysqli_num_rows($login) > 0){
        $dados=mysqli_fetch_array($login);
        $recnome=$dados["user"];
        $recnivel=$dados["nivel"];
        session_start();
        $_SESSION["nivel"]=$recnivel;
        $_SESSION["user"]=$recnome;
        header("location:admin.php");
    }else{
        //criptografar o código de erro
        $erro=md5(1);
        header("location:index.php?e=".$erro);
    }
?>