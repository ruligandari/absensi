<?= $this->extend('layout/dashboard-admin')?>
<?= $this->section('header')?>

<?= $this->endSection();?>

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
                            <h4 class="card-title card-title-dash">Generate Data Wajah Mahasiswa</h4>
                          </div>
                        </div>
                        <form action="<?=base_url('admin/mahasiswa/upload');?>" method="post" enctype="multipart/form-data">
                        <?=csrf_field()?>
                        <div class="row">
                          <div class="form-group">
                            <label for="fotowajah">Pas Foto</label>
                            <input name="fotowajah" type="file" class="form-control" id="foto"></input>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <input name="datawajah" type="text" class="form-control" id="wajah" hidden></input>
                            <input name="nim" type="text" class="form-control" value="<?= $nim?>" hidden></input>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <span  class="text-muted">Pastikan foto wajah memiliki pencahayaan yang baik</span>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <img src="" id="showFoto" alt="" style="height: 300px; width: 200px; display: none;">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <span id="result"></span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary text-white">Simpan</button> &nbsp;
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
<script src="<?=base_url('js/face-api.min.js')?>"></script>
<script>
    // Inisialisasi face-api.js
    var models = '<?=base_url('models')?>';
    Promise.all([
      faceapi.nets.ssdMobilenetv1.loadFromUri(models),
      faceapi.nets.faceLandmark68Net.loadFromUri(models),
      faceapi.nets.faceRecognitionNet.loadFromUri(models)
    ]).then(start);
    
    function start() {
      // Ambil elemen input file
      var uploadInput = document.getElementById('foto');
      var dataWajah = document.getElementById('wajah');
      
      // Tambahkan event listener untuk perubahan pada input file
      uploadInput.addEventListener('change', async function(e) {
        var showResult = document.getElementById('result');
        // Cek apakah ada file yang diunggah
        if (uploadInput.files && uploadInput.files[0]) {
          // Buat objek FileReader
          var reader = new FileReader();
          
          // Setelah file selesai dibaca, lakukan deteksi wajah
          reader.onload = async function(e) {
            var image = document.createElement('img');
            image.src = e.target.result;
            
            // Deteksi wajah menggunakan face-api.js
            var detections = await faceapi.detectAllFaces(image).withFaceLandmarks().withFaceDescriptors();
            
            // Ambil descriptor wajah dari hasil deteksi
            if (detections.length > 0) {
              var faceDescriptor = detections[0].descriptor;
              dataWajah.value = faceDescriptor;
              showResult.textContent = 'Data Wajah Berhasil Di Generate.';
            } else {
                showResult.textContent = 'Tidak ada wajah yang terdeteksi.';
            }
          };
          
          // Baca file sebagai URL data gambar
          reader.readAsDataURL(uploadInput.files[0]);
        }
      });
    }
  </script>
<?= $this->endSection()?>