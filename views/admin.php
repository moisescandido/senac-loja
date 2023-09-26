<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Adminstrador</title>
</head>

<body>
    <?php
    session_start();

    if ($_SESSION['id_funcao'] !== 2 && $_SESSION['id_funcao'] !== 3) {
        header("Location: ./home.php");
        exit;
    }
    echo '<nav class="navbar navbar-light bg-light">
    <a href="./home.php"class="navbar-brand">Home</a>
    <a href="usuario.php?usuario=' . $_SESSION['nome'] . '"class="btn btn-outline-success my-2 my-sm-0" type="submit">' . $_SESSION['nome'] . '</a>
    <a href="./sair.php""class="btn btn-outline-success my-2 my-sm-0" type="submit">Sair</a>
    </nav>';
    ?>

    <form method="get" class="d-flex justify-content-center mt-4 mb-4">
        <?php if ($_SESSION['id_funcao'] === 2) {
            echo '<button name="usuarios" type="submit" class="btn btn-outline-secondary btn-lg">Usuários</button>';
        } ?>
        <button name="produtos" type="submit" class="btn btn-outline-secondary btn-lg">Produtos</button>
    </form>

    <?php
    if (isset($_GET['usuarios']) && $_SESSION['id_funcao'] === 2) {
        include("./usuarios_admin.php");
    }
    if (isset($_GET['produtos'])) {
        include("./produtos_admin.php");
    }
    ?>
</body>

</html>