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

  echo "<div style='display: flex; justify-content: center; align-items: center; width: 100%; margin: 20px 0;'>
        <div style='font-family: Arial, sans-serif; background-color: #fdf2f8; color: #9d174d; padding: 18px 24px; border-radius: 12px; border: 1px solid #fbcfe8; display: inline-flex; align-items: center; gap: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); text-align: center;'>
            <span style='font-weight: 500;'>Tópico criado com sucesso!</span> 
            <a href='listar.php' style='background-color: #ec4899; color: #ffffff; padding: 8px 16px; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px;'>Ver Tópicos</a>
        </div>
    </div>";
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