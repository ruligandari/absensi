<?= $this->extend('layout/dashboard-admin') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css" type="text/css">
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<style>
  .button-container .dt-buttons {
    margin-left: 1rem;
  }

  div.dataTables_wrapper .button-container div.dataTables_length select {
    width: 5rem;

  }
</style>
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
                        <?php if (session()->getFlashdata('success')) {
                          echo '<div class="alert alert-success" role="alert">' . session()->getFlashdata('success') . '</div>';
                        } else if (session()->getFlashdata('error')) {
                          echo '<div class="alert alert-danger" role="alert">' . session()->getFlashdata('error') . '</div>';
                        }
                        ?>
                        <div class="d-sm-flex justify-content-between align-items-start">
                          <div class="mb-3">
                            <h4 class="card-title card-title-dash">Nama Mahasiswa</h4>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-hover" id="rincian">
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
                                <th>Action</th>
                              </tr>
                            </thead>
                            <?php $no = 1 ?>
                            <tbody>
                              <?php foreach ($mahasiswa as $mk) : ?>
                                <tr>

                                  <td><?= $no++ ?></td>
                                  <td><?= $mk['nim'] ?></td>
                                  <td><?= $mk['nama'] ?></td>
                                  <td><?= $mk['kelas'] ?></td>
                                  <td><?= $mk['jurusan'] ?></td>
                                  <td><?= $mk['nama_mk'] ?></td>
                                  <td><?= $mk['jam_masuk'] ?></td>
                                  <td><?= $mk['jam_keluar'] ?></td>
                                  <td><?= $mk['status'] ?></td>
                                  <td>
                                    <button data-bs-target="#editModal<?= $mk['id_presensi'] ?>" data-bs-toggle="modal" class="btn btn-primary text-white">Edit</a>
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
  <div class="modal fade" id="editModal<?= $mk['id_presensi'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Keterangan Kehadiran Untuk <?= $mk['nama'] ?></h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('admin/waktupresensi/update-kehadiran') ?>" method="POST">
          <?= csrf_field() ?>
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" name="id" value="<?= $mk['id'] ?>">
              <input type="hidden" name="id_presensi" value="<?= $mk['id_presensi'] ?>">
              <label for="nim">Keterangan Kehadiran</label>
              <select name="status" class="form-control">
                <option value="sakit">Sakit</option>
                <option value="izin">Izin</option>
                <option value="hadir">Hadir</option>
                <option value="tidak hadir">Tidak Hadir</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="hapusDataBtn">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

<script>
  $(document).ready(function() {
    $('#rincian').DataTable({
      dom: '<"button-container"lBfrtip>',
      buttons: [{
          extend: 'excelHtml5',
          footer: true,
          title: 'Data Absensi Mahasiswa',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
          },
          className: 'mb-2',
          // ubah nama file ketika di download

        },
        {
          extend: 'pdfHtml5',
          footer: true,
          title: 'Data Absensi Mahasiswa',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
          },
          className: 'mb-2',
        }
      ],
    });
  });
</script>

<?= $this->endSection() ?>