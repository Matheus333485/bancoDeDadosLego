<?php
include 'conexao.php';

$id = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_POST) {
    $nome = $_POST['nome'];
    $pecas = $_POST['pecas'];
    $preco = $_POST['preco'];
    $loja = $_POST['loja'];

    $sql = "UPDATE produtos SET 
            nome='$nome',
            qtd_pecas='$pecas',
            preco='$preco',
            loja='$loja'
            WHERE id=$id";

    $conn->query($sql);
    header("Location: index.php");
}
?>

<form method="POST">
    Nome: <input type="text" name="nome" value="<?php echo $row['nome']; ?>"><br>
    Peças: <input type="number" name="pecas" value="<?php echo $row['qtd_pecas']; ?>"><br>
    Preço: <input type="text" name="preco" value="<?php echo $row['preco']; ?>"><br>
    Loja: <input type="text" name="loja" value="<?php echo $row['loja']; ?>"><br>
    <button type="submit">Atualizar</button>
</form>