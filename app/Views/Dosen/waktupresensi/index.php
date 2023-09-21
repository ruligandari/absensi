<?= $this->extend('layout/dashboard-dosen') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
  <div class="row">
    <div class="col-sm-12">
      <div class="home-tab">
        <div class="tab-content tab-content-basic">
          <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
            <div class="row">
              <div class="col-lg-12 d-flex flex-column">
                <div class="row ">
                  <div class="col-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                      <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                          <div>
                            <h4 class="card-title card-title-dash">Data Waktu Presensi</h4>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Kelas</th>
                                <th>Mata Kuliah</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Dosen</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <?php $no = 1 ?>
                            <?php foreach ($presensi as $presensi) : ?>
                              <tbody>
                                <td><?= $no++ ?></td>
                                <td><?= $presensi['id'] ?></td>
                                <td><?= $presensi['kelas'] ?></td>
                                <td><?= $presensi['nama_mk'] ?></td>
                                <td><?= $presensi['jam_masuk'] ?></td>
                                <td><?= $presensi['jam_keluar'] ?></td>
                                <td><?= $presensi['nama'] ?></td>
                                <td><?= $presensi['tanggal'] ?></td>
                                <td>
                                  <a href="<?= base_url('dosen/waktupresensi/form-edit/') . $presensi['id'] ?>" class="btn btn-primary">Edit</a>

                                </td>
                              </tbody>
                            <?php endforeach ?>
                          </table>
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
</div>

<?= $this->endSection() ?>