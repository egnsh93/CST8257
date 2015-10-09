    <?php include('partials/header.php'); ?>

    <div class="container">
        <div class="page-header">
            <h1><i class="fa fa-tint fa-fw"></i> Welcome to the Liquid Conversion Tool</h1>
        </div>

        <div class="page-content">
            <p>This tool supports the conversion of <strong><em>Litres to Gallons</em></strong> and <strong><em>Gallons to Litres</em></strong></p>
            <br>

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Conversion Tool</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="converter.php" method="post">
                        <div class="form-group">
                            <label for="amount" class="col-sm-2 control-label">Conversion Amount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="amount" placeholder="Enter amount to convert">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unit" class="col-sm-2 control-label">Convert to</label>
                            <div class="col-sm-10">
                                <select name="unit" class="form-control">
                                    <option value="default">Select Unit</option>
                                    <option value="litres">Litres</option>
                                    <option value="gallons">Gallons</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" name="convert" class="btn btn-primary">Convert</button>
                                <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('partials/footer.php'); ?>