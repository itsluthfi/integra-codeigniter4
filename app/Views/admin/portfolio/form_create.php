<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Add Portfolio</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="<?= base_url('admin/portfolio') ?>">Portfolio List</a></li>
                <li class="breadcrumb-item active">Add Portfolio</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Add Portfolio
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
                    <form action="<?= base_url('admin/portfolio/add/store') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="portfolio_name">Portfolio Name</label>
                                <input type="text" name="portfolio_name" id="portfolio_name" class="form-control 
                                    <?= isset($validation['portfolio_name']) ? 'is-invalid' : '' ?>" value="<?= old('portfolio_name') ?>">

                                <?php if (isset($validation['portfolio_name'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('portfolio_name') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="category_name">Category</label>
                                <select name="category_name" id="category_name" class="form-control
                                    <?= isset($validation['category_name']) ? 'is-invalid' : '' ?>">
                                    <option value="" hidden>--Select--</option>
                                    <?php foreach ($category as $categories) : ?>
                                        <?php if (old('category_name') == $categories->category_name) : ?>
                                            <option value="<?= $categories->category_name ?>" selected><?= $categories->category_name ?></option>
                                        <?php else : ?>
                                            <option value="<?= $categories->category_name ?>"><?= $categories->category_name ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>

                                <?php if (isset($validation['category_name'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('category_name') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="portfolio_client">Portfolio Client</label>
                                <input type="text" name="portfolio_client" id="portfolio_client" class="form-control 
                                    <?= isset($validation['portfolio_client']) ? 'is-invalid' : '' ?>" value="<?= old('portfolio_client') ?>">

                                <?php if (isset($validation['portfolio_client'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('portfolio_client') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="portfolio_date">Portfolio Date</label>
                                <input type="date" name="portfolio_date" id="portfolio_date" class="form-control 
                                    <?= isset($validation['portfolio_date']) ? 'is-invalid' : '' ?>" value="<?= old('portfolio_date') ?>">

                                <?php if (isset($validation['portfolio_date'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('portfolio_date') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control
                                <?= isset($validation['description']) ? 'is-invalid' : '' ?>"><?= old('description') ?></textarea>

                            <?php if (isset($validation['description'])) : ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('description') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="portfolio_image">Portfolio Image</label>
                            <input type="file" name="portfolio_image" id="portfolio_image" class="form-control
                                <?= isset($validation['portfolio_image']) ? 'is-invalid' : '' ?>" onchange="previewImg()">

                            <?php if (isset($validation['portfolio_image'])) : ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('portfolio_image') ?>
                                </div>
                            <?php endif; ?>

                            <img src="" alt="" class="preview-img mt-3" width="200">
                        </div>
                        <div class="justify-content-end d-flex">
                            <button class="btn btn-primary">Add Portfolio</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>

    <?= $this->endSection() ?>

    <?= $this->section('script') ?>
    <script src="//cdn.ckeditor.com/4.20.1/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
    <script>
        function previewImg() {
            const image = document.querySelector('#portfolio_image');
            const previewImg = document.querySelector('.preview-img');

            const imageFile = new FileReader();
            imageFile.readAsDataURL(image.files[0]);

            imageFile.onload = function(e) {
                previewImg.src = e.target.result;
            }
        }
    </script>
    <?= $this->endSection() ?>