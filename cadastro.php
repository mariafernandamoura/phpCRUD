<?php
    $warning = "";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/cadastro.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Document</title>
</head>
<body>
    <header>

    </header>
 
    <section>
            <a href="">
                <svg id="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path fill="#ffffff"
                    d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/>
                </svg>
            </a>
        <h2>Cadastro</h2>
        <form method="post">
            <input type="text" placeholder="Nome" name="name">
            <input type="text" placeholder="Descrição" name="description">
            <input type="text" placeholder="Preço" name="price">
            <div id="warning">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/></svg>
                <span><?=$msg?></span>
            </div>
            <input type="submit" value="Cadastrar">
        </form>
    </section>
</body>
</html>


<?php

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {

        try {            
            $name = $_POST["name"];
            $description = $_POST["description"];
            $price = $_POST["price"];
            if ((trim($name) == "") || (trim($price) == "")) {
                    $warning = "Preencha os campos obrigatórios";
            } else {
                include("conexaoBD.php");
                $stmt = $pdo->prepare("insert into coffee (title, description, price) values(:title, :description, :price)");
                $stmt->bindParam(':title', $name);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':price', $price);
                $stmt->execute();
            }
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        $pdo = null;
    }
?>

