<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .form-container {
            min-height: 400px; 
        }
    </style>
</head>

<body>
    <div class="container form-container d-flex flex-column justify-content-center align-items-center mt-4">
        <form action="<?= site_url('/register')?>" method="post" class="w-100">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="fullname" class="form-control">
                <?php if(isset($errors['fullname'])): ?>
                <small class="text-danger"><?= $errors['fullname'] ?></small>
                <?php endif ?>   
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control">
                <?php if(isset($errors['username'])): ?>
                <small class="text-danger"><?= $errors['username'] ?></small>
                <?php endif ?>
                <?php if(isset($userror)): ?>
                    <small class="text-danger"><?= $userror ?></small>
                <?php endif ?>   
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control">
                <?php if(isset($errors['email'])): ?>
                <small class="text-danger"><?= $errors['email'] ?></small>
                <?php endif ?>
                <?php if(isset($emailerror)): ?>
                    <small class="text-danger"><?= $emailerror ?></small>
                <?php endif ?>       
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control">
                <?php if(isset($errors['password'])): ?>
                <small class="text-danger"><?= $errors['password'] ?></small>
                <?php endif ?>   
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
