<?php  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  

    $usuarios = simplexml_load_file("usuarios.xml");  

    $novo = $usuarios->addChild("usuario");  

    $novo->addChild("nome", $_POST['nome']);  
    $novo->addChild("celular", $_POST['celular']);  
    $novo->addChild("email", $_POST['email']);  
    $novo->addChild("senha", md5($_POST['senha']));  

    $usuarios->asXML("usuarios.xml");  
    echo "<div style='display: flex; justify-content: center; align-items: center; width: 100%; margin: 20px 0;'>
        <div style='font-family: Arial, sans-serif; background-color: #e6fffa; color: #0d9488; padding: 18px 24px; border-radius: 12px; border: 1px solid #99f6e4; display: inline-flex; align-items: center; gap: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); text-align: center;'>
            <span style='font-weight: 500;'>Usuário cadastrado com sucesso!</span> 
            <a href='login.php' style='background-color: #0d9488; color: #ffffff; padding: 8px 16px; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px;'>Fazer login</a>
        </div>
    </div>";  

} else {  
?>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #e0f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        form {
            width: 100%;
            max-width: 320px;
            background: #ffffff;
            padding: 30px 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 150, 136, 0.15);
            border: 1px solid #b2dfdb;
            box-sizing: border-box;
        }

        h2 {
            color: #00897b;
            text-align: center;
            margin: 0 0 20px 0;
            font-size: 1.5rem;
            font-weight: 700;
        }

        label {
            display: block;
            color: #004d40;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #80cbc4;
            border-radius: 6px;
            font-size: 0.95rem;
            color: #004d40;
            background-color: #fafafa;
            transition: all 0.2s ease-in-out;
        }

        input:focus {
            outline: none;
            border-color: #009688;
            background-color: #fff;
            box-shadow: 0 0 6px rgba(0, 150, 136, 0.3);
        }

        button {
            width: 100%;
            padding: 11px;
            background: #009688;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            margin-top: 5px;
        }

        button:hover {
            background: #00796b;
        }

        button:active {
            transform: scale(0.98);
        }
    </style>

    <form method="post">
        <h2>Cadastro</h2>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="celular">Celular:</label>
        <input type="text" id="celular" name="celular" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <button type="submit">Cadastrar</button>
    </form>

<?php } ?>