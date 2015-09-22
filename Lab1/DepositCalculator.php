<?php

    /* Get POST data and run it through a function that cleans user input */
    $principalAmount = clean_input($_POST['principalAmount']);
    $interestRate = clean_input($_POST['interestRate']);
    $depositDuration = $_POST['depositDuration'];
    $name = clean_input($_POST['name']);
    $phone = clean_input($_POST['phone']);
    $email = clean_input($_POST['email']);
    $preferredContact = $_POST['preferredContact'];
    $contactTime = $_POST['contactTimeChoice'];

    /* This function cleans input fields and ensures safe submission */
    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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
        <h2><strong>Thank you, <?= $name ?> for using our deposit calculator</strong></h2>
        <p>You have entered the following data</p>
        <table class="pure-table">
            <tr class="pure-table-odd">
                <td>Principal Amount:</td>
                <td>
                    <?= $principalAmount ?>
                </td>
            </tr>

            <tr>
                <td>Interest Rate:</td>
                <td>
                    <?= $interestRate ?>
                </td>
            </tr>

            <tr class="pure-table-odd">
                <td>Deposit Duration:</td>
                <td>
                    <?= $depositDuration ?>
                </td>
            </tr>

            <tr>
                <td>Name:</td>
                <td>
                    <?= $name ?>
                </td>
            </tr>

            <tr class="pure-table-odd">
                <td>Phone:</td>
                <td>
                    <?= $phone ?>
                </td>
            </tr>

            <tr>
                <td>Email:</td>
                <td>
                    <?= $email ?>
                </td>
            </tr>

            <tr class="pure-table-odd">
                <td>Preferred Contact Method:</td>
                <td>
                    <?= $preferredContact ?>
                </td>
            </tr>

            <tr>
                <td>Preferred Contact Time:</td>
                <td>
                    <?= implode(", ", $contactTime) ?>
                </td>
            </tr>
        </table>

        <p>Click <a href="index.html">here</a> to return to the following page</p>
    </div>
</body>

</html>
