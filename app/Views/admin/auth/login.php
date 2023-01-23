<?= $this->extend('admin/auth/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Login</h3>
                    </div>
                    <div class="card-body">
                        <!-- alert message -->
                        <?= view('Myth\Auth\Views\_message_block') ?>

                        <form action="<?= url_to('login') ?>" method="post">
                            <?= csrf_field() ?>

                            <?php if ($config->validFields === ['email']) : ?>
                                <div class="form-floating mb-3">
                                    <input class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" type="email" placeholder="<?= lang('Auth.email') ?>" />
                                    <label for="login"><?= lang('Auth.email') ?></label>
                                    <div class="invalid-feedback">
                                        <?= session('errors.login') ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="form-floating mb-3">
                                    <input class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" type="text" placeholder="<?= lang('Auth.emailOrUsername') ?>" />
                                    <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
                                </div>
                                <div class=" invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            <?php endif; ?>
                            <div class=" form-floating mb-3">
                                <input class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" name="password" type="password" placeholder="<?= lang('Auth.password') ?>" />
                                <label for="password"><?= lang('Auth.password') ?></label>
                                <div class="invalid-feedback">
                                    <?= session('errors.password') ?>
                                </div>
                            </div>
                            <?php if ($config->allowRemembering) : ?>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" name="remember" type="checkbox" <?php if (old('remember')) : ?> checked <?php endif ?> />
                                    <label class="form-check-label" for="inputRememberPassword"><?= lang('Auth.rememberMe') ?></label>
                                </div>
                            <?php endif; ?>
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="<?= base_url('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="<?= base_url('register') ?>"><?= lang('Auth.needAnAccount') ?></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>