<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Login</title>
</head>

<body>
  <section class="p-5">
    <h1>Login</h1>

    <form method="post">
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
      <button name="enviar" type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <p><a href="./cadastro.php" class="link-offset-2 link-underline link-underline-opacity-0" href="#">Cadastrar</a></p>
  </section>

  <?php
  if (isset($_POST["enviar"])) {
    include("../db/usuario_db.php");

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $banco = new Usuario();

    try {
      $resultado = $banco->login($email, $senha);

      if (!empty($resultado)) {
        session_start();
        $_SESSION["nome"] = $resultado['nome'];
        $_SESSION["id_funcao"] = $resultado['id_funcao'];
        header("Location: ./home.php");
        exit;
      } else {
        header("Location: ./cadastro.php");
        exit;
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
  ?>
</body>

</html>