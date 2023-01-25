<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Team</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Team</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Team
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
                                <th>Name</th>
                                <th>Position</th>
                                <th>Facebook</th>
                                <th>Instagram</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($team as $teams) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $teams->team_name ?></td>
                                    <td><?= $teams->team_position ?></td>
                                    <td><?= $teams->team_fb ?></td>
                                    <td><?= $teams->team_ig ?></td>
                                    <td><img src="<?= base_url('assets-admin/img/' . $teams->team_photo) ?>" alt="" width="50%"></td>
                                    <td width="15%" class="text-center">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $teams->team_id ?>"><i class="fas fa-edit"></i> Edit</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Edit Team Modal -->
    <?php foreach ($team as $teams) : ?>
        <div class="modal fade" id="editModal<?= $teams->team_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Edit Team</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('admin/team/edit/' . $teams->team_id) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT" />
                            <input type="hidden" name="oldImage" value="<?= $teams->team_photo ?>">

                            <div class="mb-3">
                                <label for="team_name">Team Name</label>
                                <input type="text" name="team_name" id="team_name" class="form-control <?= isset($validation['team_name']) ? 'is-invalid' : '' ?>" value="<?= old('team_name', $teams->team_name) ?>" required>

                                <?php if (isset($validation['team_name'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('team_name') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="team_position">Team Position</label>
                                <input type="text" name="team_position" id="team_position" class="form-control <?= isset($validation['team_position']) ? 'is-invalid' : '' ?>" value="<?= old('team_position', $teams->team_position) ?>" required>

                                <?php if (isset($validation['team_position'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('team_position') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="team_fb">Facebook</label>
                                    <input type="text" name="team_fb" id="team_fb" class="form-control <?= isset($validation['team_fb']) ? 'is-invalid' : '' ?>" value="<?= old('team_fb', $teams->team_fb) ?>" required>

                                    <?php if (isset($validation['team_fb'])) : ?>
                                        <div class="invalid-feedback">
                                            <?= validation_show_error('team_fb') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="team_ig">Instagram</label>
                                    <input type="text" name="team_ig" id="team_ig" class="form-control <?= isset($validation['team_ig']) ? 'is-invalid' : '' ?>" value="<?= old('team_ig', $teams->team_ig) ?>" required>

                                    <?php if (isset($validation['team_ig'])) : ?>
                                        <div class="invalid-feedback">
                                            <?= validation_show_error('team_ig') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="team_photo">Team Photo</label>
                                <input type="file" name="team_photo" id="team_photo" class="form-control <?= isset($validation['team_photo']) ? 'is-invalid' : '' ?>" onchange="previewImg()">

                                <?php if (isset($validation['team_photo'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('team_photo') ?>
                                    </div>
                                <?php endif; ?>

                                <img src="<?= base_url('assets-admin/img/' . $teams->team_photo) ?>" alt="" class="preview-img mt-3" width="200">
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
            const image = document.querySelector('#team_photo');
            const previewImg = document.querySelector('.preview-img');

            const imageFile = new FileReader();
            imageFile.readAsDataURL(image.files[0]);

            imageFile.onload = function(e) {
                previewImg.src = e.target.result;
            }
        }
    </script>
    <?= $this->endSection() ?>