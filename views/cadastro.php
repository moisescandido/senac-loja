<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Cadastro</title>
</head>

<body>
  <section class="p-5">
    <h1>Cadastro</h1>

    <form method="post">
      <div class="form-group">
        <label for="exampleInputEmail1">Nome</label>
        <input name="nome" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
          placeholder="Digite um nome">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
          placeholder="Digite um email">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Senha</label>
        <input name="senha" type="password" class="form-control" id="exampleInputPassword1"
          placeholder="Digite uma senha">
      </div>
      <button name="enviar" type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
  </section>

  <?php
  if (isset($_POST["enviar"])) {
    include("../db/usuario_db.php");

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $banco = new Usuario();

    try {
      $nome = str_replace(array(' ', '\t', '\n', '\r', '\0', '\x0B'), '', $nome);

      $banco->criar($nome, $email, $senha);
      header("Location: ./login.php");
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
  ?>
</body>

</html>