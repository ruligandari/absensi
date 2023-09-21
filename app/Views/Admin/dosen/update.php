<?= $this->extend('layout/dashboard-admin')?>

<?= $this->section('content')?>
<div class="content-wrapper">
  <div class="row">
    <div class="col-sm-12">
      <div class="home-tab">
        <div class="tab-content tab-content-basic">
          <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
            <div class="row">
              <div class="col-lg-17 d-flex flex-column">
                <div class="row ">
                  <div class="col-17 grid-margin stretch-card">
                    <div class="card card-rounded">
                      <div class="card-body">
                        <div class="d-sm-flex justify-content-center align-items-start">
                          <div>
                            <h4 class="card-title card-title-dash">Input Data Dosen</h4>
                          </div>
                        </div>
                        <div class="d-flex justify-content-center">
                        </div>
                        <form action="<?=base_url('admin/dosen/update/'.$dosen['id_dosen']);?>" method="post">
                        <div class="row">
                          <div class="form-group">
                            <label>NIP</label>
                            <input type="text" class="form-control" name="nip" value="<?=$dosen['nip']?>">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <label>Nama Dosen</label>
                            <input type="text" class="form-control" name="nama" value="<?=$dosen['nama']?>">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?=$dosen['email']?>">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <label>Password</label>
                            <input type="text" class="form-control" name="password" value="<?=$dosen['password']?>">
                          </div>
                          <div class="form-group">
                            <label>Password Baru</label>
                            <input type="text" class="form-control" name="password_baru" value="">
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button> &nbsp;
                          </div>
                        </div>
                        </form>
                      </div>
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection()?>