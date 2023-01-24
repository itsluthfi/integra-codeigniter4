<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Account</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Account</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Account
                </div>
                <div class="card-body">
                    <a type="button" href="<?= base_url('register') ?>" class="btn btn-primary mb-2">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                    <?php if (session('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session('success') ?>
                        </div>
                    <?php endif; ?>

                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($data_account as $account) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $account->email ?></td>
                                    <td><?= $account->username ?></td>
                                    <td><?= $account->created_at ?></td>
                                    <td width="15%" class="text-center">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $account->id ?>"><i class="fas fa-edit"></i> Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $account->id ?>"><i class="fas fa-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Edit Account Modal -->
    <?php foreach ($data_account as $account) : ?>
        <div class="modal fade" id="editModal<?= $account->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Edit Account</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('admin/account/edit/' . $account->id) ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?= $account->email ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?= $account->username ?>" required>
                        </div>
                        <a href="<?= base_url('forgot') ?>" class="small">Reset password</a>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Delete Account Modal -->
    <?php foreach ($data_account as $account) : ?>
        <div class="modal fade" id="deleteModal<?= $account->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash"></i> Delete Account</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('admin/account/delete/' . $account->id) ?>
                        <input type="hidden" name="_method" value="DELETE" />
                        <div class="mb-3">
                            <p>Are you sure to delete this account? <br /> Email: <span class="fw-bold"><?= $account->email ?></span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?= $this->endSection() ?>