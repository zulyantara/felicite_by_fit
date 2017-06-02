<?php
if(isset($err_msg))
{
    ?>
    <div class="uk-alert uk-alert-danger"><?php echo $err_msg; ?></div>
    <?php
}

$pegawai_id = "";
$pegawai_nama = "";
$pegawai_alamat = "";
$pegawai_telp = "";
if(isset($query_edit))
{
    $pegawai_id = $query_edit->pegawai_id;
    $pegawai_nama = $query_edit->pegawai_nama;
    $pegawai_alamat = $query_edit->pegawai_alamat;
    $pegawai_telp = $query_edit->pegawai_telp;
}
?>
<form class="uk-form uk-form-horizontal tara-form" method="post" action="<?php echo base_url("pegawai/data_baru"); ?>">
    <input type="hidden" name="txt_pegawai_id" id="txt_pegawai_id" value="<?php echo $pegawai_id; ?>">
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_pegawai_nama">Nama Pegawai</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_pegawai_nama" id="txt_pegawai_nama" placeholder="Nama Pegawai" value="<?php echo $pegawai_nama; ?>" autofocus="autofocus">
            <span class="uk-text-danger"><?php echo form_error('txt_pegawai_nama'); ?></span>
        </div>
    </div>
    <?php
    if($this->uri->segment(2) === "data_baru")
    {
        ?>
        <div class="uk-form-row">
            <label for="opt_jabatan" class="uk-form-label">Jabatan</label>
            <div class="uk-form-controls">
                <select name="opt_jabatan" id="opt_jabatan">
                    <?php
                    foreach($res_jabatan as $row_jabatan)
                    {
                        ?>
                        <option value="<?php echo $row_jabatan->jabatan_id; ?>"><?php echo $row_jabatan->jabatan_ket; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_pegawai_alamat">Alamat</label>
        <div class="uk-form-controls">
            <textarea name="txt_pegawai_alamat" id="txt_pegawai_alamat" cols="35" rows="3" placeholder="Alamat"><?php echo $pegawai_alamat; ?></textarea>
            <span class="uk-text-danger"><?php echo form_error('txt_pegawai_alamat'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_pegawai_telp">No. Telp</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_pegawai_telp" id="txt_pegawai_telp" placeholder="No. Telp" value="<?php echo $pegawai_telp; ?>">
            <span class="uk-text-danger"><?php echo form_error('txt_pegawai_telp'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="">&nbsp;</label>
        <div class="uk-form-controls uk-form-controls-text">
            <input type="submit" name="btn_simpan" id="btn_simpan" value="Simpan" class="uk-button uk-button-primary">
            <a href="<?php echo base_url("pegawai/"); ?>" class="uk-button uk-button-danger">List Pegawai</a>
        </div>
    </div>
</form>

<?php
if($this->uri->segment(3))
{
    ?>
    <br>
    <a href="<?php echo base_url("jabatan_pegawai/data_baru/".$pegawai_id); ?>" class="uk-button uk-button-primary">Tambah Jabatan</a>
    <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed tara-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Jabatan</th>
                <th style="width: 20%;">Status</th>
                <th style="width: 10%;">Option</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td></td>
            </tr>
        </tfoot>
        <tbody>
            <?php
            $no_jp = 1;
            foreach($res_jp as $row_jp)
            {
                $jabatan_id = $row_jp->jabatan_id;
                ?>
                <tr>
                    <td><?php echo $no_jp; ?></td>
                    <td><?php echo $row_jp->jabatan_ket; ?></td>
                    <td><?php echo ($row_jp->jp_isactive == 1) ? "Aktif" : "Tidak Aktif"; ?></td>
                    <td>
                        <a href="<?php echo base_url("jabatan_pegawai/edit_data/".$pegawai_id."/".$jabatan_id); ?>" class="uk-button uk-button-primary">Edit</a>
                    </td>
                </tr>
                <?php
                $no_jp++;
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>