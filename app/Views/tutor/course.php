<?= $this->extend('tutor/layout') ?>
<?= $this->section('control') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Voters</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Edit</th>
                            <th>Delete</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($courses as $row): ?>
                            <tr>
                                <td><?= $row['title'] ?></td>
                                <td><?= $row['description'] ?></td>
                                <td><img src="<?=base_url().$row['image'] ?>" alt="<?= $row['title'] ?>" width="100" height="100"></td>
                                <td><?= $row['category'] ?></td>
                                <td><?= $row['price'] ?></td>
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