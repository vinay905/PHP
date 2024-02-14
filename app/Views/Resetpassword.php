<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    body
    {
        background-color: #46aadb;
    }
</style>
<body>
<div class="container my-5">
    <h1 class="text-center text-light">Reset Your Password</h1>
    <span class="text-center"><?=session()->get("Error");?></span>
<div class="row">
<div class="col-md-6 mx-auto">
            <form class="form-group" method="post" action="<?=base_url('changepassword/'.$Id)?>">
            <div class="card px-4 py-2">
                <div class="fw-bold mb-3">
                    <label class="form-label">Reset Code</label>
                    <input type="text" class="form-control" name="resetcode" required>
                </div>
                <div class="fw-bold mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" name="Password" required>
                </div>
                <div class="fw-bold mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="Password" class="form-control" name="confirmpass" required>
                </div>
                <div class="col-md-6 d-grid mx-auto">
                    <button class="btn btn-primary">SUBMIT</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>