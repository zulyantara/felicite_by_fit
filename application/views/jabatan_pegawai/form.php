<?php
if(isset($err_msg))
{
    ?>
    <div class="uk-alert uk-alert-danger"><?php echo $err_msg; ?></div>
    <?php
}

$jp_id = "";
$jp_jabatan = "";
$jp_isactive = "";
if(isset($query_edit))
{
    $jp_id = $query_edit->jp_id;
    $jp_jabatan = $query_edit->jp_jabatan;
    $jp_isactive = $query_edit->jp_isactive;
}

$checked_isactive = ($jp_isactive == 1) ? " checked=\"checked\"" : "";
?>
<form class="uk-form uk-form-horizontal tara-form" method="post" action="<?php echo base_url("jabatan_pegawai/data_baru"); ?>">
    <input type="hidden" name="txt_jp_id" id="txt_jp_id" value="<?php echo $jp_id; ?>">
    <input type="hidden" name="txt_jp_pegawai" id="txt_jp_pegawai" value="<?php echo $this->uri->segment(3); ?>">
    <div class="uk-form-row">
        <label class="uk-form-label" for="opt_jp_jabatan">Jabatan</label>
        <div class="uk-form-controls">
            <select name="opt_jp_jabatan" id="opt_jp_jabatan">
                <?php
                foreach($res_jabatan as $row_jabatan)
                {
                    $selected = ($row_jabatan->jabatan_id == $jp_jabatan) ? "selected=\"selected\"" : "";
                    ?>
                    <option <?php echo $selected; ?> value="<?php echo $row_jabatan->jabatan_id; ?>"><?php echo $row_jabatan->jabatan_ket; ?></option>
                    <?php
                }
                ?>
            </select>
            <span class="uk-text-danger"><?php echo form_error('opt_jp_jabatan'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="chk_jp_isactive">Is Active</label>
        <div class="uk-form-controls">
            <input type="radio" name="chk_jp_isactive" id="chk_jp_isactive" value="1">Aktif
            <input type="radio" name="chk_jp_isactive" id="chk_jp_isactive" value="2">Non Aktif
            <span class="uk-text-danger"><?php echo form_error('chk_jp_isactive'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="">&nbsp;</label>
        <div class="uk-form-controls uk-form-controls-text">
            <input type="submit" name="btn_simpan" id="btn_simpan" value="Simpan" class="uk-button uk-button-primary">
            <a href="<?php echo base_url("pegawai/edit_data/".$this->uri->segment(3)); ?>" class="uk-button uk-button-danger">Edit Pegawai</a>
        </div>
    </div>
</form>