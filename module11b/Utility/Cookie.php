<?php

namespace Utility\Cookie;

class CookieHandler {
    // Function to set a cookie
    public static function setCookie($name, $value, $expiry = 0, $path = '/') {
        setcookie($name, $value, time() + $expiry, $path);
    }

    // Function to get a cookie value
    public static function getCookie($name) {
        return $_COOKIE[$name] ?? null;
    }

    // Function to delete a cookie
    public static function deleteCookie($name) {
        setcookie($name, '', time() - 3600, '/');
        unset($_COOKIE[$name]);
    }
}
