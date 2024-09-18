<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style/consulta.css">
        <title> Coffee Shop | Consulta</title>
    </head>
    <body>
        <header>
            <img src="assets/coffee.gif" alt="">        
        </header>
    </body>
</html>

<?php
    include("database/conexaoBD.php");

    $stmt = $pdo->prepare("select * from coffee");
    try {
        //buscando dados
        $stmt->execute();

        echo "<section>";
            echo "<div>";
            echo "<form method='post'>";
            echo "<input type='text' size='5' name='id' placeholder='id'>";
            echo "<input type='submit' value='Consultar'>";
            echo "</form>";
            echo "</div>";
            echo "<h2>Menu</h2>";

        while ($row = $stmt->fetch()) {
            echo "<div class='item'>";
                echo "<div class='top'>";
                    echo "<div class='text-left'>";
                    echo "<p>" . $row['id'] .  ". " . $row['title'] . "</p>";
                    echo "</div>";
                    echo "<div class='text-right'>";
                    echo "<p> R$ " . $row['price'] . "</p>";
                    echo "</div>";
                echo "</div>";    
                echo "<div class='desc'>";
                    echo "<p>" . $row['description'] . "</p>";
                echo "</div>";
            echo "</div>";
        }
        echo "</section>";
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }


     if ($_SERVER["REQUEST_METHOD"] === 'POST') {

         if (isset($_POST["ra"]) && ($_POST["ra"] != "")) {
             $ra = $_POST["ra"];
             $stmt = $pdo->prepare("select * from coffee 
             where id= :id order by title");
             $stmt->bindParam(':id', $id);
         } else {
             $stmt = $pdo->prepare("select * from coffee 
             order by id");
         }

         try {
             //buscando dados
             $stmt->execute();

             echo "<form method='post'>";
             echo "<table border='1px' cellspacing='0'>";
             echo "<tr>";
             echo "<th></th>";
             echo "<th>RA</th>";
             echo "<th>Nome</th>";
             echo "<th>Curso</th>";
             echo "</tr>";

             while ($row = $stmt->fetch()) {
                 echo "<tr>";
                 echo "<td><input type='radio' name='raAluno' 
                      value='" . $row['ra'] . "'></td>";

                 echo "<td>" . $row['ra'] . "</td>";
                 echo "<td>" . $row['nome'] . "</td>";
                 echo "<td>" . $row['curso'] . "</td>";
                 echo "</tr>";
             }

             echo "</table><br>
                       
             <button type='submit' formaction='remove.php'>Excluir Aluno</button>
             <button type='submit' formaction='edicao.php'>Editar Aluno</button>
             
             </form>";


         } catch (PDOException $e) {
             echo 'Error: ' . $e->getMessage();
         }

         $pdo = null;
     }
?>
