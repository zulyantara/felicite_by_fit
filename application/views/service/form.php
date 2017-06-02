<?php
if(isset($err_msg))
{
    ?>
    <div class="uk-alert uk-alert-danger"><?php echo $err_msg; ?></div>
    <?php
}

$service_id = "";
$service_nama = "";
$service_harga = 0;
$service_jenis = "";

if(isset($query_edit))
{
    $service_id = $query_edit->service_id;
    $service_nama = $query_edit->service_nama;
    $service_harga = $query_edit->service_harga;
    $service_jenis = $query_edit->service_jenis;
}
?>

<form class="uk-form uk-form-horizontal tara-form" method="post" action="<?php echo base_url("service/data_baru"); ?>">
    <input type="hidden" name="txt_service_id" id="txt_service_id" value="<?php echo $service_id; ?>">
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_service_nama">Nama Service</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_service_nama" id="txt_service_nama" placeholder="Nama Service" value="<?php echo $service_nama; ?>" autofocus="autofocus">
            <span class="uk-text-danger"><?php echo form_error('txt_service_nama'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_service_harga">Harga Service</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_service_harga" id="txt_service_harga" value="<?php echo $service_harga; ?>">
            <span class="uk-text-danger"><?php echo form_error('txt_service_harga'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="opt_service_jenis">Jenis Service</label>
        <div class="uk-form-controls">
            <select name="opt_service_jenis" id="opt_jenis_service">
                <option value="">Jenis Service</option>
                <?php
                foreach($res_jenis_service as $row_jenis_service)
                {
                    $selected = ($service_jenis==$row_jenis_service->js_id) ? "selected=\"selected\"" : "";
                    ?>
                    <option value="<?php echo $row_jenis_service->js_id; ?>" <?php echo $selected; ?>><?php echo $row_jenis_service->js_ket; ?></option>
                    <?php
                }
                ?>
            </select>
            <span class="uk-text-danger"><?php echo form_error('txt_service_jenis'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="">&nbsp;</label>
        <div class="uk-form-controls uk-form-controls-text">
            <input type="submit" name="btn_simpan" id="btn_simpan" value="Simpan" class="uk-button uk-button-primary">
            <a href="<?php echo base_url("service/"); ?>" class="uk-button uk-button-danger">List Service</a>
        </div>
    </div>
</form>