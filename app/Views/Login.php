<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <span class="text-center" id="alert"><?=session()->get("Alert");?></span>
        <div class="row">
            <form class="form-group" action="" method="POST">
                <div class="col-md-6 py-4 mx-auto">
                    <div class="card px-4 py-2">
                        <div class="fw-bold mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="fw-bold mb-3">
                            <label class="form-label">Password</label>
                            <input type="Password" class="form-control" name="username">
                        </div>
                        <div class="col-md-6 d-grid mx-auto">
                            <button class="btn btn-primary">SUBMIT</button>
                        </div>
                    </div>
                    <span><a style="text-decoration: none;" href="<?=base_url('forgotpassword')?>" class="fs-3 fw-normal">Forgot Password ?</a></span>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script>
    var timeout = 3000; // in miliseconds (3*1000)
    $("#alert").delay(timeout).fadeOut(300);
</script>