<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Product List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="<?= base_url('admin/product-list') ?>">Product List</a></li>
                <li class="breadcrumb-item active">Detail Product</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Detail Product: <span class="fw-bold"><?= $product->product_name ?>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Product Name</th>
                            <td><?= $product->product_name ?></td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td><?= $product->category_slug ?></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><?= $product->description ?></td>
                        </tr>
                        <tr>
                            <th>Product Image</th>
                            <td><img src="<?= base_url('assets-admin/img/' . $product->product_image) ?>" alt="" width="50%"></td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td><?= $product->created_at ?></td>
                        </tr>
                    </table>
                    <div class="justify-content-end d-flex">
                        <a href="<?= base_url('admin/product-list') ?>" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?= $this->endSection() ?>