<?php
        //dados para a conexão com o servidor online, este que se usa quando esta no ar
        $host="localhost";
        $usuario="root";
        $senha="";
        $nomedobanco="locadora";

    //criando a conexão
    $conexao=mysqli_connect($host, $usuario, $senha, $nomedobanco);
    //validação
    if(!$conexao){
        print("Ocorreu uma falha de conexão com o banco de dados, favor contate o administrador");
    }
?>