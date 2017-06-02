<?php
if(isset($err_msg))
{
    ?>
    <div class="uk-alert uk-alert-danger"><?php echo $err_msg; ?></div>
    <?php
}

$jabatan_id = "";
$jabatan_ket = "";
if(isset($query_edit))
{
    $jabatan_id = $query_edit->jabatan_id;
    $jabatan_ket = $query_edit->jabatan_ket;
}
?>
<form class="uk-form uk-form-horizontal tara-form" method="post" action="<?php echo base_url("jabatan/data_baru"); ?>">
    <input type="hidden" name="txt_jabatan_id" id="txt_jabatan_id" value="<?php echo $jabatan_id; ?>">
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_jabatan_ket">Jabatan</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_jabatan_ket" id="txt_jabatan_ket" placeholder="Jabatan" value="<?php echo $jabatan_ket; ?>" autofocus="autofocus">
        <span class="uk-text-danger"><?php echo form_error('txt_jabatan_ket'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="">&nbsp;</label>
        <div class="uk-form-controls uk-form-controls-text">
            <input type="submit" name="btn_simpan" id="btn_simpan" value="Simpan" class="uk-button uk-button-primary">
            <a href="<?php echo base_url("jabatan/"); ?>" class="uk-button uk-button-danger">List Jabatan</a>
        </div>
    </div>
</form>