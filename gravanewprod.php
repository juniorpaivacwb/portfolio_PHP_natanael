<?php
    //recebendo os dados enviados pelo formulário de cadastro de produtos
    $recproduto=$_POST["fproduto"];
    $recprat=$_POST["fprateleira"];
    $recstatus=$_POST["fstatus"];
    $recdescri=$_POST["fdescri"];
    // alguns filmes podem ter mais que uma categoria então permite multi seleções
    $reccategorias="";
    if (isset($_POST["facao"])){$reccategorias="..acao..";}
    if (isset($_POST["fcom"])){$reccategorias=$reccategorias."..comedia..";}
    if (isset($_POST["finf"])){$reccategorias=$reccategorias."..infantil..";}
    if (isset($_POST["fsus"])){$reccategorias=$reccategorias."..suspense..";}
    if (isset($_POST["fter"])){$reccategorias=$reccategorias."..terror..";}
    if (isset($_POST["fadult"])){$reccategorias=$reccategorias."..adulto..";}
    $recfoto=$_FILES["ffoto"]["name"];

    //conexão com o banco de dados
    include_once("conecta.php");

    //renomeando os arquivos (fotos)
    $ext=pathinfo($recfoto, PATHINFO_EXTENSION);//comando para pegar a extensão do arquivo
    $data=date("d/m/Y");//comando para pegar a data atual no formato dd/mm/aaaa
    $hora=time();//comando para pegar a hora atual no formato hh/mm/ss/mm
    $novonome=md5($recfoto.$data.$hora).".".$ext;//novo nome da foto criptografando o nome com a data e hora e concatenando a extensão

    //envio do arquivo para uma pasta específica dentro do servidor (upload do arquivo)
    move_uploaded_file($_FILES["ffoto"]["tmp_name"], "../produtos/$novonome");


    //tirando ' apostrofo e " aspas dos campos
    $recproduto=str_replace("'", "", $recproduto);//removendo o apostrofo do recproduto
    $recprat=str_replace("'", "", $recprat);//removendo o apostrofo do recprat
    $recdescri=str_replace("'", "", $recdescri);//removendo o apostrofo do recdescri
    
    //gravando no banco de dados
    mysqli_query($conexao, "INSERT INTO produtos (produto, descri, status, foto, categoria, prateleira) VALUES ('$recproduto', '$recdescri', '$recstatus', '$novonome', '$reccategorias', '$recprat')");
    
    //redirecionamento
    header("location:admin.php");
?>

