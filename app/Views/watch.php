<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>LearnSphere -Control Panel</title>
    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/control">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?= session()->get('firstname') ?></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/control">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Course</span></a>
                    <?php foreach ($course as $row): ?>
                    <h6 class="fw-bold text-center text-white"><?= $row['title']?></h6>
                    <?php endforeach;?>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Lesson
            </div>
            <?php foreach ($getLesson as $row): ?>
                <li class="nav-item">
                    <a class="nav-link " href="<?= base_url($link .'?lesson='.$row['id']) ?>">
                        <span><?= $row['title'] ?></span>
                    </a>

                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php if (isset($lesson)): ?>
                        <video controls autoplay controlsList='nodownload' class="img-fluid">
                            <source src="<?= $lesson['video'] ?>">
                        </video>
                        <?php else: ?>
                            <center class="mt-5">
                            <?php  foreach($course as $row)?>
                            <img src="<?= base_url($row['image'])?>" alt="<?= $row['title'] ?>" width="50%">
                            <h3 class="mt-2 fs-2 text-black"><?= $row['title']?></h3>
                        </center>
                    <?php endif; ?>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; LearnSphere</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>admin/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url() ?>admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url() ?>admin/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url() ?>admin/js/demo/chart-pie-demo.js"></script>
</body>

</html>