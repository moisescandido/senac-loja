<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Home</title>
</head>

<body>
    <?php
    session_start();

    if (!$_SESSION['nome']) {
        header("Location: ./login.php");
        exit;
    } else {
        echo '
        <nav class="navbar navbar-light bg-light">
<a href="./home.php"class="navbar-brand">Home</a>
<a href="usuario.php?usuario=' . $_SESSION['nome'] . '"class="btn btn-outline-success my-2 my-sm-0" type="submit">' . $_SESSION['nome'] . '</a>
<a href="./sair.php"class="btn btn-outline-success my-2 my-sm-0" type="submit">Sair</a>
</nav>';
        echo '
<div class="container mt-4">
<div class="row">
    <div class="card-deck mb-3 text-center">';

        include("../db/produto_db.php");
        $produtos = new Produtos();
        $resultados = $produtos->todos_produtos();

        foreach ($resultados as $item) {
            echo '<div class="col-md-4">';
    
            echo '<div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">' . $item["nome"] . '</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">' . $item['valor'] . '<small class="text-muted">reais</small></h1>
                    
                    <ul class="list-unstyled mt-3 mb-4">';

            $vantagens = $produtos->vantagens($item['id']);
            foreach ($vantagens as $vtg) {
                echo '<li>' . $vtg['vantagem'] . '</li>';
            }

            echo '</ul>'; 
            echo $item['descricao'];
            echo '<a href="./produto.php?produto=' . $item['nome'] . '"class="btn btn-lg btn-block btn-primary">Comprar</a>
                </div>
            </div>';

            echo '</div>';
        }
        echo '
    </div>
</div>
</div>';

    }
    ?>
</body>

</html>