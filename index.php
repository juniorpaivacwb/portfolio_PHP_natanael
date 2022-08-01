<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Locadora Crown - Área Administrativa</title>
<link href="../imagens/logos/logoicon.png" rel="icon">
<link href="../css/estilo.css" rel="stylesheet">
</head>

<body>
    <img src="../imagens/logos/logo.png" alt="" width="120">
    <center>
        <h2>Área Administrativa</h2>
        <br><br><br><br>
        <h3>Acesso Restrito</h3><hr>
        <br><br><br><br><br><br><br>
        <h4>Favor entrar com usuário e senha</h4>
        <br>
	<h1>Vendpago - favor usar a palavra "master" no usuario e senha</h1>
        <form method="post" action="login.php" style="width: 20%">
            <input type="text" name="fuser" placeholder="Usuário" class="campo" required>
            <input type="password" name="fpass" placeholder="Senha" class="campo" required>
            <input type="submit" value="ENTRAR" class="botao">
        </form>
        <?php
            if($_GET){
                $recerro=$_GET["e"];
                if($recerro == md5(1)){
                    $resposta="Usuário e/ou Senha incorreto(s), favor tentar novamente";
                }else if($recerro == md5(2)){
                    $resposta="A página que esta tentando acessar é restrita, favor entrar com usuário e senha.";
                }
                print("<h3 style='color:#FF0000; margin-top:5%;'>".$resposta."</h3>");
            }
        ?>
    </center>
</body>
</html>

