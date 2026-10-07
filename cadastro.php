<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarios = simplexml_load_file("usuarios.xml");
    $novo = $usuarios->addChild("usuario");
    $novo->addChild("nome", $_POST['nome']);
    $novo->addChild("celular", $_POST['celular']);
    $novo->addChild("email", $_POST['email']);
    $novo->addChild("senha", md5($_POST['senha']));
    $usuarios->asXML("usuarios.xml");

    echo "<div style='text-align:center; font-family:sans-serif; margin-top:40px;'>
            <p style='color:#c2185b; font-weight:bold;'>Usuário cadastrado com sucesso!</p>
            <a href='login.php' style='color:#e91e63; font-weight:bold; text-decoration:none;'>Fazer login</a>
          </div>";
} else {
?>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #fff0f5;
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
            box-shadow: 0 4px 15px rgba(233, 30, 99, 0.12);
            border: 1px solid #f8bbd0;
            box-sizing: border-box;
        }

        h2 {
            color: #d81b60;
            text-align: center;
            margin: 0 0 20px 0;
            font-size: 1.5rem;
            font-weight: 700;
        }

        label {
            display: block;
            color: #880e4f;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #f48fb1;
            border-radius: 6px;
            font-size: 0.95rem;
            color: #4a154b;
            background-color: #fafafa;
            transition: all 0.2s ease-in-out;
        }

        input:focus {
            outline: none;
            border-color: #e91e63;
            background-color: #fff;
            box-shadow: 0 0 6px rgba(233, 30, 99, 0.25);
        }

        button {
            width: 100%;
            padding: 11px;
            background: #e91e63;
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
            background: #c2185b;
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