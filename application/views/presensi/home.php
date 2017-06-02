<form class="uk-form" action="<?php echo base_url("presensi/input_absensi"); ?>" method="post">
    <input type="text" name="txt_npp" id="txt_npp" class="form-control" placeholder="Nomor Pegawai" autofocus="autofocus" required="required" maxlength="11">
</form>
<br>
<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Jabatan</th>
            <th style="text-align: center;">Jam Masuk</th>
            <th style="text-align: center;">Jam Keluar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($sql_absen != "")
        {
            foreach($sql_absen as $row_absen)
            {
                ?>
                <tr>
                    <td><b>[<?php echo ucwords($row_absen->absensi_pegawai); ?>]</b> <?php echo ucwords($row_absen->pegawai_nama); ?></td>
                    <td><?php echo ucwords($row_absen->jabatan_ket); ?></td>
                    <td style="text-align: center;"><?php echo $row_absen->JamMasuk; ?></td>
                    <td style="text-align: center;"><?php echo $row_absen->JamKeluar; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>