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
    public static function isAllEmpty($data)
    {
        foreach ($data as $key => $value) {
            //key=> champs $value=> value du champs
            if (empty($value)) {
                self::$errors[$key] = "le Champ " . $key . " est obligattoire";
            }
        }
    }

    public static function exist($value)
    {
        if (!empty($value)) {
            return true;
        }
        return false;
    }
    public static function isEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            self::$errors['email'] = "Email invalide";
        }
    }
}