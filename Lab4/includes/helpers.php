<?php

    /* Convert Litres => Gallons and vice versa */
    function ConvertLiquid($amount, $convertTo) {
        
        $converted = [];

        // Determine which unit to convert to
        switch ($convertTo) {
                
            case 'litres':
                $converted = [
                    'from_unit' => 'Gallons',
                    'to_unit' => 'Litres',
                    'original_amount' => $amount,
                    'converted_amount' => $amount * 3.78541
                ];
                break;
            case 'gallons':
                $converted = [
                    'from_unit' => 'Litres',
                    'to_unit' => 'Gallons',
                    'original_amount' => $amount,
                    'converted_amount' => $amount * 0.264172
                ];
                break;
        }
        
        return $converted;
    }

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

    /* Trim the inputted data, strip slashes, and convert html tags to entity codes */
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /* Checks to see if there are elements in an array */
    function has_items($data) {
        return count($data) > 0 ? true : false;   
    }
?>

