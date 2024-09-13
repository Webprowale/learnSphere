<?= $this->extend('tutor/layout') ?>
<?= $this->section('control') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Lessons</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Course Title</th>
                            <th>video</th>
                            <th>Edit</th>
                            <th>Delete</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lessons as $row): ?>
                            <tr>
                                <td><?= $row['title'] ?></td>
                                <td><?= $row['course_title'] ?></td>
                                <td style="width: 200px; height: 200px; text-align: center;" class="pt-0">
                                    <video alt="<?= $row['title'] ?>" width="200" height="200" controls>
                                        <source src="<?= base_url() . $row['video'] ?>">
                                    </video>
                                </td>

                                <td><a href="<?= base_url('control/edit-course/' . $row['id']) ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                <td><a href="<?= base_url('control/delete-course/' . $row['id']) ?>"><i class="fa-solid fa-trash"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Content Row -->



    <!-- Content Row -->

</div>
<!-- /.container-fluid -->

</div>


</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
<?= $this->endSection(); ?>