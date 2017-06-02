<?php
if(isset($err_msg))
{
    ?>
    <div class="uk-alert uk-alert-danger"><?php echo $err_msg; ?></div>
    <?php
}

$js_id = "";
$js_ket = "";
if(isset($query_edit))
{
    $js_id = $query_edit->js_id;
    $js_ket = $query_edit->js_ket;
}
?>
<form class="uk-form uk-form-horizontal tara-form" method="post" action="<?php echo base_url("jenis_service/data_baru"); ?>">
    <input type="hidden" name="txt_jenis_service_id" id="txt_jenis_service_id" value="<?php echo $js_id; ?>">
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_jenis_service_ket">Jenis Service</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_jenis_service_ket" id="txt_jenis_service_ket" placeholder="Jenis Service" value="<?php echo $js_ket; ?>" autofocus="autofocus">
        <span class="uk-text-danger"><?php echo form_error('txt_jenis_service_ket'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="">&nbsp;</label>
        <div class="uk-form-controls uk-form-controls-text">
            <input type="submit" name="btn_simpan" id="btn_simpan" value="Simpan" class="uk-button uk-button-primary">
            <a href="<?php echo base_url("jenis_service/"); ?>" class="uk-button uk-button-danger">List Jenis Service</a>
        </div>
    </div>
</form>