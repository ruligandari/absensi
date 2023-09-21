
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $title?> </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url()?>vendors/feather/feather.css">
  <link rel="stylesheet" href="<?= base_url()?>vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url()?>vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= base_url()?>vendors/typicons/typicons.css">
  <link rel="stylesheet" href="<?= base_url()?>vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?= base_url()?>vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url()?>css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url()?>images/favicon.png" />
  <?= $this->renderSection('header')?>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <!-- content wrapper start -->
      <?= $this->renderSection('content')?>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?= base_url()?>vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="<?= base_url()?>vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?= base_url()?>js/off-canvas.js"></script>
  <script src="<?= base_url()?>js/hoverable-collapse.js"></script>
  <script src="<?= base_url()?>js/template.js"></script>
  <script src="<?= base_url()?>js/settings.js"></script>
  <script src="<?= base_url()?>js/todolist.js"></script>
  <!-- endinject -->
  <?= $this->renderSection('script')?>
</body>

</html>
