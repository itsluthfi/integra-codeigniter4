<?= $this->extend('user/home/layout') ?>

<?= $this->section('content') ?>

<body>
    <main id="main">
        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Inner Page</h2>
                    <ol>
                        <li><a href="<?= base_url('home') ?>">Home</a></li>
                        <li>Inner Page</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs Section -->

        <section class="inner-page">
            <div class="container">
                <p>
                    Example inner page template
                </p>
            </div>
        </section>

    </main><!-- End #main -->

    <?= $this->endSection() ?>