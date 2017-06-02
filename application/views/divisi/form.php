<?php
if(isset($err_msg))
{
    ?>
    <div class="uk-alert uk-alert-danger"><?php echo $err_msg; ?></div>
    <?php
}

$divisi_id = "";
$divisi_ket = "";
if(isset($query_edit))
{
    $divisi_id = $query_edit->divisi_id;
    $divisi_ket = $query_edit->divisi_ket;
}
?>
<form class="uk-form uk-form-horizontal tara-form" method="post" action="<?php echo base_url("divisi/data_baru"); ?>">
    <input type="hidden" name="txt_divisi_id" id="txt_divisi_id" value="<?php echo $divisi_id; ?>">
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_divisi_ket">Jabatan</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_divisi_ket" id="txt_divisi_ket" placeholder="Jabatan" value="<?php echo $divisi_ket; ?>" autofocus="autofocus">
        <span class="uk-text-danger"><?php echo form_error('txt_divisi_ket'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="">&nbsp;</label>
        <div class="uk-form-controls uk-form-controls-text">
            <input type="submit" name="btn_simpan" id="btn_simpan" value="Simpan" class="uk-button uk-button-primary">
            <a href="<?php echo base_url("divisi/"); ?>" class="uk-button uk-button-danger">List Jabatan</a>
        </div>
    </div>
</form>