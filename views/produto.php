<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Produto</title>
</head>

<body>
    <?php
    session_start();
    echo '
    <nav class="navbar navbar-light bg-light">
        <a href="./home.php" class="navbar-brand">Home</a>
        <a href="usuario.php?usuario=' . $_SESSION['nome'] . '" class="btn btn-outline-success my-2 my-sm-0" type="submit">' . $_SESSION['nome'] . '</a>
        <a href="./sair.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">Sair</a>
    </nav>';
    if (!isset($_GET['produto'])) {
        echo 'Nada encontrado!';
    } else {
        $nome_produto = $_GET['produto'];

        include("../db/produto_db.php");
        $banco = new Produtos();
        $informacoes_produto = $banco->nome_produto($nome_produto);

        echo '
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img src="../img/' . $informacoes_produto['url_imagem'] . '" class="img-fluid" alt="Imagem do Produto">
                </div>
                <div class="col-md-8">
                    <div>
                        <h2>' . $informacoes_produto['nome'] . '</h2>
                        <p><strong>Valor:</strong> R$ ' . $informacoes_produto['valor'] . '</p>
                        <p><strong>Descrição:</strong> ' . $informacoes_produto['descricao'] . '</p>
                        <p><strong>Categoria:</strong> ' . $informacoes_produto['categoria'] . '</p>
                        <a class="btn btn-lg btn-success">Comprar</a>
                    </div>
                    <br>';
        if ($_SESSION['id_funcao'] === 2 || $_SESSION['id_funcao'] === 3) {
            echo '<form method="post">
                        <div class="form-group">
                            <label for="url">Url</label>
                            <input name="url" type="text" class="form-control" id="url" aria-describedby="emailHelp"
                                placeholder="Nome da imagem">
                        </div>
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input name="nome" type="text" class="form-control" id="nome" aria-describedby="emailHelp"
                                placeholder="Nome do produto">
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <input name="descricao" type="text" class="form-control" id="descricao"
                                placeholder="Descrição do produto">
                        </div>
                        <div class="form-group">
                            <label for="valor">Valor</label>
                            <input name="valor" type="text" class="form-control" id="valor"
                                placeholder="Valor do produto">
                        </div>
                        <div class="form-group">
                            <label>Categorias</label>';

            $categorias = $banco->categorias();
            echo '<select class="form-select" name="categoria">
            <option selected>Selecionar categorias</option>';

            foreach ($categorias as $item) {
                echo '<option value="' . $item['id'] . '">' . $item['nome'] . '</option>';
            }

            echo '</select>
                        </div>
                        <button name="atualizar" type="submit" class="btn btn-primary" value="' . $informacoes_produto['id'] . '">Alterar</button>
                    </form>
                </div>
            </div>
        </div>';
        }
    }

    if (isset($_POST['enviar'])) {
        include("../db/produto_db.php");
        $banco = new Produtos();
        $produto = $banco->nome_produto($_POST['nome']);
    }

    if (isset($_POST['atualizar'])) {
        $id = $_POST['atualizar'];
        $url = $_POST['url'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $valor = $_POST['valor'];
        $categoria = $_POST['categoria'];
        $produto_banco = $banco->nome_produto($_POST['atualizar']);

        if (empty($url)) {
            $url = $produto_banco['url_imagem'];
        }
        if (empty($nome)) {
            $nome = $produto_banco['nome'];
        }
        if (empty($descricao)) {
            $descricao = $produto_banco['descricao'];
        }
        if (empty($valor)) {
            $valor = $produto_banco['valor'];
        }
        if (empty($categoria)) {
            $categoria = $produto_banco['categoria'];
        }

        $banco->atualizar_produto($id, $url, $nome, $descricao, $valor, $categoria);
    }
    ?>
</body>

</html>