<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Gerenciar usuários</title>
</head>

<body>
    <?php
    include("../db/usuario_db.php");
    $banco = new Usuario();
    $todos_usuarios = $banco->todos_usuario();

    echo '
    <table class="table">
        <thead>
            <tr>
                <th>funcao</th>
                <th>nome</th>
                <th>email</th>
                <th>senha</th>
                <th>acao</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($todos_usuarios as $item) {
        echo '
        <tr>
            <td>' . $item['funcao'] . '</td>
            <td>' . $item['nome'] . '</td>
            <td>' . $item['email'] . '</td>
            <td>' . $item['senha'] . '</td>
            <td>
            <a href="usuario.php?usuario=' . $item['nome'] . '"class="btn btn-dark my-2 my-sm-0" type="submit">Modificar</a>
            </td>
        </tr>';
    }

    echo '
        </tbody>
    </table>';

    if (isset($_POST['excluir'])) {
        $usuario_excluir = $_POST['excluir'];
        $banco->delete_usuario($usuario_excluir);
        header("./admin.php");
        exit;
    }
    ?>
</body>

</html>