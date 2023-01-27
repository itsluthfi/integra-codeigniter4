<?= $this->extend('admin/layout/template') ?>

<?= $this->section('style') ?>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Portfolio List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Portfolio List</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Portfolio List
                </div>
                <div class="card-body">
                    <!-- Button trigger page -->
                    <a href="<?= base_url('admin/portfolio/add') ?>" class="btn btn-primary mb-2">
                        <i class="fas fa-plus"></i> Add Portfolio
                    </a>
                    <!-- Show success notification alert -->
                    <div class="swal" data-swal="<?= session('success') ?>"></div>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Portfolio Name</th>
                                <th>Category</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($portfolio as $portfolios) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $portfolios->portfolio_name ?></td>
                                    <td><?= $portfolios->category_name ?></td>
                                    <td><?= $portfolios->created_at ?></td>
                                    <td width="15%" class="text-center">
                                        <a href="<?= base_url('admin/portfolio/detail/' . $portfolios->portfolio_id) ?>" type="button" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail</a>
                                        <a href="<?= base_url('admin/portfolio/edit/' . $portfolios->portfolio_id) ?>" type="button" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="delete_portfolio('<?= $portfolios->portfolio_id ?>')"><i class="fas fa-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?= $this->endSection() ?>

    <?= $this->section('script') ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const swal = $('.swal').data('swal');

        if (swal) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: swal,
                showConfirmButton: false,
                timer: 1900
            })
        }

        function delete_portfolio(portfolio_id) {
            Swal.fire({
                title: 'Delete Portfolio',
                text: "Are you sure want to delete this portfolio?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Delete',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('admin/portfolio/delete') ?>',
                        data: {
                            _method: 'delete',
                            <?= csrf_token() ?>: "<?= csrf_hash() ?>",
                            portfolio_id: portfolio_id,
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.success,
                                }).then((result) => {
                                    if (result.value) {
                                        window.location.href = ' <?= base_url('admin/portfolio') ?>'
                                    }
                                });
                            }
                        }
                    })
                }
            })
        }
    </script>
    <?= $this->endSection() ?>