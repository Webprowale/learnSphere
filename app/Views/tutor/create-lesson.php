<?= $this->extend('tutor/layout') ?>
<?= $this->section('control') ?>
<div class="container-fluid">

<!-- Page Heading -->
<div class="mb-4">
    <h4 class="fw-bold">Create Lessson</h4>
</div>

<!-- Content Row -->
<div class="container my-3 shadow rounded px-md-5 px-2 py-4 bg-white mt-5">
    <?php if(isset($message)): ?>
        <div class="alert alert-success" role="alert">
            <?= esc($message)?>
        </div>
    <?php endif; ?>
    <form method="post" action="<?=base_url('control/create-lesson') ?>" enctype="multipart/form-data">
        <div class="row">
        <div class="mb-3  rounded col-md-6">
            <label for="title" style="background-color: transparent;">Title</label>
            <input type="text" name="title" class="form-control text-black" placeholder="Title...">
            <?php if (isset($errors['title'])): ?>
            <small class="text-danger"><?= esc($errors['title']) ?></small>
        <?php endif; ?>
        </div>
        <div class="mb-3 rounded col-md-6">
            <label for="course_id" style="background-color: transparent;">Select Course</label>
            <select name="course_id" class="form-control text-black">
                <option value="">Select Course</option>
                <?php foreach($select as $course):?>
                  <option value="<?= $course['id']?>"><?= $course['title']?></option>
                <?php endforeach;?>
            </select>
            <?php if (isset($errors['course_id'])): ?>
            <small class="text-danger"><?= esc($errors['course_id']) ?></small>
        <?php endif; ?>
        </div>
        <div class="mb-3  rounded p-0 col-12">
            <label for="video" style="background-color: transparent;">Video</label>
            <input type="file" name="video"  class="form-control" placeholder="Course Image...">
            <?php if (isset($errors['video'])): ?>
            <small class="text-danger"><?= esc($errors['video']) ?></small>
        <?php endif; ?>
        </div>

        <input type="submit" name="register" value="Create" class=" col-md-2 mt-3 btn btn-primary text-white form-control b fs-5">
        </div>
    </form>

</div>

<!-- Content Row -->



<!-- Content Row -->

</div>
<?=$this->endSection(); ?>