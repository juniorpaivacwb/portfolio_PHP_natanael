<?php
    session_start();
    if(isset($_SESSION["user"])){
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Locadora Crown - Área Administrativa</title>
<link href="../css/estilo.css" rel="stylesheet">
<link href="../imagens/logos/logoicon.png" rel="icon">
<link href="../font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script src="../js/script.js"></script>
</head>

<body>
    <?php include_once("nav.php"); ?>
    <center>
        <h3 style="margin: 2%;">Cadastro de Novos Clientes</h3>
        <form name="formuser" method="post" action="gravanewuser.php" style="width: 40%;" class="formulario">
            <input type="text" name="fnome" required placeholder="Nome do Usuário" class="campo">
            <input type="text" name="fcpf" required placeholder="CPF" class="campo" maxlength="14" onKeyPress="mascara(this, modelocpf)">
            <input type="tel" name="fcel" placeholder="Tel. Celular" required class="campo" onKeyPress="mascara(this, modelofonecel)" maxlength="15">
	    <input type="text" name="fcep" placeholder="CEP" required class="campo" maxlength="9" onKeyPress="mascara(this, modelocep)" onBlur="buscacep(this.value)">
            <input type="text" name="fend" placeholder="Endereço" required class="campo" readonly>
            <input type="text" name="fnum" placeholder="Nº" required class="campo">
            <input type="text" name="fcomp" placeholder="Complemento" class="campo">
            <input type="text" name="fbairro" placeholder="Bairro" required readonly class="campo">
            <input type="text" name="fcidade" placeholder="Cidade" required  readonly class="campo">
            <input type="text" name="fuf" placeholder="UF" required class="campo" readonly>
            <input type="submit" value="Salvar" class="botao">
        </form>
        <br><br><br>
        <hr>
        <br><br><br>
        <table width="90%" class="linhas" cellpadding="15" style="border: 2px solid #999999;">
            <tr>
                <td><strong>Código</strong></td>
                <td><strong>Nome</strong></td>
                <td><strong>CPF</strong></td>
                <td><strong>Celular</strong></td>                
                <td><strong>CEP</strong></td>
                <td><strong>Endereço</strong></td>

            </tr>
	    <hr>           
            <h3 style="margin: 2%;">Clientes Cadastrados</h3>        
                   
	    <?php
	    //conexão com o banco de dados
                include_once("conecta.php");
                                 
                //buscar os usuários cadastrados no banco
                $dados=mysqli_query($conexao, "SELECT * FROM clientes ORDER BY id DESC");
                                 
                //loop para listar todos os usuários
                while($item=mysqli_fetch_array($dados)){ ?>
                    <tr>
                        <td><?=$item["id"]?></td>
                        <td><?=$item["nome"]?></td>
                        <td><?=$item["cpf"]?></td>
			<td><?=$item["celular"]?></td>
			<td><?=$item["cep"]?></td>
			<td><?=$item["endereco"]?></td>
                        <td width="10" class="iconedit"><a href="editauser.php?id=<?=$item["id"]?>"><i class="fa fa-edit"></i></a></td>
                        <td width="10" class="iconedit"><a href="#" onClick="validauser('<?=$item["id"]?>')"><i class="fa fa-trash"></i></a></td>
                    </tr>
                <?php } ?>
        </table>
        <br><br><br><br><br><br>
    </center>
</body>
</html>
<?php
}else{
    $erro=md5(2);
    header("location:index.php?e=$erro");
}
?>