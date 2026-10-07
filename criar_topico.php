<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "<div style='display: flex; justify-content: center; align-items: center; width: 100%; margin: 20px 0;'>
        <div style='font-family: Arial, sans-serif; background-color: #e6fffa; color: #0d9488; padding: 18px 24px; border-radius: 12px; border: 1px solid #99f6e4; display: inline-flex; align-items: center; gap: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); text-align: center;'>
            <span style='font-weight: 500;'>Você precisa estar logado para criar um tópico.</span> 
            <a href='login.php' style='background-color: #0d9488; color: #ffffff; padding: 8px 16px; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px;'>Fazer login</a>
        </div>
    </div>";
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
        <div style='font-family: Arial, sans-serif; background-color: #e6fffa; color: #0d9488; padding: 18px 24px; border-radius: 12px; border: 1px solid #99f6e4; display: inline-flex; align-items: center; gap: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); text-align: center;'>
            <span style='font-weight: 500;'>Tópico criado com sucesso!</span> 
            <a href='listar.php' style='background-color: #0d9488; color: #ffffff; padding: 8px 16px; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px;'>Ver Tópicos</a>
        </div>
    </div>";
} else {
?>
<style>
    body { 
        font-family: Arial, sans-serif; 
        background-color: #e0f7fa;
        margin: 0;
        padding: 20px;
    }
    form { 
        max-width: 420px; 
        margin: 40px auto; 
        padding: 30px; 
        background: #ffffff; 
        border-radius: 16px; 
        border: 1px solid #b2dfdb;
        box-shadow: 0 10px 25px -5px rgba(0, 150, 136, 0.15);
    }
    h2 { 
        color: #00897b; 
        text-align: center; 
        margin-top: 0; 
        margin-bottom: 20px;
        font-size: 22px;
    }
    label {
        display: block;
        color: #004d40;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 6px;
    }
    input, textarea { 
        width: 100%; 
        padding: 10px 12px; 
        margin-bottom: 16px; 
        box-sizing: border-box; 
        border: 1px solid #80cbc4; 
        border-radius: 8px; 
        font-family: inherit; 
        font-size: 14px;
        background-color: #f0fdfa;
        color: #004d40;
        outline: none;
        transition: border-color 0.2s, background-color 0.2s;
    }
    input:focus, textarea:focus {
        border-color: #009688;
        background-color: #ffffff;
    }
    textarea { 
        height: 110px; 
        resize: vertical; 
    }
    button { 
        width: 100%; 
        padding: 12px; 
        background: #009688; 
        color: #ffffff; 
        border: none; 
        border-radius: 8px; 
        font-weight: bold; 
        font-size: 15px;
        cursor: pointer; 
        transition: background-color 0.2s;
    }
    button:hover {
        background: #00796b;
    }
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