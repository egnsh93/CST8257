<?php

    // Extract the submitted data into variables
    $principalAmount = isset($_POST['principalAmount']) ? $_POST['principalAmount'] : '';
    $interestRate = isset($_POST['interestRate']) ? $_POST['interestRate'] : '';
    $depositDuration = isset($_POST['depositDuration']) ? $_POST['depositDuration'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $preferredContact = isset($_POST['preferredContact']) ? $_POST['preferredContact'] : '' ;
    $contactTime = isset($_POST['contactTimeChoice']) ? $_POST['contactTimeChoice'] : '';

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
