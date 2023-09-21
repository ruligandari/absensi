<?= $this->extend('layout/dashboard-admin')?>

<?= $this->section('content')?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                        <div class="row">
                            <div class="col-lg-12 d-flex flex-column">
                                <div class="row">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h4 class="card-title card-title-dash">Kontrak Kredit</h4>
                                                    </div>
                                                    <div class="card-header-action">
                                                        <form id="kelasForm">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span
                                                                            class="input-group-text bg-primary text-white">
                                                                            <i class="fas fa-chevron-down"></i>
                                                                        </span>
                                                                    </div>
                                                                    <select id="id_kelas" name="id_kelas"
                                                                        class="custom-select form-control">
                                                                        <option value="#">Semua Kelas</option>
                                                                        <?php foreach ($kelas as $kls): ?>
                                                                        <option value="<?=$kls['id_kelas']?>">
                                                                            <?=$kls['kelas']?></option>
                                                                        <?php endforeach?>
                                                                    </select>
                                                                    <input type="hidden"
                                                                        value="<?=$matakuliah['id_mk']?>" name="id_mk"
                                                                        id="id_mk">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="mhs">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nim</th>
                                                                <th>Nama Mahasiswa</th>
                                                                <th>Kelas</th>
                                                                <th>Kontrak</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 1?>
                                                            <?php foreach ($mahasiswa as $maha): ?>
                                                            <tr>
                                                                <td><?=$no++?></td>
                                                                <td><?=$maha['nim']?></td>
                                                                <td><?=$maha['nama']?></td>
                                                                <td><?=$maha['kelas']?></td>
                                                                <td>
                                                                    <input type="checkbox" name="nim"> Kontrak
                                                                </td>
                                                            </tr>
                                                            <?php endforeach?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button id="saveKontrak" class="btn btn-primary text-white">Simpan
                                                    Kontrak</button>
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#mhs').DataTable();

    $('#id_kelas').change(function() {
        var idKelas = $(this).val();

        $.ajax({
            url: '<?=base_url('admin/matakuliah/kontrak/filter')?>',
            type: 'POST',
            dataType: 'json',
            data: {
                id_kelas: idKelas
            },

            success: function(response) {
                var html = '';

                $.each(response.mahasiswa, function(index, item) {
                    html += '<tr>';
                    html += '<td>' + (index + 1) + '</td>';
                    html += '<td>' + item.nim + '</td>';
                    html += '<td>' + item.nama + '</td>';
                    html += '<td>' + item.kelas + '</td>';
                    html += '<td>';
                    html +=
                        '<input type="checkbox" name="nim[]" value="' +
                        item
                        .nim + '">';
                    html +=
                        '<input type="hidden" name="kelas[]" value="' +
                        item
                        .kelas + '">';
                    html += 'Kontrak';
                    html += '</td>';
                    html += '</tr>';
                });
                $('#mhs tbody').html(html);
            }
        });
    });
    $('#saveKontrak').click(function(e) {
        e.preventDefault();

        var selectedNim = [];
        var selectedKelas = [];

        $('input[name="nim[]"]:checked').each(function() {
            selectedNim.push($(this).val());
        });
        var id_mk = $('#id_mk').val();
        console.log(selectedNim);
        console.log(id_mk);
        $.ajax({
            url: '<?=base_url('admin/matakuliah/kontrak/save')?>',
            type: 'POST',
            dataType: 'json',
            data: {
                selectedNim: selectedNim,
                id_mk: id_mk
            },
            success: function(response) {
                if (response.status == 'success') {
                    alert('Kontrak berhasil disimpan.');
                    // Lakukan tindakan lain setelah berhasil menyimpan kontrak
                } else if (response.status == 'exists') {
                    alert('Mahasiswa dengan nim tersebut sudah melakukan kontrak.');
                } else {
                    alert('Gagal menyimpan kontrak. Silakan coba lagi.');
                }
            }
        });
    });
});
</script>
<?= $this->endSection()?>