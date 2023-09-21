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
                                <?php 
                                if (session()->getFlashdata('success')) {
                                    echo '<div class="alert alert-success" role="alert">'.session()->getFlashdata('success').'</div>';
                                } else if (session()->getFlashdata('error')){
                                    echo '<div class="alert alert-danger" role="alert">'.session()->getFlashdata('error').'</div>';
                                }
                                ?>
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Kelola Data Presensi</h4>
                                  </div>
                                  <div>
                                    <a href="<?=base_url('admin/waktupresensi/create')?>"  type="button" class="btn btn-success text-white">Tambah Data</a>
                                  </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover" id="mhs">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kelas</th>
                                                <th>Mata Kuliah</th>
                                                <th>Dosen</th>
                                                <th>Tanggal</th>
                                                <th>Jam Masuk</th>
                                                <th>Jam Keluar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <?php $no = 1?>
                                        <tbody>
                                          <?php foreach ($presensi as $row): ?>
                                          <tr>

                                            <td><?=$no++?></td>
                                            <td><?=$row['kelas']?></td>
                                            <td><?=$row['nama_mk']?></td>
                                            <td><?=$row['nama']?></td>
                                            <td><?=$row['tanggal']?></td>
                                            <td><?=$row['jam_masuk']?></td>
                                            <td><?=$row['jam_keluar']?></td>
                                            <td align="center">
                                                <a href="<?=base_url('admin/waktupresensi/form_edit/').$row['id']?>" class="btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                                <button data-bs-target="#hapusModal<?=$row['id']?>" data-bs-toggle="modal"
                                  class="btn-sm btn-danger"><i class="fas fa-trash"></i></button>  
                                                <a href="<?= base_url('admin/waktupresensi/rincian/'). $row['id']?>"
                                  class="btn-sm btn-success"> <i class="fas fa-eye"></i></a>  
                                            </td>
                                          </tr>
                                            <?php endforeach?>
                                        </tbody>
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
<?php foreach ($presensi as $row) :?>
<div class="modal fade" id="hapusModal<?=$row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/waktupresensi/delete/').$row['id']?>" method="POST">
      <?= csrf_field()?>
      <div class="modal-body">
        Apakah anda yakin ingin menghapus Presensi <?=$row['id']?> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach?>
<?= $this->endSection()?>
<?= $this->section('script')?>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function () {
    $('#mhs').DataTable();
});

</script>
<?= $this->endSection()?>