<?php
class Produtos
{
   public function todos_produtos()
   {
      $usuario = "root";
      $senha_banco = "";
      $conexao = "mysql:host=localhost;dbname=loja";

      $pdo = new PDO($conexao, $usuario, $senha_banco);

      $query = $pdo->prepare("SELECT p.id, p.nome, p.valor, p.descricao, c.nome as categoria FROM produtos as p INNER JOIN categorias_produtos c ON c.id = p.id_categoria");

      $query->execute();

      return $query->fetchAll(PDO::FETCH_ASSOC);
   }
   public function vantagens(string $id)
   {
      $usuario = "root";
      $senha_banco = "";
      $conexao = "mysql:host=localhost;dbname=loja";

      $pdo = new PDO($conexao, $usuario, $senha_banco);

      $query = $pdo->prepare("SELECT vantagem FROM vantagens_produtos where id = :id");
      $query->bindParam("id", $id, PDO::PARAM_STR);


      $query->execute();

      return $query->fetchAll(PDO::FETCH_ASSOC);
   }
   public function nome_produto(string $nome)
   {
      $usuario = "root";
      $senha_banco = "";
      $conexao = "mysql:host=localhost;dbname=loja";

      $pdo = new PDO($conexao, $usuario, $senha_banco);

      $query = $pdo->prepare("SELECT p.id, p.url_imagem, p.nome, p.valor, p.descricao, c.nome as categoria 
      FROM produtos as p 
      INNER JOIN categorias_produtos as c 
      ON c.id = p.id_categoria 
      and p.nome = :nome || p.id = :nome GROUP BY p.id;");
      $query->bindParam("nome", $nome, PDO::PARAM_STR);
      $query->execute();

      return $query->fetch(PDO::FETCH_ASSOC);
   }
   public function excluir_produto(string $id)
   {
      $usuario = "root";
      $senha_banco = "";
      $conexao = "mysql:host=localhost;dbname=loja";

      $pdo = new PDO($conexao, $usuario, $senha_banco);

      $query = $pdo->prepare("DELETE FROM produtos WHERE id= :id");
      $query->bindParam("id", $id, PDO::PARAM_INT);
      $query->execute();
   }
   public function categorias()
   {
      $usuario = "root";
      $senha_banco = "";
      $conexao = "mysql:host=localhost;dbname=loja";

      $pdo = new PDO($conexao, $usuario, $senha_banco);

      $query = $pdo->prepare("SELECT * FROM categorias_produtos");

      $query->execute();

      return $query->fetchAll(PDO::FETCH_ASSOC);
   }
   public function carrinho($string id_usuario){
      $usuario = "root";
      $senha_banco = "";
      $conexao = "mysql:host=localhost;dbname=loja";

      $pdo = new PDO($conexao, $usuario, $senha_banco);

      $query = $pdo->prepare("SELECT p.nome, p.valor FROM produtos INNER JOIN carrinho_produtos");

      $query->execute();

      return $query->fetchAll(PDO::FETCH_ASSOC);
   }
   public function atualizar_produto(string $id, string $url, string $nome, string $descricao, string $valor, string $categoria)
   {
      $usuario = "root";
      $senha_banco = "";
      $conexao = "mysql:host=localhost;dbname=loja";

      $pdo = new PDO($conexao, $usuario, $senha_banco);

      $query = $pdo->prepare("UPDATE produtos SET nome = :nome, url_imagem = :url, descricao = :descricao, valor = :valor, id_categoria = :categoria WHERE id = :id");
      $query->bindParam("nome", $nome, PDO::PARAM_STR);
      $query->bindParam("url", $url, PDO::PARAM_STR);
      $query->bindParam("descricao", $descricao, PDO::PARAM_STR);
      $query->bindParam("valor", $valor, PDO::PARAM_STR);
      $query->bindParam("categoria", $categoria, PDO::PARAM_INT);
      $query->bindParam("id", $id, PDO::PARAM_INT);
      $query->execute();
   }
}
?>