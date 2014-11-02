<?php echo form_open('forgot-password', array('class' => 'form-password-forgot')) ?>
	
	<h2 class="form-forgot-heading">Forgot password</h2>

	<p>Please enter your email address so we can send you an email to reset your password.</p>

	<p>&nbsp;</p>

	<div class="<?php echo (form_error('email')) ? 'error' : '' ?> form-group">
		<label class="control-label" for="email">Email</label>
		<div class="controls">
			<?php echo form_input(array('name' => 'email', 'class'=>'form-control', 'id' => 'email', 'value' => '', 'placeholder' => 'Your email address')) ?>
			<?php echo form_error('email') ?>
		</div>
	</div>
	
	
		<button id="btn_submit" class="btn btn-primary btn-lg" type="submit">Send me a new one</button>

		<p>&nbsp;</p>

		<p>or <a href="<?php echo site_url('login') ?>">log in</a></p>
	

<?php echo form_close() ?>
