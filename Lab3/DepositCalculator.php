<?php
    
    /* Include helper validation functions */
    include('helpers.php');

    /* Define global field array for use in custom error messages */
    $labels = array(
        'principal' => 'PrincipalAmount',
        'interest' => 'InterestRate',
        'depositDuration' => 'DepositDuration',
        'name' => 'Name',
        'phone' => 'Phone',
        'email' => 'Email',
        'contactMethod' => 'PreferredContact',
        'contactTime' => 'ContactTime'
    );

    /* Define validation rule messages */
    $rules = array(
        'empty' => ' field cannot be left blank',
        'numeric_above_zero' => ' entered has to be numeric and greater than zero',
        'numeric_not_negative' => ' entered has to be numeric and not negative',
        'valid_phone' => ' has to be in the format of NNN-NNN-NNNN',
        'valid_email' => ' has to be in valid email format',
        'valid_contact_time' => ' is your preferred contact method, you must select a preferred time'
    );

    /* Set initial error status */
    $error_flag = false;

    /* Iterate through POST variables assign key/value */
    foreach ($_POST as $key => $value) {
        // Only sanitize the text fields
        if ($key !== 'PreferredContact' && $key !== 'ContactTime') { 
            $value = sanitize_input($value);
        
            // Check for invalid fields
            if (!is_valid($value) ||
                !is_num_above_zero($_POST[$labels['principal']]) ||
                !is_num_not_negative($_POST[$labels['interest']]) ||
                !is_valid_phone($_POST[$labels['phone']]) ||
                !is_valid_email($_POST[$labels['email']]) ||
                !isset($_POST[$labels['contactTime']])) {
                
                $error_flag = true;
            } 
        }
    }

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Deposit Calculator</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link href="css/style.css" rel="stylesheet">
        <link href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css" rel="stylesheet">
    </head>

    <body>

        <div class="container">
            
            <?php if ($error_flag) : ?>
            
                <div id="failure">
                    <h2><strong>Thank you for using our deposit calculator</strong></h2>
                    <p>Unfortunately we can not calculate the payments because you entered the following invalid data:</p>

                    <ul>
                        <?php 
                            // Iterate through each post variable and display relevant errors
                            foreach ($labels as $label) {
                                
                                // Set default checkbox
                                $_POST[$labels['contactTime']] = isset($_POST[$labels['contactTime']]) ? $_POST[$labels['contactTime']] : [];

                                // Check for required fields
                                if ( (!is_valid($_POST[$label])) && ($label !== 'ContactTime') ) {
                                    echo "<li>" . $label . ' ' . $rules['empty'] . "</li>";
                                }
                                
                                // Check that principal amount is numeric and greater than zero 
                                if ( $label == $labels['principal'] ) {
                                    if ( (is_valid($_POST[$label])) && (is_num_above_zero($_POST[$label]) == false) ) {
                                        echo "<li>" . $labels['principal'] . $rules['numeric_above_zero'] . "</li>";
                                    }
                                }
                                
                                // Check that interest rate is numeric and not negative
                                if ( $label == $labels['interest'] ) {
                                    if ( (is_valid($_POST[$label])) && (is_num_not_negative($_POST[$label]) == false) ) {
                                        echo "<li>" . $labels['interest'] . $rules['numeric_not_negative'] . "</li>";
                                    }
                                }
                                
                                // Check for valid phone number
                                if ( $label == $labels['phone'] ) {
                                    if ( (is_valid($_POST[$label])) && (is_valid_phone($_POST[$label]) == false) ) {
                                        echo "<li>" . $labels['phone'] . $rules['valid_phone'] . "</li>";
                                    }
                                }

                                // Check for valid email address
                                if ( $label == $labels['email'] ) {
                                    if ( (is_valid($_POST[$label])) && (is_valid_email($_POST[$label]) == false) ) {
                                        echo "<li>" . $labels['email'] . $rules['valid_email'] . "</li>";
                                    }
                                }
                                
                                // Check for empty checkbox array
                                if ( $label == $labels['contactTime'] ) {
                                    if ( $_POST[$label] == []) {
                                        echo "<li>" . 'Since ' . $_POST[$labels['contactMethod']] . $rules['valid_contact_time'] . "</li>";
                                    }
                                }
                            }
                        ?>

                    </ul>

                    <p>Please use the back button of your browser to navigate to the previous page, correct these errors and submit again.</p>
                </div>
            
            <?php else : ?>
            
                <div id="success">
                    <h2><strong>Thank you, <?= $_POST['Name'] ?>, for using our deposit calculator</strong></h2>
                    <p>Following is the result of the calculation:</p>
                    <table class="pure-table">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th>Principal at Year Start</th>
                                <th>Interest for the Year</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <?php 
                                // Keep track of the principal amount and the years to deposit
                                $principalAmount = $_POST['PrincipalAmount'];
                                $depositYears = $_POST['DepositDuration'];
                            ?>
                            <?php 
                                // Output table row for every deposit year
                                for ($i = 1; $i <= $depositYears; $i++) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= '$' . number_format($principalAmount, 2) ?></td>
                                    <td>
                                        <?php
                                            // Interest rate calculations
                                            $interestRate = $principalAmount * ( $_POST['InterestRate'] / 100);

                                            // Format the interest rate to two decimal places
                                            printf('$' . number_format($interestRate, 2));

                                            // Add the previous years interest rate to next years principal amount
                                            $principalAmount += $interestRate;
                                        ?>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                    
                    <p>Our customer service department will <?= $_POST[$labels['contactMethod']] ?> you tomorrow <?= implode(', ', $_POST[$labels['contactTime']]) ?></p>
                </div>
            
            <?php endif; ?>
        </div>
    </body>

    </html>