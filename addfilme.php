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
    <?php 
    include_once("nav.php"); 
    $recfilme=$_POST["fid"];
    include_once("conecta.php");
    $dados=mysqli_query($conexao, "SELECT * FROM produtos WHERE id=$recfilme AND disponivel!=2 "); //num sistema real atentar para sempre que colocar p numero 2 na coluna 'disponível' após alugar o filme para algum cliente
    if(mysqli_num_rows($dados) > 0){ ?>
    	    <table width="100%" cellpadding="10" cellspacing="0" class="linhas">
            <tr align="center" height="40">
            <td><strong>Foto</strong></td>
            <td><strong>Código</strong></td>
	    <td><strong>Filme</strong></td>
	    <td><strong>Prateleira</strong></td>
	    <td><strong>Status</strong></td>            
	    <td><strong>Valor</strong></td>
	    <td><strong>Categoria(s)</strong></td>
            <td><strong>Descrição</strong></td>
            </tr>
            <?php
            $valorlanc="R$ 8,00"; // para implantar o sistema teria que criar uma tabela para que o administrador fosse capaz de editar valores de filmes e multas e os mesmos virem direto do BD.
	    $valorcat="R$ 5,00";                     
                    while($item=mysqli_fetch_array($dados)){ ?>
                    <tr>
                    <td align="center" width="5%">
                    <img src="../produtos/<?=$item['foto']?>" width="50">
                    </td>
                    <td align="center" width="3%"><?=$item["id"]?></td>
		    <td align="center" width="18%"><?=$item["produto"]?></td>
		    <td align="center" width="5%"><?=$item["prateleira"]?></td>
   	            <?php
		    $recstatus=$item["status"];
		    if ($recstatus == "lanc"){
		    $statusfilme="Lançamento";
		    $valorfilme=$valorlanc;
                    }else {
                    $statusfilme="Catálogo";
		    $valorfilme=$valorcat;	
                    }   ?>
		    <td align="center" width="5%"><?=$statusfilme?> </td>                                        
                    <td width="10%" align="center"> <?=$valorfilme?></td>
                    <td align="center" width="18%"><?=$item["categoria"]?></td>
   	            <td align="center" width="18%"><?=$item["descri"]?></td>
                    <td><a href="#">Adicionar Filme para Usuário</a><td><!--num projeto real esse link inclui esse filme na tabela "locacoes" com os dados do filme e do cliente e colocar "nao" na coluna disponivel do filme em questão na tabela produtos-->
                    </tr>
	    

            <?php }
	}else{
        print("<center><h3>Nenhum filme encontrado! Favor preencher o código abaixo corretamente e tentar novamente!</h3><br><br>"); ?>
	<form name="buscafilme" method="post" action="addfilme.php" style="width: 40%;" class="formulario">
        <input type="text" name="fid" required placeholder="Entre com o código do filme que está no DVD" class="campo">
	<input type="submit" value="Buscar" class="botao">        
	</form>
	</center>
        <?php
	}

	?>
    </table>
</body>
</html>
<?php
}else{
    $erro=md5(2);
    header("location:index.php?e=$erro");
}
?>