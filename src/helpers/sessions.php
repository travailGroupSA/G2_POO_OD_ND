<?php
session_start();

class Sessions
{

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return true;
        } else {
            return false;
        }
    }
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public static function destroy()
    {
        session_destroy();
    }
}