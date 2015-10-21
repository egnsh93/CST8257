<?php

class Validator {
    /* Checks to see if there are elements in an array */
    static function has_items($data) {
        return count($data) > 0 ? true : false;
    }

    static function error_to_string($rule, $label = null) {
        return $label . " " . $rule;
    }

    /* Check if a field is null or an empty string */
    static function is_valid($data) {
        if ( is_null($data) )
            return false;
        if ( $data == "" )
            return false;
        return true;
    }

    static function is_phone($data) {
        // Matches phone numbers in the format of (NNN) NNN-NNNN
        return preg_match("/^\(\d{3}\)\s\d{3}-\d{4}$/", $data) ? true : false;
    }

    static function is_postal($data) {
        // Matches postal codes in the format of A1A 1A1, with or without spaces, case insensitive
        return preg_match("/^[A-Za-z]\d[A-Za-z][ ]?\d[A-Za-z]\d$/", $data) ? true : false;
    }

    static function is_strong_pass($data) {
        $rule_upper = '/[A-Z]/';
        $rule_lower = '/[a-z]/';
        $rule_numeric = '/\d/';
        $rule_special = '/[!@#$%^&*()\-_=+{};:,<.>]/';

        if (strlen($data) < 6) return false;
        if (preg_match_all($rule_upper, $data) < 1) return false;
        if (preg_match_all($rule_lower, $data) < 1) return false;
        if (preg_match_all($rule_numeric, $data) < 1) return false;
        if (preg_match_all($rule_special, $data) < 1) return false;

        return true;
    }

    static function compare($str1, $str2) {
        if ($str1 !== $str2)
            return false;
        return true;
    }
}

?>
