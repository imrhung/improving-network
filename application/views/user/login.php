<?php echo form_open('login', array('class' => 'form-signin')) ?>


<img src="<?php echo base_url(); ?>assets/img/login_logo.png" class="img-responsive img-center" id="login-logo" alt="Greater Traveler" width="200">

<div class="<?php echo (form_error('identity')) ? 'error' : '' ?> form-group">

    <label for="identity" class="control-label"></label>
    <div class="">
        <?php echo form_input($identity) ?>
        <?php echo form_error('identity') ?>
    </div>

</div>
<div class="<?php echo (form_error('password')) ? 'error' : '' ?> form-group">

    <div class="">
        <?php echo form_input($password) ?>
        <?php echo form_error('password') ?>
    </div>

</div>

<div class="">
    <button id="btn_submit" class="btn tn-larbge btn-success btn-block" type="submit">Sign me in</button>
</div>
<hr>
<div class="checkbox">
    <label class="cb_rememberme">
        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"') ?> Keep me sign in
    </label>
</div>

<?php echo form_close() ?>
