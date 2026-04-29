<?php
include 'conexao.php';

if ($_POST) {
    $nome = $_POST['nome'];
    $pecas = $_POST['pecas'];
    $preco = $_POST['preco'];
    $loja = $_POST['loja'];

    $sql = "INSERT INTO produtos (nome, qtd_pecas, preco, loja)
            VALUES ('$nome', '$pecas', '$preco', '$loja')";

    $conn->query($sql);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Cadastrar Produto</title>

<style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family: Arial, sans-serif;
    }

    body{
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
    }

    .container{
        background:white;
        padding:40px;
        width:400px;
        border-radius:20px;
        box-shadow:0 10px 25px rgba(0,0,0,0.3);
    }

    h1{
        text-align:center;
        margin-bottom:25px;
        color:#1e3c72;
    }

    .input-group{
        margin-bottom:20px;
    }

    label{
        display:block;
        margin-bottom:8px;
        font-weight:bold;
        color:#333;
    }

    input{
        width:100%;
        padding:12px;
        border:2px solid #ccc;
        border-radius:10px;
        outline:none;
        transition:0.3s;
    }

    input:focus{
        border-color:#2a5298;
    }

    button{
        width:100%;
        padding:14px;
        border:none;
        border-radius:10px;
        background:#1e3c72;
        color:white;
        font-size:16px;
        cursor:pointer;
        transition:0.3s;
    }

    button:hover{
        background:#2a5298;
        transform:scale(1.02);
    }

</style>

</head>
<body>

<div class="container">

    <h1>Cadastrar LEGO</h1>

    <form method="POST">

        <div class="input-group">
            <label>Nome</label>
            <input type="text" name="nome" required>
        </div>

        <div class="input-group">
            <label>Quantidade de Peças</label>
            <input type="number" name="pecas" required>
        </div>

        <div class="input-group">
            <label>Preço</label>
            <input type="text" name="preco" required>
        </div>

        <div class="input-group">
            <label>Loja</label>
            <input type="text" name="loja" required>
        </div>

        <button type="submit">Salvar Produto</button>

    </form>

</div>

</body>
</html>