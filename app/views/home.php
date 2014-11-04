<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="stylesheets/application.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <div class="text-center" id="panel">
                    <img src="<?php echo $user['profile_image']; ?>" class="img-circle img-thumbnail" />
                    <h4>Hello, <?php echo $user['name']; ?>!</h4>
                    <a href="disconnect" class="btn btn-primary btn-sm">Disconnect From Facebook</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>