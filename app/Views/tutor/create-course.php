<?= $this->extend('tutor/layout') ?>
<?= $this->section('control') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="mb-4">
        <h4 class="fw-bold">Create Course</h4>
    </div>

    <!-- Content Row -->
   <div class="container my-3 shadow rounded px-md-5 px-2 py-4 bg-white mt-5">
    <?php if (isset($message)): ?>
        <div class="alert alert-success" role="alert">
            <?= esc($message) ?>
        </div>
    <?php endif; ?>
    <form method="post" action="<?= base_url('control/en') ?>" enctype="multipart/form-data">
        <div class="row">
            <div class="mb-3 rounded col-md-6">
                <label for="title" style="background-color: transparent;">Title</label>
                <input type="text" name="title" class="form-control text-black" placeholder="Title...">
                <?php if (isset($errors['title'])): ?>
                    <small class="text-danger"><?= esc($errors['title']) ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-3 rounded col-md-6">
                <label for="description" style="background-color: transparent;">Description</label>
                <input type="text" name="description" class="form-control text-black" placeholder="Course Description...">
                <?php if (isset($errors['description'])): ?>
                    <small class="text-danger"><?= esc($errors['description']) ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-3 rounded col-md-6">
                <label for="price" style="background-color: transparent;">Price</label>
                <input type="number" name="price" class="form-control text-black" placeholder="Course price...">
                <?php if (isset($errors['price'])): ?>
                    <small class="text-danger"><?= esc($errors['price']) ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-3 rounded col-md-6">
                <label for="category" style="background-color: transparent;">Category</label>
                <input type="text" name="category" class="form-control text-black" placeholder="Course Category...">
                <?php if (isset($errors['category'])): ?>
                    <small class="text-danger"><?= esc($errors['category']) ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-3 rounded p-0 col-12">
                <label for="image" style="background-color: transparent;">Image</label>
                <input type="file" name="image" class="form-control">
                <?php if (isset($errors['image'])): ?>
                    <small class="text-danger"><?= esc($errors['image']) ?></small>
                <?php endif; ?>
            </div>
            

            <input type="submit" name="register" value="Create" class="col-md-2 mt-3 btn btn-primary text-white form-control fs-5">
        </div>
    </form>
</div>


    <!-- Content Row -->



    <!-- Content Row -->

</div>
<?= $this->endSection(); ?>