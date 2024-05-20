   var_dump($_GET['keyword']);

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Pesquisa</title>
    <style>
        /* Estilos opcionais para a página de resultados */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            margin-bottom: 10px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
    include 'ExtrairContPages.php';
    
    // Obter a palavra-chave da consulta GET
    $keyword = filter_input(INPUT_GET, 'keyword', FILTER_SANITIZE_STRING);

    if ($keyword !== false && $keyword !== null) {
        // Realizar a lógica de pesquisa e obter os resultados
        $results = [];

        foreach ($pages as $page) {
            if (stripos($page['title'], $keyword) !== false || stripos($page['content'], $keyword) !== false) {
                // A palavra-chave foi encontrada no título ou no conteúdo da página
                $results[] = [
                    'title' => $page['title'],
                    'url' => str_replace(' ', '-', strtolower($page['title'])) . '.php' // Gerando uma URL simples a partir do título da página
                ];
            }
        }

        if (!empty($results)) {
            // Exibindo os resultados da pesquisa
            echo "<h2>Resultados da pesquisa para: $keyword</h2>";
            echo "<ul>";
            foreach ($results as $result) {
                echo "<li><a href='{$result['url']}'>{$result['title']}</a></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Nenhum resultado encontrado para: $keyword</p>";
        }
    } else {
        // Se a palavra-chave não estiver presente ou for inválida, exiba uma mensagem de erro
        echo "<p>Erro: Palavra-chave de pesquisa inválida.</p>";
    }
    
    //// Obtendo a palavra-chave da consulta GET
//$keyword = filter_input(INPUT_GET, 'keyword', FILTER_SANITIZE_STRING);
//
//if ($keyword !== false && $keyword !== null) {
//    // Realizando a lógica de pesquisa e obtendo os resultados
//    $results = [];
//
//    foreach ($pages as $page) {
//        if (stripos($page['title'], $keyword) !== false || stripos($page['content'], $keyword) !== false) {
//            // A palavra-chave foi encontrada no título ou no conteúdo da página
//            $results[] = [
//                'title' => $page['title'],
//                'url' => str_replace(' ', '-', strtolower($page['title'])) . '.php' // Gerando uma URL simples a partir do título da página
//            ];
//        }
//    }
//
//    if (!empty($results)) {
//        // Exibindo os resultados da pesquisa
//        echo "<h2>Resultados da pesquisa para: $keyword</h2>";
//        echo "<ul>";
//        foreach ($results as $result) {
//            echo "<li><a href='{$result['url']}'>{$result['title']}</a></li>";
//        }
//        echo "</ul>";
//    } else {
//        // Nenhum resultado encontrado
//        echo "<p>Nenhum resultado encontrado para: $keyword</p>";
//    }
//} else {
//    // Se a palavra-chave não estiver presente ou for inválida, exibir uma mensagem de erro
//    echo "<p>Erro: Palavra-chave de pesquisa inválida.</p>";
//}
    ?>
</body>
</html>

    



