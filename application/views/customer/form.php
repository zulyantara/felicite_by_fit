<?php
if(isset($err_msg))
{
    ?>
    <div class="uk-alert uk-alert-danger"><?php echo $err_msg; ?></div>
    <?php
}

$customer_id = "";
$customer_nama = "";
$customer_alamat = "";
$customer_telp = "";
if(isset($query_edit))
{
    $customer_id = $query_edit->customer_id;
    $customer_nama = $query_edit->customer_nama;
    $customer_alamat = $query_edit->customer_alamat;
    $customer_telp = $query_edit->customer_telp;
}
?>
<form class="uk-form uk-form-horizontal tara-form" method="post" action="<?php echo base_url("customer/data_baru"); ?>">
    <input type="hidden" name="txt_customer_id" id="txt_customer_id" value="<?php echo $customer_id; ?>">
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_customer_nama">Nama Customer</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_customer_nama" id="txt_customer_nama" placeholder="Nama Customer" value="<?php echo $customer_nama; ?>" autofocus="autofocus">
            <span class="uk-text-danger"><?php echo form_error('txt_customer_nama'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_customer_alamat">Alamat</label>
        <div class="uk-form-controls">
            <textarea name="txt_customer_alamat" id="txt_customer_alamat" cols="35" rows="3"><?php echo $customer_alamat; ?></textarea>
            <span class="uk-text-danger"><?php echo form_error('txt_customer_alamat'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_customer_telp">No. Telp</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_customer_telp" id="txt_customer_telp" placeholder="No. Telp" value="<?php echo $customer_telp; ?>">
            <span class="uk-text-danger"><?php echo form_error('txt_customer_telp'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="">&nbsp;</label>
        <div class="uk-form-controls uk-form-controls-text">
            <input type="submit" name="btn_simpan" id="btn_simpan" value="Simpan" class="uk-button uk-button-primary">
            <a href="<?php echo base_url("customer/"); ?>" class="uk-button uk-button-danger">List Customer</a>
        </div>
    </div>
</form>