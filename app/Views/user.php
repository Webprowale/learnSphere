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
            <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= strtoupper(substr(session()->get('firstname'), 0, 1)) ?>.<?= strtoupper(substr(session()->get('lastname'), 0, 1)) ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item">Settings</a></li>
                <li><a class="dropdown-item" href="<?= base_url() ?>user/logout">Log Out</a></li>
            </ul>
        </div>
    </nav>
    <div class="main-content">
        <div class="nav-bar sticky-top-xl bg-white shadow-sm w-100 p-3">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="input-group mb-0">
                        <input type="text" id="search" class="form-control  mb-0" placeholder="Search courses...">
                    </div>
                </div>
            </div>
        </div>
        <div class="section-container p-2 p-xl-4 pt-5">
    <div id="result"></div>
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
                    <h1 class="mb-5">Trending Courses</h1>
                </div>
                <div class="row g-4 align-items-center">
                    <?php foreach($course as $row): ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp shadow" data-wow-delay="0.3s">
                        <div class="course-item bg-light">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid" src="<?=$row['image'] ?>" alt="">
                                <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                    <a href="<?= base_url() ?>user/buy/<?=$row['id'] ?>" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Buy Now</a>
                                </div>
                            </div>
                            <div class="text-center p-4 pb-0">
                                <h3 class="mb-0">$<?=$row['price'] ?></h3>
                                <div class="mb-3">
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small>(123)</small>
                                </div>
                                <h5 class="mb-4"><?=$row['title'] ?></h5>
                                <div class="d-flex border-top">
                                <small class="flex-fill text-center py-2"><?= $row['category']?></small>
                                <!-- <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>12 Students</small> -->
                            </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                  
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
    <script>
    
    document.addEventListener('DOMContentLoaded', function() {
    var search = document.getElementById('search');
    var result = document.getElementById('result');

    search.addEventListener('input', async function() {
        var query = search.value;
        if (query === '') {
            result.innerHTML = '';
            return;
        }
      try{
      const response = await fetch('/user/live-search?query=' + encodeURIComponent(query), { headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
       } });
      const data = await response.json();
      if(!data.html == 0){
        result.innerHTML = data.html;
      }
      }catch(err){
        result.innerHTML = '<p class="text-danger">Failed to fetch data.</p>';
        return;
      }
    
});
}); 


      
</script>
</body>
</html>