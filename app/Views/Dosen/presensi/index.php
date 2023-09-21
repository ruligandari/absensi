<?= $this->extend('layout/dashboard-dosen')?>

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
                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h4 class="card-title card-title-dash">Nama Mahasiswa</h4>
                                                    </div>
                                                    <div>
                                                        <input type="text" id="search-input"
                                                            placeholder="Cari..." class="form-control">
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
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
                                                            </tr>
                                                        </thead>
                                                        <?php $no = 1?>
                                                        <?php foreach ($presensi as $mk): ?>
                                                        <tbody>
                                                            <td><?=$no++?></td>
                                                            <td><?=$mk['nim']?></td>
                                                            <td><?=$mk['nama']?></td>
                                                            <td><?=$mk['kelas']?></td>
                                                            <td><?=$mk['jurusan']?></td>
                                                            <td><?=$mk['nama_mk']?></td>
                                                            <td><?=$mk['jam_masuk']?></td>
                                                            <td><?=$mk['jam_keluar']?></td>
                                                            <td><?=$mk['status']?></td>
                                                        </tbody>
                                                        <?php endforeach?>
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
<script>
    const searchInput = document.getElementById('search-input');
    const tableRows = document.getElementsByTagName('tr');

    searchInput.addEventListener('keyup', function () {
        const searchValue = searchInput.value.toUpperCase();
        for (let i = 1; i < tableRows.length; i++) {
            const row = tableRows[i];
            const cells = row.getElementsByTagName('td');
            let matchFound = false;
            for (let j = 0; j < cells.length; j++) {
                const cellText = cells[j].textContent.toUpperCase();
                if (cellText.indexOf(searchValue) > -1) {
                    matchFound = true;
                    break;
                }
            }
            if (matchFound) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
</script>

<?= $this->endSection()?>