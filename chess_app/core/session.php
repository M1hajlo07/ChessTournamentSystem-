<?php
class Session
{
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function destroy()
    {
        $_SESSION = [];
        session_destroy();
    }

    public static function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }
}
