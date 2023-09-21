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
                            <h4 class="card-title card-title-dash">Edit Data Mahasiswa</h4>
                          </div>
                        </div>
                        <form action="<?=base_url('admin/mahasiswa/update/'.$mahasiswa['nim']);?>" method="post">
                        <?=csrf_field()?>

                        <div class="row">
                          <div class="form-group">
                            <label>NIM</label>
                            <input type="text" class="form-control" name="nim" value="<?=$mahasiswa['nim'];?>">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?=$mahasiswa['nama'];?>">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <label>Kelas</label>
                            <select name="id_kelas" class="form-control">
                              <option value="<?=$mahasiswa['id_kelas'];?>"><?=$mahasiswa['kelas'];?></option>
                              <?php foreach($kelas as $kelas):?>
                                <option value="<?=$kelas['id_kelas']?>"><?=$kelas['kelas']?></option>
                              <?php endforeach?>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <label>Jurusan</label>
                            <select name="jurusan" class="form-control">
                              <option value="<?=$mahasiswa['jurusan'];?>"><?=$mahasiswa['jurusan'];?></option>
                              <option value="Teknik Informatika">Teknik Informatika</option>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                              <option value="<?=$mahasiswa['jenis_kelamin'];?>"><?=$mahasiswa['jenis_kelamin'];?></option>
                              <option value="L">Laki-Laki</option>
                              <option value="P">Perempuan</option>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <label>Tempat Tanggal Lahir</label>
                            <input type="text" class="form-control" name="ttl" value="<?=$mahasiswa['ttl'];?>">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <label>Agama</label>
                            <select name="agama" class="form-control">
                              <option value="<?=$mahasiswa['agama'];?>"><?=$mahasiswa['agama'];?></option>
                              <option value="Islam">Islam</option>
                              <option value="Kristen">Kristen</option>
                              <option value="Hindu">Hindu</option>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3"><?=$mahasiswa['alamat'];?></textarea>
                          </div>
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

<?= $this->section('script')?>
<script>
   // Ambil elemen input file dan elemen gambar
    var uploadInput = document.getElementById('foto');
    var previewImage = document.getElementById('showFoto');
    
    // Tambahkan event listener untuk perubahan pada input file
    uploadInput.addEventListener('change', function(e) {
      // Cek apakah ada file yang diunggah
      if (uploadInput.files && uploadInput.files[0]) {
        // Ambil file yang diunggah
        var file = e.target.files[0];
        
        // Buat objek FileReader
        var reader = new FileReader();
        
        // Setelah file selesai dibaca, tampilkan gambar pada elemen img
        reader.onload = function(e) {
          previewImage.src = e.target.result;
          previewImage.style.display = 'block';
        };
        
        // Baca file sebagai URL data gambar
        reader.readAsDataURL(file);
      } else {
        // Jika tidak ada file yang dipilih, sembunyikan elemen img
        previewImage.style.display = 'none';
      }
    });
</script>
<?= $this->endSection()?>