<?php
include 'conexao.php';

$edit = false;

/* CRIAR */
if(isset($_POST['add'])){

    $nome = $_POST['nome'];
    $pecas = $_POST['pecas'];
    $preco = $_POST['preco'];
    $loja = $_POST['loja'];

    $conn->query("INSERT INTO produtos (nome, qtd_pecas, preco, loja)
    VALUES ('$nome','$pecas','$preco','$loja')");
}

/* EXCLUIR */
if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $conn->query("DELETE FROM produtos WHERE id=$id");

    header("Location: index.php");
}

/* EDITAR */
if(isset($_GET['edit'])){

    $id = $_GET['edit'];

    $edit = true;

    $resultEdit = $conn->query("SELECT * FROM produtos WHERE id=$id");

    $rowEdit = $resultEdit->fetch_assoc();
}

/* ATUALIZAR */
if(isset($_POST['update'])){

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $pecas = $_POST['pecas'];
    $preco = $_POST['preco'];
    $loja = $_POST['loja'];

    $conn->query("UPDATE produtos SET
    nome='$nome',
    qtd_pecas='$pecas',
    preco='$preco',
    loja='$loja'
    WHERE id=$id");

    header("Location: index.php");
}

$result = $conn->query("SELECT * FROM produtos");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>LEGO STORE</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    background:#0f172a;
    color:white;
}

/* HERO */

.hero{
    height:70vh;
    background:
    linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.7)),
    url('https://images.unsplash.com/photo-1587654780291-39c9404d746b?q=80&w=1400&auto=format&fit=crop');
    background-size:cover;
    background-position:center;

    display:flex;
    justify-content:center;
    align-items:center;
    text-align:center;
    padding:20px;
}

.hero-content h1{
    font-size:60px;
    margin-bottom:15px;
}

.hero-content p{
    font-size:20px;
    opacity:.9;
    margin-bottom:25px;
}

.hero-content button{
    padding:15px 35px;
    border:none;
    border-radius:12px;
    background:#facc15;
    color:black;
    font-size:18px;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;
}

.hero-content button:hover{
    transform:scale(1.05);
}

/* CONTAINER */

.container{
    width:90%;
    max-width:1300px;
    margin:auto;
    padding:40px 0;
}

/* FORM */

.form-box{
    background:#1e293b;
    padding:30px;
    border-radius:20px;
    margin-bottom:50px;
    box-shadow:0 10px 30px rgba(0,0,0,.3);
}

.form-box h2{
    margin-bottom:25px;
    font-size:30px;
}

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.form-grid input{
    padding:15px;
    border:none;
    border-radius:12px;
    background:#334155;
    color:white;
    font-size:15px;
}

.form-grid input::placeholder{
    color:#cbd5e1;
}

.search{
    width:100%;
    margin-bottom:20px;
    padding:15px;
    border:none;
    border-radius:12px;
    background:#334155;
    color:white;
}

.btn{
    margin-top:20px;
    width:100%;
    padding:16px;
    border:none;
    border-radius:12px;
    font-size:17px;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;
}

.btn-add{
    background:#22c55e;
    color:white;
}

.btn-edit{
    background:#3b82f6;
    color:white;
}

.btn:hover{
    transform:translateY(-2px);
}

/* PRODUTOS */

.title{
    margin-bottom:25px;
    font-size:35px;
}

.produtos{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(280px, 1fr));
    gap:30px;
}

.card{
    background:#1e293b;
    border-radius:20px;
    overflow:hidden;
    transition:.3s;
    box-shadow:0 10px 25px rgba(0,0,0,.3);
}

.card:hover{
    transform:translateY(-8px);
}

.card img{
    width:100%;
    height:220px;
    object-fit:cover;
}

.card-content{
    padding:25px;
}

.card h3{
    font-size:24px;
    margin-bottom:10px;
}

.info{
    margin-bottom:10px;
    color:#cbd5e1;
}

.preco{
    font-size:28px;
    font-weight:bold;
    color:#facc15;
    margin:15px 0;
}

.actions{
    display:flex;
    gap:10px;
}

.actions a{
    flex:1;
}

.actions button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;
}

.editar{
    background:#3b82f6;
    color:white;
}

.excluir{
    background:#ef4444;
    color:white;
}

.actions button:hover{
    opacity:.9;
}

@media(max-width:768px){

    .hero-content h1{
        font-size:38px;
    }

    .form-grid{
        grid-template-columns:1fr;
    }

}

</style>

</head>

<body>

<!-- HERO -->

<section class="hero">

    <div class="hero-content">

        <h1>🧱 LEGO STORE</h1>

        <p>Os sets mais incríveis de LEGO do mundo</p>

        <button onclick="document.querySelector('.container').scrollIntoView({behavior:'smooth'})">
            Ver Produtos
        </button>

    </div>

</section>

<!-- CONTAINER -->

<div class="container">

    <!-- FORM -->

    <div class="form-box">

        <h2>
            <?php echo $edit ? "✏️ Editar Produto" : "➕ Adicionar Produto"; ?>
        </h2>

        <form method="POST">

            <input
            type="text"
            id="search"
            class="search"
            placeholder="🔍 Buscar Lego..."
            onkeyup="buscar()">

            <input
            type="hidden"
            name="id"
            value="<?php echo $rowEdit['id'] ?? ''; ?>">

            <div class="form-grid">

                <input
                type="text"
                name="nome"
                placeholder="Nome do Lego"
                value="<?php echo $rowEdit['nome'] ?? ''; ?>"
                required>

                <input
                type="number"
                name="pecas"
                placeholder="Quantidade de peças"
                value="<?php echo $rowEdit['qtd_pecas'] ?? ''; ?>"
                required>

                <input
                type="text"
                name="preco"
                placeholder="Preço"
                value="<?php echo $rowEdit['preco'] ?? ''; ?>"
                required>

                <input
                type="text"
                name="loja"
                placeholder="Loja"
                value="<?php echo $rowEdit['loja'] ?? ''; ?>">

            </div>

            <?php if($edit == true){ ?>

                <button class="btn btn-edit" name="update">
                    Atualizar Produto
                </button>

            <?php } else { ?>

                <button class="btn btn-add" name="add">
                    Adicionar Produto
                </button>

            <?php } ?>

        </form>

    </div>

    <!-- PRODUTOS -->

    <h2 class="title">🔥 Catálogo LEGO</h2>

    <div class="produtos" id="produtos">

        <?php while($row = $result->fetch_assoc()){ ?>

        <div class="card">

            <img src="https://images.unsplash.com/photo-1587654780291-39c9404d746b?q=80&w=1200&auto=format&fit=crop">

            <div class="card-content">

                <h3><?php echo $row['nome']; ?></h3>

                <p class="info">
                    🧩 <?php echo $row['qtd_pecas']; ?> peças
                </p>

                <p class="info">
                    🏪 <?php echo $row['loja']; ?>
                </p>

                <div class="preco">
                    R$ <?php echo $row['preco']; ?>
                </div>

                <div class="actions">

                    <a href="?edit=<?php echo $row['id']; ?>">

                        <button class="editar">
                            Editar
                        </button>

                    </a>

                    <a href="?delete=<?php echo $row['id']; ?>">

                        <button class="excluir">
                            Excluir
                        </button>

                    </a>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

</div>

<script>

function buscar(){

    let input =
    document.getElementById("search")
    .value
    .toLowerCase();

    let cards =
    document.querySelectorAll(".card");

    cards.forEach(card => {

        let texto =
        card.innerText.toLowerCase();

        card.style.display =
        texto.includes(input)
        ? "block"
        : "none";

    });

}

</script>

</body>
</html>