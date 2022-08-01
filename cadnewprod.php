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
        <h3 style="margin: 2%;">Cadastro de Novos Filmes</h3>
        <form method="post" action="gravanewprod.php" style="width: 40%;" class="formulario" enctype="multipart/form-data">
            <input type="text" name="fproduto" required placeholder="Título do Filme" class="campo">
            <input type="text" name="fprateleira" required placeholder="Localização / Prateleira" class="campo">            
	    <br><br>
            Status: &nbsp;&nbsp;
            <label><input type="radio" name="fstatus" required value="lanc"> Lançamento</label>&nbsp;&nbsp;&nbsp;
            <label><input type="radio" name="fstatus" required value="cat"> Catálogo</label>&nbsp;&nbsp;&nbsp;
            <br><br>
            <textarea name="fdescri" required placeholder="Descrição" class="campo" rows="10"></textarea>
            <br><br>
            <label>Categoria(s):</label>
	    <br><br>
            <label>Ação: <input type="checkbox" name="facao"></label>
            &nbsp;
            <label>Comédia: <input type="checkbox" name="fcom"></label>
            &nbsp;
	    <label>Infantil: <input type="checkbox" name="finf"></label>
            &nbsp;
            <label>Suspense: <input type="checkbox" name="fsus"></label>
	    &nbsp;            
	    <label>Terror: <input type="checkbox" name="fter"></label>
	    &nbsp;            
	    <label>Adulto: <input type="checkbox" name="fadult"></label>
            <br><br><br>
            <input type="file" name="ffoto" required class="campo">
            <input type="submit" value="Salvar" class="botao">
        </form>
    </center>
</body>
</html>
<?php
}else{
    $erro=md5(2);
    header("location:index.php?e=$erro");
}
?>