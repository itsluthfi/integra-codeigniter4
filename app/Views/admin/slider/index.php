<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Slider</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Slider</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Slider
                </div>
                <div class="card-body">
                    <!-- Show success notification alert -->
                    <?php if (session('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session('success') ?>
                        </div>
                    <?php endif; ?>
                    <!-- Show failed notification alert -->
                    <?php if (session('failed')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session('failed') ?>
                        </div>
                    <?php endif; ?>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Slider Name</th>
                                <th>Description</th>
                                <th>Slider Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($slider as $sliders) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $sliders->slider_title ?></td>
                                    <td><?= $sliders->description ?></td>
                                    <td><img src="<?= base_url('assets-admin/img/' . $sliders->slider_image) ?>" alt="" width="50%"></td>
                                    <td width="15%" class="text-center">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $sliders->slider_id ?>"><i class="fas fa-edit"></i> Edit</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Edit Slider Modal -->
    <?php foreach ($slider as $sliders) : ?>
        <div class="modal fade" id="editModal<?= $sliders->slider_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Edit Slider</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('admin/slider/edit/' . $sliders->slider_id) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT" />
                            <input type="hidden" name="oldImage" value="<?= $sliders->slider_image ?>">

                            <div class="mb-3">
                                <label for="slider_title">Slider Title</label>
                                <input type="text" name="slider_title" id="slider_title" class="form-control <?= isset($validation['slider_title']) ? 'is-invalid' : '' ?>" value="<?= old('slider_title', $sliders->slider_title) ?>" required>

                                <?php if (isset($validation['slider_title'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('slider_title') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea type="text" cols="30" rows="5" name="description" id="description" class="form-control <?= isset($validation['slider_description']) ? 'is-invalid' : '' ?>" required>
                                <?= old('description', $sliders->description) ?>
                                </textarea>

                                <?php if (isset($validation['description'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('description') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="slider_image">Slider Image</label>
                                <input type="file" name="slider_image" id="slider_image" class="form-control <?= isset($validation['slider_image']) ? 'is-invalid' : '' ?>" onchange="previewImg()">

                                <?php if (isset($validation['slider_image'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('slider_image') ?>
                                    </div>
                                <?php endif; ?>

                                <img src="<?= base_url('assets-admin/img/' . $sliders->slider_image) ?>" alt="" class="preview-img mt-3" width="200">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?= $this->endSection() ?>

    <?= $this->section('script') ?>
    <script>
        function previewImg() {
            const image = document.querySelector('#slider_image');
            const previewImg = document.querySelector('.preview-img');

            const imageFile = new FileReader();
            imageFile.readAsDataURL(image.files[0]);

            imageFile.onload = function(e) {
                previewImg.src = e.target.result;
            }
        }
    </script>
    <?= $this->endSection() ?>