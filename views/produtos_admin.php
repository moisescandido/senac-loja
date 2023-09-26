<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Gerenciar produtos</title>
</head>

<body>
    <?php
    include("../db/produto_db.php");
    $banco = new Produtos();
    $todos_produtos = $banco->todos_produtos();

    echo '
    <table class="table">
        <thead>
            <tr>
                <th>nome</th>
                <th>valor</th>
                <th>descricao</th>
                <th>categoria</th>
                <th>acao</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($todos_produtos as $item) {
        echo '
        <tr>
            <td>' . $item['nome'] . '</td>
            <td>' . $item['valor'] . '</td>
            <td>' . $item['descricao'] . '</td>
            <td>' . $item['categoria'] . '</td>
            <td>
            <a href="./produto.php?produto=' . $item['nome'] . '"class="btn btn-dark my-2 my-sm-0">Modificar</a>
            </td>
        </tr>';
    }

    echo '
        </tbody>
    </table>';

    echo '
        <script>
            function teste(){
                alert("Olá, mundo!");
            }
        </script>
    ';
    ?>
    <?php

    ?>
</body>

</html>