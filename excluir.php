<?php

session_start();

require_once __DIR__ . '/funcoes.php';

if (!isset($_SESSION['usuario'])) {
    encerrarComErro('Você precisa estar logado.', 403);
}

// A exclusão deve ser feita somente por POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    encerrarComErro('Método não permitido.', 405);
}

// Verifica o token CSRF
if (!csrfValido($_POST['csrf_token'] ?? null)) {
    encerrarComErro('Formulário expirado. Tente novamente.', 403);
}

// Obtém os IDs enviados pelo formulário
$id = obterIndice($_POST['id'] ?? null);
$comentarioId = obterIndice($_POST['comentario'] ?? null);

if ($id === null || $comentarioId === null) {
    encerrarComErro('Comentário inválido.', 400);
}

try {

    // Carrega o arquivo XML
    $topicos = carregarXml(ARQUIVO_TOPICOS, 'topicos');

    // Verifica se o tópico existe
    if (!isset($topicos->topico[$id])) {
        encerrarComErro('Tópico não encontrado.', 404);
    }

    // Verifica se o usuário logado é o autor do tópico
    $autor = (string) $topicos->topico[$id]->autor;

    if ($autor !== (string) $_SESSION['usuario']) {
        encerrarComErro(
            'Somente o autor do tópico pode excluir comentários.',
            403
        );
    }

    // Verifica se o comentário existe
    if (
        !isset(
            $topicos->topico[$id]
                ->comentarios
                ->comentario[$comentarioId]
        )
    ) {
        encerrarComErro('Comentário não encontrado.', 404);
    }

    // Exclui o comentário
    unset(
        $topicos->topico[$id]
            ->comentarios
            ->comentario[$comentarioId]
    );

    // Salva o XML
    salvarXml($topicos, ARQUIVO_TOPICOS);

    // Volta para a página de listagem
    header('Location: listar.php');
    exit;

} catch (RuntimeException $excecao) {

    encerrarComErro(
        $excecao->getMessage(),
        500
    );
}
?>