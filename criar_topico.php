<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "Você precisa estar logado para criar um tópico. <a href='login.php'>Fazer login</a>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $topicos = simplexml_load_file("topicos.xml");
    $novo = $topicos->addChild("topico");
    $novo->addChild("autor", $_SESSION['usuario']);
    $novo->addChild("titulo", $_POST['titulo']);
    $novo->addChild("mensagem", $_POST['mensagem']);
    $novo->addChild("comentarios");
    $topicos->asXML("topicos.xml");

    echo "Tópico criado com sucesso! <a href='listar.php'>Ver Tópicos</a>";
} else {
?>

<style>
    body { font-family: sans-serif; }
    form { max-width: 300px; margin: 40px auto; padding: 20px; background: #fff0f5; border-radius: 8px; }
    h2 { color: #d63384; text-align: center; margin-top: 0; }
    input, textarea { width: 100%; padding: 8px; margin: 4px 0 12px; box-sizing: border-box; border: 1px solid #f5c6cb; border-radius: 4px; font-family: sans-serif; }
    textarea { height: 90px; resize: vertical; }
    button { width: 100%; padding: 8px; background: #e83e8c; color: #fff; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; }
</style>

<form method="post">
    <h2>Criar Tópico</h2>
    
    <label>Título:</label>
    <input type="text" name="titulo" placeholder="Título do tópico" required>

    <label>Mensagem:</label>
    <textarea name="mensagem" placeholder="Escreva sua mensagem..." required></textarea>

    <button type="submit">Criar Tópico</button>
</form>

<?php } ?>