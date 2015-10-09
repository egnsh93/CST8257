<?php
    /* Check if a field is null or an empty string */
    function is_valid($data) {
        if ( is_null($data) )
            return false;
        if ( $data == "" )
            return false;
        return true;
    }

    /* Check if a string is numeric and above zero */
    function is_num_above_zero($data) {
        return is_numeric($data) && $data > 0;
    }

    /* Check if a string is numeric and not negative */
    function is_num_not_negative($data) {
        return is_numeric($data) && $data >= 0;
    }
    
    /* Check for valid phone number */
    function is_valid_phone($data) {
        return ereg("^[0-9]{3}-[0-9]{3}-[0-9]{4}$", $data);
    }

    /* Check for valid email address */
    function is_valid_email($data) {
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }

    /* Trim the inputted data, strip slashes, and convert html tags to entity codes */
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>