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
                        <div class="d-sm-flex justify-content-between align-items-start mb-3">
                          
                            <a class="btn btn-primary text-white" href="<?= base_url('admin/data-mahasiswa')?>"><i class="mdi mdi-arrow-left"></i></a>
                              <h4 class="card-title card-title-dash mt-2">Input Data Mahasiswa</h4>
                              <h4 class="card-title card-title-dash"></h4>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-center">
                        </div>
                        <form action="<?=base_url('admin/mahasiswa/save');?>" method="post">
                        <div class="row col-4">
                          <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" name="nim">
                          </div>
                        </div>
                        <div class="row col-6">
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama">
                          </div>
                        </div>
                        <div class="row col-4">
                          <div class="form-group">
                            <label>Kelas</label>
                            <select name="id_kelas" class="form-control">
                              <option value="#">Silahkan Pilih</option>
                              <?php foreach($kelas as $kelas):?>
                                <option value="<?=$kelas['id_kelas']?>"><?=$kelas['kelas']?></option>
                              <?php endforeach?>
                            </select>
                          </div>
                        </div>
                        <div class="row col-4">
                          <div class="form-group">
                            <label>Jurusan</label>
                            <select name="jurusan" class="form-control">
                              <option value="#">Silahkan Pilih</option>
                              <option value="Teknik Informatika">Teknik Informatika</option>
                            </select>
                          </div>
                        </div>
                        <div class="row col-4">
                          <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                              <option value="#">Silahkan Pilih</option>
                              <option value="L">Laki-Laki</option>
                              <option value="P">Perempuan</option>
                            </select>
                          </div>
                        </div>
                        <div class="row col-6">
                          <div class="form-group">
                            <label>Tempat Tanggal Lahir</label>
                            <input type="text" class="form-control" name="ttl">
                          </div>
                        </div>
                        <div class="row col-4">
                          <div class="form-group">
                            <label>Agama</label>
                            <select name="agama" class="form-control">
                              <option value="#">Silahkan Pilih</option>
                              <option value="Islam">Islam</option>
                              <option value="Kristen">Kristen</option>
                              <option value="Hindu">Hindu</option>
                            </select>
                          </div>
                        </div>
                        <div class="row col-6">
                          <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3"></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary text-white">Simpan</button>
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