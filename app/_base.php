<?php
function uri()
{
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $uri = parse_url($uri, PHP_URL_PATH);
    $uri = trim($uri, '/');
    return $uri;
}



?>