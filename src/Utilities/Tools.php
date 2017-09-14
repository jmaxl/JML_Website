<?php
declare(strict_types=1);

namespace Project\Utilities;

class Tools
{
    /**
     * @param string $name
     * @return bool|string|int
     */
    public static function getValue(string $name)
    {
        if (isset($_GET[$name]) && empty($_GET[$name]) === false) {
            return $_GET[$name];
        }

        if (isset($_POST[$name]) && empty($_POST[$name]) === false) {
            return $_POST[$name];
        }

        if (isset($_SESSION[$name]) && empty($_SESSION[$name]) === false) {
            return $_SESSION[$name];
        }

        return false;
    }
}