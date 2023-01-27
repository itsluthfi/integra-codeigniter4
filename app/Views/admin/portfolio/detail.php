<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Portfolio List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="<?= base_url('admin/portfolio') ?>">Portfolio List</a></li>
                <li class="breadcrumb-item active">Detail Portfolio</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Detail Portfolio: <span class="fw-bold"><?= $portfolio->portfolio_name ?>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Portfolio Name</th>
                            <td><?= $portfolio->portfolio_name ?></td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td><?= $portfolio->category_name ?></td>
                        </tr>
                        <tr>
                            <th>Portfolio Client</th>
                            <td><?= $portfolio->portfolio_client ?></td>
                        </tr>
                        <tr>
                            <th>Portfolio Date</th>
                            <td><?= $portfolio->portfolio_date ?></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><?= $portfolio->description ?></td>
                        </tr>
                        <tr>
                            <th>Portfolio Image</th>
                            <td><img src="<?= base_url('assets-admin/img/' . $portfolio->portfolio_image) ?>" alt="" width="50%"></td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td><?= $portfolio->created_at ?></td>
                        </tr>
                    </table>
                    <div class="justify-content-end d-flex">
                        <a href="<?= base_url('admin/portfolio') ?>" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?= $this->endSection() ?>