<?php
if(isset($err_msg))
{
    ?>
    <div class="uk-alert uk-alert-danger"><?php echo $err_msg; ?></div>
    <?php
}
?>
<form class="uk-form uk-form-horizontal tara-form" method="post" action="<?php echo base_url("auth/ubah_password"); ?>">
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_password_old">Password Lama</label>
        <div class="uk-form-controls">
            <input type="password" name="txt_password_old" id="txt_password_old" placeholder="Password Lama" autofocus="autofocus">
            <span class="uk-text-danger"><?php echo form_error('txt_password_old'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_password">Password Baru</label>
        <div class="uk-form-controls">
            <input type="password" name="txt_password" id="txt_password" placeholder="Password Baru">
            <span class="uk-text-danger"><?php echo form_error('txt_password'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="txt_password_conf">Password Confirm</label>
        <div class="uk-form-controls">
            <input type="password" name="txt_password_conf" id="txt_password_conf" placeholder="Password Confirm">
            <span class="uk-text-danger"><?php echo form_error('txt_password_conf'); ?></span>
        </div>
    </div>
    <div class="uk-form-row">
        <div class="uk-form-controls">
            <button class="uk-button uk-button-primary" name="btn_simpan" id="btn_simpan" value="btn_simpan">Simpan</button>
        </div>
    </div>
</form>