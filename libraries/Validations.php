<?php
class Validations
{
    private static $errors = [];

    public static function getErrors()
    {
        return self::$errors;
    }

    public static function isValid()
    {
        return count(self::$errors) == 0;
    }


    public static function isEmpty($field, $input, $msg = "Champ Obligatoire")
    {
        if (empty($field)) {
            self::$errors[$input] = $msg;
        }
    }
    public static function exist($value)
    {
        if (!empty($value)) {
            return true;
        }
        return false;
    }
    public static function isEmail()
    {
    }
}