<?php

use system\App\Admin;

if (!function_exists('basePath')) {
    function basePath(string $path = ''): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/' . $path;
    }
}

if (!function_exists('errorMessage')) {
    function errorMessage()
    {
        if (!isset($_SESSION) || empty($_SESSION['errorMessage'])) {
            return false;
        }
        $errorMessage = $_SESSION['errorMessage'];
        unset($_SESSION['errorMessage']);
        return $errorMessage;
    }
}

if (!function_exists('message')) {
    function message()
    {
        if (!isset($_SESSION) || empty($_SESSION['message'])) {
            return false;
        }
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
        return $message;
    }
}

if (!function_exists('isAuthorized')) {
    function isAuthorized(): bool
    {
        return isset($_SESSION) && isset($_SESSION['admin']);
    }
}

if (!function_exists('admin')) {
    function admin(): ?Admin
    {
        if (isAuthorized()) {
            return unserialize($_SESSION['admin']);
        }
        return null;
    }
}
