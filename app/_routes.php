<?php
define('PAGE_PATH', __DIR__ . '/page/');

$requestPath = uri();

$page = 'main';
if (!empty($requestPath)) {
    $page = $requestPath;
}

// Convert dashes to spaces for the title, and make the first letter of each word uppercase
$_title = ucwords(str_replace(['-', '/', '_'], ' ', $page));

$indexFilePath = PAGE_PATH . $page . '/index.php';
$filePath      = PAGE_PATH . $page . '.php';


ob_start();

if (file_exists($indexFilePath)) {
    $view = $indexFilePath;
} else if (file_exists($filePath)) {
    $view = $filePath;
} else {
    $view = '_404.php';
}

require 'assets/imports/header.php';
require $view;
require 'assets/imports/footer.php';

ob_end_flush();
?>