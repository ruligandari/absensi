<?= $this->extend('layout/auth-login-admin') ?>

<?= $this->section('header'); ?>
<style>
  video {
    position: absolute;
  }

  canvas {
    position: relative;
  }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>

<div class="content-wrapper d-flex align-items-center auth px-0">
  <div class="row w-100 mx-0">
    <div class="col-lg-5 mx-auto">
      <h2 class="text-center mb-3">Sistem Presensi Face Recognition</h2>
      <!-- <video autoplay="true" id="webcam-video"></video> -->

      <div id="video" class="video"></div>

      <div class="label text-center"><span>Tahan Posisi Dalam Beberapa Detik</span></div>
      <div class="label text-center" id="label"></div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url('js/face-api.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // Fetch model from server
  fetch('<?= base_url('model') ?>')
    .then(response => response.json())
    .then(data => {
      // Load the face recognition model
      var models = '<?= base_url('models') ?>'
      Promise.all([
        faceapi.nets.tinyFaceDetector.loadFromUri(models),
        faceapi.nets.faceLandmark68Net.loadFromUri(models),
        faceapi.nets.faceRecognitionNet.loadFromUri(models)
      ]).then(startFaceRecognition);

      function startFaceRecognition() {
        // Start webcam stream
        navigator.mediaDevices.getUserMedia({
            video: true
          })
          .then(stream => {
            const video = document.createElement('video');
            video.id = 'video';
            video.width = 640;
            video.height = 480;
            video.autoplay = true;
            video.srcObject = stream;
            document.getElementById('video').appendChild(video);

            video.onloadedmetadata = () => {
              video.play();
              // Create canvas for drawing face landmarks
              const canvas = document.createElement('canvas');
              canvas.id = 'canvas';
              canvas.width = 640;
              canvas.height = 480;
              document.getElementById('video').appendChild(canvas);
              const displaySize = {
                width: video.width,
                height: video.height
              };
              faceapi.matchDimensions(canvas, displaySize);

              // Perform face recognition on each video frame
              let isDetectionPaused = false;

              setInterval(async () => {
                if (!isDetectionPaused) {
                  const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
                    .withFaceLandmarks()
                    .withFaceDescriptors();
                  const labeledDescriptors = data.labels.map((label, index) => {
                    const descriptors = Float32Array.from(data.descriptors[index]);
                    return new faceapi.LabeledFaceDescriptors(label, [descriptors]);
                  });

                  const faceMatcher = new faceapi.FaceMatcher(labeledDescriptors);
                  const results = detections.map(detection => faceMatcher.findBestMatch(detection.descriptor));

                  // Draw bounding boxes and labels on canvas
                  canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
                  results.forEach(async (result, i) => {
                    if (!isDetectionPaused) {
                      const box = detections[i].detection.box;
                      const label = result.toString();
                      const drawBox = new faceapi.draw.DrawBox(box, {
                        label
                      });
                      drawBox.draw(canvas);

                      // Update label text
                      const labelElement = document.getElementById('label');
                      labelElement.innerHTML = label;
                      labeled = label.substring(0, label.indexOf(' '));
                      if (labeled != 'unknown') {
                        isDetectionPaused = true; // Menandakan bahwa deteksi dihentikan
                        presensi(label);
                        setTimeout(() => {
                          isDetectionPaused = false; // Setelah 5 detik, deteksi dilanjutkan
                        }, 5000);
                      } else {
                        Swal.fire({
                          text: 'Wajah Tidak Terdaftar!',
                          icon: 'error',
                          showConfirmButton: false,
                          timer: 3000
                        })
                      }
                    }
                  });
                }
              }, 1000);
            };
          })
          .catch(error => {
            console.log('Error accessing webcam:', error);
          });
      }

      function presensi(id) {
        $.ajax({
          url: "<?= base_url('absen/') ?>" + id,
          type: "GET",
          success: function(response) {
            console.log(response);
            var jsonParse = JSON.parse(response);
            Swal.fire({
              text: jsonParse.msg,
              icon: jsonParse.status,
              showConfirmButton: false,
              timer: 3000
            })
          }

        })
      }
    })
    .catch(error => {
      console.log('Error fetching model:', error);
    });
</script>
<?= $this->endSection() ?>