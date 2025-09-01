<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
    $host = filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $uri  = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $url  = 'https://' . $host . $uri;
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $url);
    exit();
}
