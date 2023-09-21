<?= $this->extend('layout/auth-login-dosen')?>

<?= $this->section('content')?>
<div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <?php
            if (session()->getFlashdata('msg')) {
              echo '<div class="alert alert-danger" role="alert">';
              echo session()->getFlashdata('msg');
              echo '</div>';
            }
            ?>
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="<?= base_url()?>images/logo.svg" alt="logo">
              </div>
              <h4>Hello! Selamat Datang</h4>
              <h6 class="fw-light">Silahkan masuk</h6>
              <form class="pt-3" method="POST" action="<?=base_url('dosen/auth')?>">
              <?= csrf_field()?>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="password" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                  <a href="<?=base_url('login')?>" class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn">Sebagai Admin</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<?= $this->endSection()?>