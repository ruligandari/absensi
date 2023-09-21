<?= $this->extend('layout/dashboard-dosen')?>

<?= $this->section('content')?>
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
                                    <h4 class="card-title card-title-dash">Nama Mahasiswa</h4>
                                  </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                            <th>No</th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Kelas</th>
                                                <th>Jurusan</th>
                                                <th>MK</th>
                                                <th>Jam Masuk</th>
                                                <th>Jam Keluar</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <?php $no = 1?>
                                        <?php foreach ($mahasiswa as $mk): ?>
                                        <tbody>
                                            <td><?=$no++?></td>
                                            <td><?=$mk['nim']?></td>
                                            <td><?=$mk['nama']?></td>
                                            <td><?=$mk['kelas']?></td>
                                            <td><?=$mk['jurusan']?></td>
                                            <td><?=$mk['nama_mk']?></td>
                                            <td><?=$mk['jam_masuk']?></td>
                                            <td><?=$mk['jam_keluar']?></td>
                                            <td><?=$mk['status']?></td>
                                        </tbody>
                                        <?php endforeach?>
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
     
<?= $this->endSection()?>