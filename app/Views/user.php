<!doctype html>
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

    <nav class="navbar navbar-expand-lg bg-white navbar-light justify-content-between shadow sticky-top p-0 pe-3">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary brand-logo"><i class="fa fa-book"></i>LearnSphere</h2>
        </a>
        <div class="dropdown me-md-3">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                J A
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Log Out</a></li>
            </ul>
        </div>
    </nav>
    <div class="main-content">
        <div class="nav-bar sticky-top-xl bg-white shadow-sm w-100 p-3">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="input-group mb-0">
                        <input type="text" class="form-control border-end-0 mb-0" placeholder="Search courses..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text sit border-start-0" id="basic-addon2"><i class="bi bi-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-container p-2 p-xl-4">

        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
                <h1 class="mb-5">Trending Courses</h1>
            </div>
            <div class="row g-4 align-items-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp shadow" data-wow-delay="0.1s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/design.jpg" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                <a href="<?= base_url() ?>buy" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Buy Now</a>
                            </div>
                        </div>
                        <div class="text-center p-4 pb-0">
                            <h3 class="mb-0">$30.00</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small>(123)</small>
                            </div>
                            <h5 class="mb-4">Basic Web Design and Deveopment</h5>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>10 Hrs</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>30 Students</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp shadow" data-wow-delay="0.3s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/node.jpg" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                <a href="<?= base_url() ?>/buy" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Buy Now</a>
                            </div>
                        </div>
                        <div class="text-center p-4 pb-0">
                            <h3 class="mb-0">$100.00</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small>(123)</small>
                            </div>
                            <h5 class="mb-4">Full Stack Development with Node.js</h5>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>20 Hrs</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>30 Students</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp shadow" data-wow-delay="0.5s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/data.jpg" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                <a href="<?= base_url() ?>/buy" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>
                            </div>
                        </div>
                        <div class="text-center p-4 pb-0">
                            <h3 class="mb-0">$19.00</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small>(123)</small>
                            </div>
                            <h5 class="mb-4">Data Science And Analytics</h5>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>9 Hrs</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>12 Students</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>