<?php

    /* Start the session */
    session_start();

    $submitted = false;
    $append = false;

    /* Define the session variable */
    $clientInfo = isset($_SESSION['clientInfo']) ? $_SESSION['clientInfo'] : [];

    /* If the append button has been clicked */
    if (isset($_POST['append'])) {

        /* Get the submission data */
        $clientID = isset($_POST['clientID']) ? $_POST['clientID'] : '';
        $amount = isset($_POST['amount']) ? $_POST['amount'] : '';

        /* Add the data to an associative array */
        $_SESSION['clientInfo'][$clientID] = $amount;

        $append = true;

    /* If the submit button has been clicked */
    } else if (isset($_POST['submit'])) {

        /* Sort data in acsending order based on value (amount) */
        $_SESSION['clientInfo'] = asort($clientInfo);

        /* Set the submitted flag to true */
        $submitted = true;

    /* If the destroy session button has been clicked */
    } else if (isset($_POST['destroy'])) {
        session_destroy();
    }

?>

    <? include("includes/head.html"); ?>

            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label for="clientID" class="col-sm-2 control-label">Client ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="clientID" placeholder="Enter client ID" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="amount" class="col-sm-2 control-label">Amount</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="amount" placeholder="Enter amount">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button name="append" type="submit" class="btn btn-info">Append</button>
                        <button name="submit" type="submit" class="btn btn-success">Submit</button>
                        <button name="destroy" type="submit" class="btn btn-danger">Destroy Session</button>
                    </div>
                </div>
                <hr>
            </form>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($append) : ?>
                        <?php foreach($_SESSION['clientInfo'] as $key => $value) : ?>
                            <tr>
                                <td><?= $key; ?></td>
                                <td><?= $value; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php if ($submitted) : ?>

                <?php $i = 1; while ($i > 0) : $i-- ?>
                    <?php $value = end($clientInfo); ?>
                    <?php $key = array_search($value, $clientInfo); ?>
                <?php endwhile; ?>

                <h5>Highest Paying Client</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Client ID</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $key; ?></td>
                            <td><?= $value; ?></td>
                        </tr>
                    </tbody>
                </table>

            <?php endif; ?>

        <? include("includes/foot.html"); ?>
