<?php
include 'conexao.php';

$id = $_GET['id'];
$sql = "DELETE FROM produtos WHERE id=$id";
$conn->query($sql);

header("Location: index.php");
?>

//CRUD

// CREATE CRIAR
// READ  LER
// UPDATE  ATUALIZAR
// DELETE  EXCLUIR/ DELETAR