<?= $this->extend('layout/dashboard-dosen')?>

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
                                                        <h4 class="card-title card-title-dash">Input Presensi
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                </div>
                                                <form action="<?=base_url('dosen/waktupresensi/update/').$presensi['id']?>" method="post">
                                                <?= csrf_field(); ?>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label>Jam Masuk</label>
                                                            <input type="time" name="jam_masuk" class="form-control" value="<?=$presensi['jam_masuk']?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label>Jam Keluar</label>
                                                            <input type="time" name="jam_keluar" class="form-control" value="<?=$presensi['jam_keluar']?>">
                                                        </div>
                                                    </div>                                      
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <button type="submit"
                                                                class="btn btn-primary">Update</button> &nbsp;
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