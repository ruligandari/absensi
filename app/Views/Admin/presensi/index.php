<?= $this->extend('layout/dashboard-admin')?>

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
                                    <h4 class="card-title card-title-dash">Kelola Data Mahasiswa</h4>
                                  </div>
                                  <div>
                                    <a href="<?=base_url('admin/waktupresensi/create')?>"  type="button" class="btn btn-success">Tambah Data</a>
                                  </div>
                                </div>
                                <div >
                                    <table id="mhsData">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kelas</th>
                                                <th>Mata Kuliah</th>
                                                <th>Jam Masuk</th>
                                                <th>Jam Keluar</th>
                                                <th>Dosen</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <?php $no = 1?>
                                        <?php foreach ($presensi as $presensi): ?>
                                        <tbody>
                                            <td><?=$no++?></td>
                                            <td><?=$presensi['kelas']?></td>
                                            <td><?=$presensi['id_mk']?></td>
                                            <td><?=$presensi['jam_masuk']?></td>
                                            <td><?=$presensi['jam_keluar']?></td>
                                            <td><?=$presensi['id_dosen']?></td>
                                            <td><?=$presensi['tanggal']?></td>
                                            <td>
                                                <a href="#" class="btn btn-primary">Edit</a>
                                                <a href="#" class="btn btn-danger">Hapus</a>
                                            </td>
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
<?= $this->section('script')?>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function () {
    $('#mhsData').DataTable();
});
</script>

<?= $this->endSection()?>