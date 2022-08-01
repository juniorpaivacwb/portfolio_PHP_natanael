<?php
session_start();
if(isset($_SESSION["user"])){
$recinfo="";
$recmensagem="";
  if($_GET){
  $recinfo=$_GET["info"];
  }
  if($recinfo==1){
  $recmensagem="Entre com um código de cliente válido"; 
  }
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
        <h3 style="margin: 2%;">Controle de Entrega/Devolução por Cliente</h3>
        <?php
	if(isset($_SESSION["cliente"])){ 
  	 	$codcliente=$_SESSION["codcliente"]
	 	?>
	 	<h4 style="color:#ff0000;"><?=$_SESSION["cliente"]?></h4>
	 	<h4 style="color:#ff0000;">Código do Cliente:  <?=$_SESSION["codcliente"]?></h4>
                <br>
		<h4 style="color:#ff4500;"><a href="#">Alterar Cliente</h4></a> <!--criar um php que encerre a sessão Cliente e envie para a pagina de definicão de cliente novamente-->
	 	<br><br><br>
         	<hr>
         	<br><br><br>
         	<h3 style="margin: 2%;">Filmes locados por <?=$_SESSION["cliente"]?> </h3>
	 	<table width="90%" class="linhas" cellpadding="15" style="border: 2px solid #999999;">
            	<tr>
                <td><strong>Código</strong></td>
                <td><strong>Filme</strong></td>
		<td><strong>Status</strong></td>
                <td><strong>Data retirada</strong></td>
                <td><strong>Data dev.</strong></td>
                <td><strong>Valor da locação</strong></td>                
                <td><strong>Dias Atraso</strong></td>
                <td><strong>Multa dia</strong></td>
                <td><strong>Total a pagar</strong></td>
	        </tr>
                <?php
	    	$valorlanc=8; // para implantar o sistema teria que criar uma tabela para que o administrador fosse capaz de editar valores de filmes e multas e os mesmos virem direto do BD.
	   	$valorcat=5; 
                //conexão com o banco de dados
                include_once("conecta.php");
                $dados=mysqli_query($conexao, "SELECT * FROM locacoes WHERE idlocador=$codcliente ORDER BY id DESC");
                               
                	while($item=mysqli_fetch_array($dados)){ ?>
                    		<tr>
                        	<td><?=$item["idfilme"]?></td>
                        	<td><?=$item["filme"]?></td>
     		        	<?php
		        	$recstatus=$item["statusfilme"];
		         		if ($recstatus == "lanc"){
		         			$statusfilme="Lançamento";
		         			$valorfilme=$valorlanc;
			 			$multadiaria=8;
                         		}else {
                         		$statusfilme="Catálogo";
		         		$valorfilme=$valorcat;	
			 		$multadiaria=5;
                        		}
				$recdataretirada=$item["dataretir"]; //num projeto real converter as datas para o padrão brasileiro antes de mostrar, considerar ainda horario limite de devolução, nesse código somente calcula dias
				$recdatadevolucao=$item["datadev"];
				$hoje= date('Y-m-d');
				$diferenca =  strtotime($hoje) - strtotime($recdatadevolucao);
				$dias = floor($diferenca / (60 * 60 * 24)); 
				$totalpagar=$valorfilme+($dias*$multadiaria)	
		       		?>
                        	<td><?=$statusfilme?></td>
				<td><?=$item["dataretir"]?></td>
				<td><?=$item["datadev"]?></td>
				<td><?="R$ ".$valorfilme.",00"?></td>
				<td><?=$dias?></td>
				<td><?="R$ ".$multadiaria.",00"?></td>
				<td><?="R$ ".$totalpagar.",00" ?></td>
   	                     	<td width="10"><a href="#">Registrar devolução</a></td> <!--esse link precisa regitrar o valor recebido numa tabela de faturamentos, bem como permitir registro de pagamentos parciais em tabela apropriada para cobrança de saldo posterior. ao clicar registra na tabela faturamento e gera recibo para impressão-->
             		       </tr>
            		<?php }  ?>
        		</table>
		        <br><br><br>
			<center>
			<hr>
		        <h3 style="margin: 2%;">Adicionar Filme para Cliente - Retirada</h3>
	                <form name="buscafilme" method="post" action="addfilme.php" style="width: 40%;" class="formulario">
            		<input type="text" name="fid" required placeholder="Entre com o código do filme que está no DVD" class="campo">
	    		<input type="submit" value="Buscar" class="botao">        
			</form>
        		<br><br><br><br><br><br>
    			</center>
	 <?php }else { ?>
        	<form name="formuser" method="post" action="logacliente.php" style="width: 40%;" class="formulario">
            	<input type="text" name="fid" required placeholder="Código do cliente" class="campo">
	    	<input type="submit" value="Buscar" class="botao">        
        	<?php print $recmensagem;?>        
		</form>
        <?php } ?>
        </body>

<?php
}else{
    $erro=md5(2);
    header("location:index.php?e=$erro");
}
?>
</html>