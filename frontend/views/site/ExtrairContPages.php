<?php
// Array para armazenar o conteúdo das páginas
$pages = [];

// Função para extrair o conteúdo de uma página
function extractPageContent($pageUrl) {
    // Ler o conteúdo do arquivo PHP da página e extrair o texto relevante.
    ob_start();
    include($pageUrl);
    $content = ob_get_clean();

    // Extração de texto: removendo tags HTML
    $content = strip_tags($content);

    return $content;
}
// Adicionando as páginas a indexar
$pages[] = [
    'title' => 'SGI FRESAN | Camões, I.P.',
    'content' => extractPageContent(Yii::getAlias('@frontend/views/site/index.php')),
];

$pages[] = [
    'title' => 'Missão',
    'content' => extractPageContent(Yii::getAlias('@frontend/views/site/missão.php')),

];

$pages[] = [
    'title' => 'Resultados',
    'content' => extractPageContent(Yii::getAlias('@frontend/views/site/resultado.php')),

];

$pages[] = [
    'title' => 'Galeria',
    'content' => extractPageContent(Yii::getAlias('@frontend/views/site/galeria.php')),

];

$pages[] = [
    'title' => 'Contactos',
    'content' => extractPageContent(Yii::getAlias('@frontend/views/site/contactos.php')),

];

// Saída do conteúdo das páginas como JSON
header('Content-Type: application/json');
echo json_encode($pages);

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

