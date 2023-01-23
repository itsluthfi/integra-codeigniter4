<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Product</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="<?= base_url('product-list') ?>">Product List</a></li>
                <li class="breadcrumb-item active">Edit Product</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Edit Product
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
                    <form action="<?= base_url('product-list/edit/' . $product->product_id . '/update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="oldImage" value="<?= $product->product_image ?>">

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="product_name">Product Name</label>
                                <input type="text" name="product_name" id="product_name" class="form-control 
                                    <?= isset($validation['product_name']) ? 'is-invalid' : '' ?>" value="<?= old('product_name', $product->product_name) ?>">

                                <?php if (isset($validation['product_name'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('product_name') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="category_slug">Category</label>
                                <select name="category_slug" id="category_slug" class="form-control
                                    <?= isset($validation['category_slug']) ? 'is-invalid' : '' ?>">
                                    <option value="" hidden>--Select--</option>
                                    <?php foreach ($category as $categories) : ?>
                                        <?php if (old('category_slug', $product->category_slug) == $categories->category_slug) : ?>
                                            <option value="<?= $categories->category_slug ?>" selected><?= $categories->category_name ?></option>
                                        <?php else : ?>
                                            <option value="<?= $categories->category_slug ?>"><?= $categories->category_name ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>

                                <?php if (isset($validation['category_slug'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('category_slug') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control
                                <?= isset($validation['description']) ? 'is-invalid' : '' ?>"><?= old('description', $product->description) ?></textarea>

                            <?php if (isset($validation['description'])) : ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('description') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="product_image">Product Image</label>
                            <input type="file" name="product_image" id="product_image" class="form-control
                                <?= isset($validation['product_image']) ? 'is-invalid' : '' ?>" onchange="previewImg()">

                            <?php if (isset($validation['product_image'])) : ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('product_image') ?>
                                </div>
                            <?php endif; ?>

                            <!-- #error# image not showing, still figure it out -->
                            <img src="<?= base_url('assets-admin/img/' . $product->product_image) ?>" alt="" class="preview-img mt-3" width="200">
                        </div>
                        <div class="justify-content-end d-flex">
                            <button class="btn btn-primary me-2">Edit Product</button>
                            <a href="<?= base_url('product-list') ?>" class="btn btn-secondary">Back</a>
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
            const image = document.querySelector('#product_image');
            const previewImg = document.querySelector('.preview-img');

            const imageFile = new FileReader();
            imageFile.readAsDataURL(image.files[0]);

            imageFile.onload = function(e) {
                previewImg.src = e.target.result;
            }
        }
    </script>
    <?= $this->endSection() ?>