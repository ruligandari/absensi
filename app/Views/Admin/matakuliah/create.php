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
                                                        <h4 class="card-title card-title-dash">Input Data Mata Kuliah
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                </div>
                                                <form action="<?=base_url('admin/matakuliah/save');?>" method="post">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label>ID MK</label>
                                                            <input type="text" class="form-control" name="id_mk" value="<?=$id_mk?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label>Nama Mata Kuliah</label>
                                                            <input type="text" class="form-control" name="nama_mk">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label>Dosen Pengampu</label>

                                                            <select name="id_dosen" class="form-control">
                                                                <?php foreach ($dosen as $dosen): ?>

                                                                <option value="<?=$dosen['id_dosen']?>"><?=$dosen['nama']?>
                                                                </option>
                                                                <?php endforeach?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <button type="submit"
                                                                class="btn btn-lg btn-primary" style="color:white;">Simpan</button> &nbsp;
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