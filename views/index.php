<?php 

require_once "../util/mysqlpdo.php";

$refined = " ";

if (isset($_POST['pesquisa-btn']) && !empty($_POST['pesquisa'])) {
    $search = $_POST['pesquisa'];
    $refined = "where nome like '%$search%' or tipo1 like '%$search%' or tipo2 like '%$search%';";
}

$sql = "select * from tb_pokemons ".$refined;
$stmt = $conn -> prepare($sql);
$stmt->execute();
$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Pokédex</title>

        <link rel="icon" type="image/x-icon" href="../assets/images/pokebola/pokebola.ico">
        
        <link rel="stylesheet" href="../assets/css/header.css">
        <link rel="stylesheet" href="../assets/css/body.css">
        <link rel="stylesheet" href="../assets/css/poketypes.css">
        <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' >
    </head>

    <body>
        <header>
            <div class="headline">
                <img class = "pokesombra" src="../assets/images/pokebola/sombra.png" alt="">
                <img class = "pokebola" src="../assets/images/pokebola/pokebola.gif" alt="Nome">
                
                <span>
                    Pokédex
                </span>
            </div>

            <div class = "pesquisa-form">
                <form action = "#" method="POST">
                    <?php
                    if ($refined != " "){
                    ?>
                        <button type="submit" name = "pesquisa-btn" title="Voltar" id="pesquisa-btn-id">
                            <i class='bx bx-arrow-back bx-sm'></i> Voltar à página inicial
                        </button>
                    <?php 
                    }
                    ?>
                    <label for="pesquisa">
                        Pesquise um pokemon/tipo:
                    </label>
                    <input type="search" name="pesquisa" id="pesquisa-id" placeholder="Digite..">
                    <button type="submit" name = "pesquisa-btn" title="Pesquisar" id="pesquisa-btn-id">
                        <i class='bx bx-search-alt-2 bx-sm'></i>
                    </button>

                    
                </form>
            </div >

            
        </header>
        
        <div class="container">
            <?php
            if(!$rs){
            ?>
                <h1 class="erro">Não há resultados</h1>
            <?php
            }
            else{
                foreach ($rs as $key=>$value){
            ?>
            <div class="info">
                <img src=<?php echo 'data:image/png;base64,'.base64_encode( $value['img'] )?> alt="Imagem">

                <span class="number"><?php echo "#".$value["id"];?></span>
                
                <h1 class="name"><?php echo $value["nome"];?></h1>

                <br>
                
                <small class="type">
                    Tipo: 
                    <span class="<?php echo $value["tipo1"];?>"><?php echo $value["tipo1"];?></span>

                    <?php 
                    if (!empty ($value["tipo2"])){
                    ?>
                        <span class="<?php echo $value["tipo2"];?>"><?php echo $value["tipo2"];?></span>
                    <?php

                    }
                    ?>   
                </small>
            </div>

            <?php
                }
            }
            ?>
        </div>
        
    </body>
</html>