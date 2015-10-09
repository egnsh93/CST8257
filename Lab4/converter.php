    <?php include('includes/helpers.php'); ?>

    <?php
    
        /* Define global field array for use in custom error messages */
        $requiredField = array(
            'amount' => 'amount',
            'unit' => 'unit'
        );

        /* Define validation rule messages */
        $errorMessage = array(
            'no_amount' => 'You did not enter an amount',
            'no_unit' => 'You did not enter a unit to convert to',
            'num_above_zero' => 'The entered amount must be numeric and greater than zero',
        );

        /* Define error array */
        $errors = array();

        /* If the convert button was pressed */
        if ( isset($_POST['convert']) ) {
            
            /* Check if an amount has been entered */
            if ( !is_valid(sanitize_input($_POST[$requiredField['amount']])) ) {       
                array_push( $errors, [
                    $requiredField['amount'] => $errorMessage['no_amount']
                ]);
            }
            
            /* If an amount has been entered and is valid, check if numeric and greater than zero */
            if ( (is_valid(sanitize_input($_POST[$requiredField['amount']])) && (!is_num_above_zero($_POST[$requiredField['amount']]))) ) {
                array_push( $errors, [
                    $requiredField['amount'] => $errorMessage['num_above_zero']
                ]);
            } 

            /* Check if a unit has been selected */
            if ( $_POST[$requiredField['unit']] == 'default') {
                array_push( $errors, [
                    $requiredField['unit'] => $errorMessage['no_unit']
                ]);
            }
            
            /* If there are no errors, convert! */
            if (!has_items($errors)) {
                
                /* Send the submitted values to the convert function */
                $convertedValue = ConvertLiquid($_POST[$requiredField['amount']], $_POST[$requiredField['unit']]);
                
            }
            
        } else if ( isset($_POST['reset']) ) {
            unset($errors);   
        }

    ?>

    <?php include('partials/header.php'); ?>

        <div class="container">
            <div class="page-header">
                <h1><i class="fa fa-tint fa-fw"></i> Welcome to the Liquid Conversion Tool</h1>
            </div>

            <div class="page-content">
                <?php if (has_items($errors)) : ?>
                    <?php foreach ($errors as $error) : ?>
                        <?php foreach ($error as $message) : ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong> <?= $message ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="alert alert-success" role="alert">
                        <strong>Conversion Success!</strong>
                        <h2><?= $convertedValue['original_amount'] . ' ' . $convertedValue['from_unit'] . ' = ' . $convertedValue['converted_amount'] . ' ' . $convertedValue['to_unit'] ?></h2>
                    </div>
                <?php endif; ?>
                
                <a class="btn btn-primary" href="index.php"><i class="fa fa-long-arrow-left fa-fw"></i> Return to previous page</a>
            </div>
        </div>

    <?php include('partials/footer.php'); ?>