<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>LearnSphere - Learn All Possibities Online</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url() ?>/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url() ?>/css/style.css" rel="stylesheet">
</head>

<body>


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary brand-logo"><i class="fa fa-book me-3"></i>LearnSphere</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="<?= base_url() ?>" class="nav-item nav-link">Home</a>
                <a href="<?= base_url() ?>about" class="nav-item nav-link">About</a>
                <a href="<?= base_url() ?>course" class="nav-item nav-link">Courses</a>
                <a href="<?= base_url() ?>contact" class="nav-item nav-link">Contact</a>
            </div>
            <a href="<?= base_url() ?>register" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Join Now<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->
    <div class="container my-3 shadow rounded px-md-5 px-2 py-4" style="max-width: 30rem;">
      <div class="text-center mb-5">
        <h5 class="fs-3 fw-bold">Register</h5>
        <p class="fw-semibold mb-1">Your Dream Of Becoming An Digital Instructor</p>
      </div>
      <form method="post" action="<?= base_url('reg') ?>">
    <div class="d-md-flex">
        <div class="form-floating mb-3 shadow rounded" style="background-color: transparent;">
            <input type="text" name="firstname" value="<?= old('firstname') ?>" class="form-control text-black" id="floatingInput" placeholder="Enter First Name..." style="background-color: transparent;">
            <label for="floatingInput" style="background-color: transparent;">First Name...</label>
            <?php if (isset($errors['firstname'])): ?>
                <small class="text-danger"><?= esc($errors['firstname']) ?></small>
            <?php endif; ?>
        </div>
        
        <div class="form-floating mb-3 shadow rounded" style="background-color: transparent;">
            <input type="text" name="lastname" value="<?= old('lastname') ?>" class="form-control text-black" id="floatingInput" placeholder="Enter Last Name..." style="background-color: transparent;">
            <label for="floatingInput" style="background-color: transparent;">Last Name...</label>
            <?php if (isset($errors['lastname'])): ?>
                <small class="text-danger"><?= esc($errors['lastname']) ?></small>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-floating mb-3 shadow rounded" style="background-color: transparent;">
        <input type="email" name="email" value="<?= old('email') ?>" class="form-control text-black" id="floatingInput" placeholder="name@example.com" style="background-color: transparent;">
        <label for="floatingInput" style="background-color: transparent;">Email address...</label>
        <?php if (isset($errors['email'])): ?>
            <small class="text-danger"><?= esc($errors['email']) ?></small>
        <?php endif; ?>
    <?php if(isset($emailerror)): ?>
        <small><?= esc($emailerror)?></small>
        <?php endif;?>
    </div>
    <input type="hidden" name="role" value="tutor">
    <div class="form-floating mb-1 shadow rounded" style="background-color: transparent;">
        <input type="password" name="password" id="password" class="form-control text-black" placeholder="Enter password..." style="background-color: transparent;">
        <label for="floatingInput" style="background-color: transparent;">Password...</label>
        <?php if (isset($errors['password'])): ?>
            <small class="text-danger"><?= esc($errors['password']) ?></small>
        <?php endif; ?>
    </div>

    <div class="mb-4">
        <input type="checkbox" id="togglePassword" class="toggle-password ms-2">
        <label for="togglePassword">Show Password</label>
    </div>

    <input type="submit" name="signup" value="Register" class="btn bg-info text-white form-control b fs-5">
</form>

      <div class="mt-4">
        <p>Already a member<span class=" fs-5 text-primary"></span>
          <a href="<?=base_url('login') ?>">Login</a>
        </p>
      </div>
    </div>


    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="<?= base_url() ?>about">About Us</a>
                    <a class="btn btn-link" href="<?= base_url() ?>contact">Contact Us</a>
                    <a class="btn btn-link" href="<?= base_url() ?>course">Avaible Courses</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">FAQs & Help</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>89 ronload, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@learnsphere.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
              
                <div class=" col-md-6">
                    <h4 class="text-white mb-3">Newsletter</h4>
                    <p>Receive Early Morning Tips to Enhance Your Learning</p>
                    <div class="position-relative" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="submit" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="<?= base_url() ?>">LearnSphere</a>, All Right Reserved.

                        
                        Developed By <a class="border-bottom" target="_blank" href="https://webprowale.netlify.app/">Webprowale</a><br><br>
                        
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="<?= base_url() ?>">Home</a>
                            <a href="<?=base_url() ?>">Help</a>
                            <a href="<?=base_url() ?>">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- JavaScript Libraries -->
     <script src="<?=base_url() ?>https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="<?=base_url() ?>https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url() ?>lib/wow/wow.min.js"></script>
    <script src="<?=base_url() ?>lib/easing/easing.min.js"></script>
    <script src="<?=base_url() ?>lib/waypoints/waypoints.min.js"></script>
    <script src="<?=base_url() ?>lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?=base_url() ?>js/main.js"></script>
</body>
</html>
