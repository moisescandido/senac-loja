<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <?php
    session_start();

    $usuario = $_GET['usuario'];

    if (empty($usuario) || ($usuario !== $_SESSION['nome'] && $_SESSION['id_funcao'] !== 2 && $_SESSION['id_funcao'] === 3)) {
        header("Location: ./home.php");
        exit;
    }
    echo '<nav class="navbar navbar-light bg-light">
<a href="./home.php"class="navbar-brand">Home</a>
<a href="usuario.php?usuario=' . $_SESSION['nome'] . '"class="btn btn-outline-success my-2 my-sm-0" type="submit">' . $_SESSION['nome'] . '</a>
<a href="./sair.php type="submit">Sair</a>
</nav>'; ?>
    <section class="p-5">
        <h1>
            <?php
            echo $usuario ?>
        </h1>
        <form method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Nome</label>
                <input name="nome" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Digite um nome">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Digite um email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Senha</label>
                <input name="senha" type="password" class="form-control" id="exampleInputPassword1"
                    placeholder="Digite uma senha">
            </div>
            <button name="enviar" type="submit" class="btn btn-primary">Alterar</button>
            <button name="deletar" type="submit" class="btn btn-danger">Excluir</button>
            <?php
            if ($_SESSION['id_funcao'] === 2 || $_SESSION['id_funcao'] === 3) {
                echo '<a href="./admin.php " name="admin" type="submit" class="btn btn-success">Admin</a>';
            }
            ?>

        </form>
    </section>
    <hr>
    <section>
        <?php
        include("../db/produto_db.php");
        $banco = new Produtos();
        $carrinho = $banco->produtos_carrinho($usuario);

        if (empty($carrinho)) {
            echo '<h1>Carrinho vazio</h1>';
        } else {
            foreach ($carrinho as $item) {
                echo '
            <form class="ms-3 d-flex mb-3">
            <div class="col-md-1">
                <img src="../img/' . $item['url_imagem'] . '" class="img-fluid" alt="Imagem do Produto">
            </div>
            <div>
                <h5>' . $item['valor'] . '</h5>
                <p class="large mb-0">' . $item['nome'] . '</p>
                <button class="btn btn-danger">
                    Excluir
                </button>
            </div>
            </form>
            ';
            }
        }
        ?>
    </section>
    <?php

    if (isset($_POST["enviar"])) {
        include("../db/usuario_db.php");

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        try {
            $banco = new Usuario();
            $usuario_banco = $banco->dados_usuario($usuario);

            if (empty($nome)) {
                $nome = $usuario_banco['nome'];
            }
            if (empty($email)) {
                $email = $usuario_banco['email'];
            }
            if (empty($senha)) {
                $senha = $usuario_banco['senha'];
            }

            $banco->atualizar_usuario($nome, $email, $senha, $usuario_banco['nome']);

            if ($_SESSION['id_funcao'] !== 2 && $_SESSION['nome'] == $usuario) {
                $_SESSION['nome'] = $nome;
            }
            header("Location: ./home.php");
            exit;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    if (isset($_POST["deletar"])) {
        include("../db/usuario_db.php");

        $banco = new Usuario();

        try {
            $banco->delete_usuario($_SESSION['nome']);
            session_destroy();
            header("Location: ./login.php");
            exit;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    ?>
</body>

</html>