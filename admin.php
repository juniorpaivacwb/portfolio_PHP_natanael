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
    <p class="menu" style="text-align: left; margin-top: -70px;">
        <a href="cadnewprod.php"><i class="fa fa-shopping-cart"></i> Cadastro de Filmes</a>
    </p>
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
            //conexão com o banco de dados
            include_once("conecta.php");
                                 
            if($_GET){
                $pagina=$_GET["pag"];
            }else{
                $pagina=1;
            }
                                 
            //definindo a quantidade de produtos que aparece por página
            $limite=8;
                                 
            //determinar a posição do produto na nova página
            $inicio=$pagina*$limite-$limite;
            
            //buscar os dados no banco para serem listados
            $dados=mysqli_query($conexao, "SELECT * FROM produtos ORDER BY id DESC LIMIT $inicio, $limite");
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
                                     
                    <td class="iconedit"><a href="#"><i class="fa fa-edit"></i></a></td> <!--direcionar para uma pagina que permita alterar os dados do filme-->
                    
                    <?php if($_SESSION["nivel"] == "master"){ ?>
                        <td class="iconedit"><a href="#""><i class="fa fa-trash"></i></a></td><!--chamar função js confirmando a exclusão e excluir em caso de sim-->
                    <?php } ?>
                </tr>
            <?php } ?>
            <tr align="center">
                <td colspan="9">
                    <hr>
                    <?php
                        //buscar todos os dados da tabela de produtos para uma contagem da quantidade de produtos cadastrados
                        $pegadados=mysqli_query($conexao, "SELECT * FROM produtos");
                                 
                        //contando quantos cadastros tem
                        $total=mysqli_num_rows($pegadados);
                                 
                        //descobrir quantas páginas serão geradas
                        $totalpg=ceil($total/$limite);//o comando CEIL arredonda o resultado com virgula para o primeiro valor inteiro acima
                                 
                        $anterior=$pagina-1;
                        $proximo=$pagina+1;
                                 
                        if($pagina > 1){
                            print("<a href='admin.php?pag=1' title='Início' class='iconpg'><i class='fa fa-backward'></i></a>");
                            print("<a href='admin.php?pag=$anterior' title='Voltar' class='iconpg'><i class='fa fa-step-backward'></i></a>");
                        }
                        print("<strong><big>".$pagina." de ".$totalpg."</big></strong>");
                                 
                        if($pagina < $totalpg){
                            print("<a href='admin.php?pag=$proximo' title='Próximo' class='iconpg'><i class='fa fa-step-forward'></i></a>");
                            print("<a href='admin.php?pag=$totalpg' title='Último' class='iconpg'><i class='fa fa-forward'></i></a>");
                        }
                    ?>
                </td>
            </tr>
    </table>
</body>
</html>
<?php
}else{
    $erro=md5(2);
    header("location:index.php?e=$erro");
}
?>