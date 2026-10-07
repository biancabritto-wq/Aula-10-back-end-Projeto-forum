<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $topicos = simplexml_load_file("topicos.xml");
   $id =intval($_POST['id']);
   $comentarios = $topicos->topico[$id]->comentarios->addChild("comentario");
    $comentarios->addChild("nome", $_POST['nome']);
    $comentarios->addChild("mensagem", $_POST['mensagem']);
    $topicos->asXML("topicos.xml");
    header("Location: listar.php");
} 