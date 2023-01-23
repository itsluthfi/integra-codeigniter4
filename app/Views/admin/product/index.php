<?= $this->extend('admin/layout/template') ?>

<?= $this->section('style') ?>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Product List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Product List</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Product List
                </div>
                <div class="card-body">
                    <!-- Button trigger page -->
                    <a href="<?= base_url('product-list/add') ?>" class="btn btn-primary mb-2">
                        <i class="fas fa-plus"></i> Add Product
                    </a>
                    <!-- Show success notification alert -->
                    <div class="swal" data-swal="<?= session('success') ?>"></div>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($product as $products) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $products->product_name ?></td>
                                    <td><?= $products->category_slug ?></td>
                                    <td><?= $products->created_at ?></td>
                                    <td width="15%" class="text-center">
                                        <a href="<?= base_url('product-list/detail/' . $products->product_id) ?>" type="button" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail</a>
                                        <a href="<?= base_url('product-list/edit/' . $products->product_id) ?>" type="button" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="delete_product('<?= $products->product_id ?>')"><i class="fas fa-trash"></i> Delete</button>
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

        function delete_product(product_id) {
            Swal.fire({
                title: 'Delete Product',
                text: "Are you sure want to delete this product?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Delete',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('product-list/delete') ?>',
                        data: {
                            _method: 'delete',
                            <?= csrf_token() ?>: "<?= csrf_hash() ?>",
                            product_id: product_id,
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
                                        window.location.href = ' <?= base_url('product-list') ?>'
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