<?php
if(isset($err_msg))
{
    ?>
    <div class="uk-alert uk-alert-danger"><?php echo $err_msg; ?></div>
    <?php
}
?>
<form class="uk-form uk-form-horizontal tara-form" method="post" action="<?php echo base_url("transaksi"); ?>">
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_customer">Customer</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_customer" id="txt_customer">
            <!--
            <select name="opt_customer" id="opt_customer">
                <?php
                foreach($res_customer as $row_customer)
                {
                    $selected = ($row_customer->customer_nama == "umum") ? "selected=\"selected\"" : "";
                    ?>
                    <option value="<?php echo $row_customer->customer_id; ?>" <?php echo $selected; ?>><?php echo ucwords($row_customer->customer_nama); ?></option>
                    <?php
                }
                ?>
            </select>
            -->
            <span class="uk-text-danger"><?php echo form_error('txt_customer'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_pegawai">Pegawai</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_pegawai" id="txt_pegawai" value="<?php echo ucwords($this->session->userdata("pegawainama")); ?>" disabled="disabled">
            <span class="uk-text-danger"><?php echo form_error('opt_customer'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_tgl">Tanggal</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_tgl" id="txt_tgl" value="<?php echo date("d-m-Y"); ?>" disabled="disabled">
            <span class="uk-text-danger"><?php echo form_error('opt_customer'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="">&nbsp;</label>
        <div class="uk-form-controls uk-form-controls-text">
            <input type="submit" name="btn_simpan_head" id="btn_simpan_head" value="Pilih Customer" class="uk-button uk-button-primary">
        </div>
    </div>
</form>