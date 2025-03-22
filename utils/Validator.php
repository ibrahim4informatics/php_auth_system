<?php

namespace utils\validation;

class Validator

{
    public static function  isEmail(string $email): bool
    {
        $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        return preg_match($emailPattern, $email);
    }

    static function isPhone(string $phone): bool
    {
        $phonePattern = "/^(06|07|05)\d{8}$/";
        return preg_match($phonePattern, $phone);
    }

    static function isStrongPassword(string $password): bool
    {
        $passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
        return preg_match($passwordPattern, $password);
    }
}
