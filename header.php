<header>
    <div class="slide">
        <?php
            //conexão com o banco de dados
            include_once("restrito/conecta.php");
        
            //buscar todos os banners no banco de dados
            $allbanners=mysqli_query($conexao, "SELECT * FROM banners ORDER BY id DESC");
        
            while($item=mysqli_fetch_array($allbanners)){ ?>
                <div>
                    <img src="imagens/banners/<?=$item["banner"]?>">
                </div>
            <?php } ?>
    </div>
</header>