<?php

class Str {
    /* Trim the inputted data, strip slashes, and convert html tags to entity codes */
    static function sanitize($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

?>
