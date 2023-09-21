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
                                                        <h4 class="card-title card-title-dash">Input Presensi
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                </div>
                                                <form action="<?=base_url('admin/waktupresensi/update/').$presensi['id'];?>" method="post">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label>Nama Kelas</label>
                                                            <select name="id_kelas" class="form-control">
                                                            <option value="<?=$presensi['id_kelas']?>"><?=$presensi['kelas']?></option>
                                                            <?php foreach($kelas as $kelas):?>
                                                            <option value="<?=$kelas['id_kelas']?>"><?=$kelas['kelas']?></option>
                                                            <?php endforeach?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label>Mata Kuliah</label>
                                                            <select name="id_mk" class="form-control">
                                                            <option value="<?=$presensi['id_mk']?>"><?=$presensi['nama_mk']?></option>
                                                            <?php foreach($mk as $mk):?>
                                                            <option value="<?=$mk['id_mk']?>"><?=$mk['nama_mk']?></option>
                                                            <?php endforeach?>
                                                            </select>
                                                        </div>
                                                    </div>
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
                                                            <label>Dosen Pengampu</label>
                                                            <select name="id_dosen" class="form-control">
                                                                <option value="<?=$presensi['id_dosen']?>"><?=$presensi['nama']?></option>
                                                                <?php foreach ($dosen as $dosen): ?>
                                                                <option value="<?=$dosen['id_dosen']?>"><?=$dosen['nama']?>
                                                                </option>
                                                                <?php endforeach?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label>Tanggal</label>
                                                            <input type="date" name="tanggal" class="form-control" value="<?=Date('D-M-Y')?>">
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