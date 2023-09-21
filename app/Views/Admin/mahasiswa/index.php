<?= $this->extend('layout/dashboard-admin') ?>

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
                        <?php
                        if (session()->getFlashdata('success')) {
                          echo '<div class="alert alert-success" role="alert">' . session()->getFlashdata('success') . '</div>';
                        } else if (session()->getFlashdata('error')) {
                          echo '<div class="alert alert-danger" role="alert">' . session()->getFlashdata('error') . '</div>';
                        }
                        ?>
                        <div class="d-sm-flex justify-content-between align-items-start">
                          <div>
                            <h4 class="card-title card-title-dash">Kelola Data Mahasiswa</h4>
                          </div>
                          <div>
                            <a href="<?= base_url('admin/mahasiswa/create') ?>" type="button" class="btn btn-success text-white">Tambah Data</a>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table id="mhs" class="table table-hover" width="100%">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Jenis Kelamin</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $no = 1 ?>
                              <?php foreach ($mahasiswa as $row) : ?>
                                <tr>
                                  <td><?= $no++ ?></td>
                                  <td><?= $row['nim'] ?></td>
                                  <td><?= $row['nama'] ?></td>
                                  <td><?= $row['kelas'] ?></td>
                                  <td><?= $row['jurusan'] ?></td>
                                  <td><?= $row['jenis_kelamin'] ?></td>
                                  <td>
                                    <?php if ($row['foto']) : ?>
                                      <img src="<?= base_url('uploads/' . $row['foto']) ?> ">
                                    <?php else : ?>
                                      Belum Ada Foto
                                    <?php endif; ?>
                                  <td>
                                    <a href="<?= base_url('admin/mahasiswa/form_edit/') . $row['nim'] ?>" class="btn-sm btn-primary text-white"> <i class="fas fa-edit"></i></a>
                                    <button data-bs-target="#hapusModal<?= $row['nim'] ?>" data-bs-toggle="modal" class="btn-sm btn-danger text-white"><i class="fas fa-trash"></i></button>
                                    <a href="<?= base_url('admin/mahasiswa/pas-foto/') . $row['nim'] ?>" class="btn-sm btn-success"><i class="fas fa-camera"></i></a>
                                  </td>
                                </tr>
                              <?php endforeach ?>
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
<?php foreach ($mahasiswa as $mk) : ?>
  <div class="modal fade" id="hapusModal<?= $mk['nim'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus?</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('admin/mahasiswa/delete/') . $mk['nim'] ?>" method="POST">
          <?= csrf_field() ?>
          <div class="modal-body">
            Apakah anda yakin ingin menghapus Mahasiswa <?= $mk['nama'] ?> ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger" id="hapusDataBtn">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    $('#mhs').DataTable();
  });
</script>
<script>
  // Menangani klik tombol hapus pada modal
  document.getElementById('hapusDataBtn').addEventListener('click', function() {
    // Ambil nilai id dari atribut data-id pada tombol yang membuka modal
    var id = document.querySelector('#hapusModal [data-id]').getAttribute('data-id');
    // Kirim id ke sisi server melalui AJAX atau formulir
    // ...
    // Tutup modal
    $('#hapusModal').modal('hide');
  });
</script>
<?= $this->endSection() ?>