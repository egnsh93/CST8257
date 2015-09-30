<?php
    $menuChoice = isset($_POST["menuChoice"]) ? $_POST["menuChoice"] : '';

    switch ($menuChoice)
    {
        case 1:
            header("Location: for.php");
            die();
            break;

        case 2:
            header("Location: foreach.php");
            die();
            break;

        case 3:
            header("Location: while.php");
            die();
            break;
    }
?>

    <? include("includes/head.html"); ?>
        <div class="panel">
            <ol>
                <li>Please enter number 1 to check for loop operation</li>
                <li>Please enter number 2 to check foreach loop operation</li>
                <li>Please enter number 3 to check while loop operation</li>
            </ol>

            <form class="form-inline menu-form" action="" method="post">
                <div class="form-group">
                    <label class="sr-only" for="menuChoice">Menu choice</label>
                    <input name="menuChoice" type="text" class="form-control input-hg" placeholder="Enter 1, 2, or 3" required autofocus>
                </div>
                <button type="submit" class="btn btn-hg btn-success">Submit</button>
            </form>
        </div>

        <? include("includes/foot.html"); ?>
