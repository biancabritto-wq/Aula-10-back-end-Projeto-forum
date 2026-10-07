<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuarios = simplexml_load_file("usuarios.xml");

    foreach ($usuarios->usuario as $u) {

        if ($u->email == $_POST['email'] && $u->senha == md5($_POST['senha'])) {

            $_SESSION['usuario'] = (string)$u->email;

            echo "<div style='display: flex; justify-content: center; align-items: center; width: 100%; margin: 20px 0;'>

                <div style='font-family: Arial, sans-serif; background-color: #e6fffb; color: #0f766e; padding: 18px 24px; border-radius: 12px; border: 1px solid #99f6e4; display: inline-flex; align-items: center; gap: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); text-align: center;'>

                    <span style='font-weight: 500;'>Login realizado com sucesso!</span>

                    <a href='criar_topico.php' style='background-color: #14b8a6; color: #ffffff; padding: 8px 16px; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px;'>
                        Criar Tópico
                    </a>

                </div>
            </div>";

            exit;
        }
    }

    echo "<div style='text-align:center; font-family:sans-serif; margin-top:40px;'>

            <p style='color:#dc2626; font-weight:bold;'>Login inválido!</p>

            <a href='login.php' style='color:#0f766e; font-weight:bold; text-decoration:none;'>
                Tentar novamente
            </a>

          </div>";

} else {

?>

<style>

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #e6fffb;
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
        box-shadow: 0 4px 15px rgba(20, 184, 166, 0.18);
        border: 1px solid #99f6e4;
        box-sizing: border-box;
    }

    h2 {
        color: #0f766e;
        text-align: center;
        margin: 0 0 20px 0;
        font-size: 1.5rem;
        font-weight: 700;
    }

    label {
        display: block;
        color: #115e59;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 4px;
    }

    input {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 16px;
        box-sizing: border-box;
        border: 1px solid #5eead4;
        border-radius: 6px;
        font-size: 0.95rem;
        color: #134e4a;
        background-color: #f0fdfa;
        transition: all 0.2s ease-in-out;
    }

    input:focus {
        outline: none;
        border-color: #14b8a6;
        background-color: #ffffff;
        box-shadow: 0 0 6px rgba(20, 184, 166, 0.25);
    }

    button {
        width: 100%;
        padding: 11px;
        background: #14b8a6;
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
        background: #0f766e;
    }

    button:active {
        transform: scale(0.98);
    }

</style>

<form method="post">

    <h2>Login</h2>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required>

    <button type="submit">Entrar</button>

</form>

<?php } ?>