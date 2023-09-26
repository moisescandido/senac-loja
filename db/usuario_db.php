<?php
class Usuario
{
   public function criar(string $nome, string $email, string $senha_usuario)
   {
      $usuario = "root";
      $senha_banco = "";
      $conexao = "mysql:host=localhost;dbname=loja";

      $pdo = new PDO($conexao, $usuario, $senha_banco);

      $query = $pdo->prepare("INSERT INTO usuarios(id_funcao, nome,email, senha) VALUES (1, :nome, :email, :senha)");
      $query->bindParam("nome", $nome, PDO::PARAM_STR);
      $query->bindParam("email", $email, PDO::PARAM_STR);
      $query->bindParam("senha", $senha_usuario, PDO::PARAM_STR);

      $query->execute();
   }
   public function login(string $email, string $senha_usuario)
   {
      $usuario = "root";
      $senha_banco = "";
      $conexao = "mysql:host=localhost;dbname=loja";

      $pdo = new PDO($conexao, $usuario, $senha_banco);

      $query = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
      $query->bindParam("email", $email, PDO::PARAM_STR);
      $query->bindParam("senha", $senha_usuario, PDO::PARAM_STR);

      $query->execute();
      $array_usuarios = $query->fetch(PDO::FETCH_ASSOC);

      return $array_usuarios;
   }
   public function dados_usuario(string $nome)
   {
      $usuario = "root";
      $senha_banco = "";
      $conexao = "mysql:host=localhost;dbname=loja";

      $pdo = new PDO($conexao, $usuario, $senha_banco);

      $query = $pdo->prepare("SELECT nome, email, senha FROM usuarios WHERE nome = :nome");
      $query->bindParam("nome", $nome, PDO::PARAM_STR);

      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);

   }
   public function atualizar_usuario(string $nome, string $email, string $senha, string $nome_antigo)
   {
      $usuario = "root";
      $senha_banco = "";
      $conexao = "mysql:host=localhost;dbname=loja";

      $pdo = new PDO($conexao, $usuario, $senha_banco);

      $query = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE nome = :antigo");
      $query->bindParam("nome", $nome, PDO::PARAM_STR);
      $query->bindParam("email", $email, PDO::PARAM_STR);
      $query->bindParam("senha", $senha, PDO::PARAM_STR);
      $query->bindParam("antigo", $nome_antigo, PDO::PARAM_STR);
      $query->execute();
   }
   public function delete_usuario(string $nome)
   {
      $usuario = "root";
      $senha_banco = "";
      $conexao = "mysql:host=localhost;dbname=loja";

      $pdo = new PDO($conexao, $usuario, $senha_banco);

      $query = $pdo->prepare("DELETE FROM usuarios WHERE nome = :nome");
      $query->bindParam("nome", $nome, PDO::PARAM_STR);

      $query->execute();
   }
   public function todos_usuario()
   {
      $usuario = "root";
      $senha_banco = "";
      $conexao = "mysql:host=localhost;dbname=loja";

      $pdo = new PDO($conexao, $usuario, $senha_banco);

      $query = $pdo->prepare("SELECT f.nome as funcao, u.nome, u.email, u.senha FROM usuarios as u INNER JOIN funcao_usuarios as f ON u.id_funcao = f.id;");

      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
   }
}
?>