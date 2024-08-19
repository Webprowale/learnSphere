<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .form-container {
            min-height: 400px; 
        }
    </style>
</head>
<body>
    <div class="container form-container d-flex flex-column justify-content-center align-items-center mt-4">
        <form action="<?= site_url('/login')?>" method="post" class="w-100">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control">
                <?php if(isset($usererror)): ?>
                    <small class="text-danger"><?= $usererror ?></small>
                <?php endif ?>   
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control">
                <?php if(isset($passerror)): ?>
                <small class="text-danger"><?= $passerror ?></small>
                <?php endif ?>   
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
