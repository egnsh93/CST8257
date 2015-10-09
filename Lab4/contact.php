<?php include('partials/header.php'); ?>

    <div class="container">
        <div class="page-header">
            <h1><i class="fa fa-map fa-fw"></i> Contact Us</h1>
        </div>

        <div class="page-content">
            <div class="col-sm-8">
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Your name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Your email address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="message" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Send Email</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-sm-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Additional Information</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="fa-ul">
                            <li><i class="fa-li fa fa-map-marker fa-fw"></i>1385 Woodroffe Av, Ottawa, ON</li>
                            <li><i class="fa-li fa fa-phone fa-fw"></i>(613) 555-5555</li>
                            <li><i class="fa-li fa fa-envelope fa-fw"></i>shane@example.com</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php include('partials/footer.php'); ?>