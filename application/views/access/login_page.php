<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a href="index.html"><i class="halflings-icon home"></i></a>
						<a href="#"><i class="halflings-icon cog"></i></a>
					</div>
					<h2>Login to your account</h2>
					<?php 
					if( ! isset( $on_hold_message ) )
					{
						if( isset( $login_error_mesg ) )
						{
							echo '
								<div class="alert alert-error">
									<button type="button" class="close" data-dismiss="alert">X</button>
									<strong>Login Error #!</strong> ' . $this->authentication->login_errors_count . '/' . config_item('max_allowed_attempts') . ': Invalid Username, Email Address, or Password.<br>
									Username, email address and password are all case sensitive.
								</div>
							';
						}
					
						echo form_open( $login_url, ['class' => 'std-form'] );
					
					?>
					<fieldset>
						
						<div class="input-prepend" title="Username">
							<span class="add-on"><i class="halflings-icon user"></i></span>
							<input type="text" name="login_string" id="login_string" class="input-large span10" autocomplete="off" maxlength="255" placeholder="type username" />
						</div>
						<div class="clearfix"></div>

						<div class="input-prepend" title="Password">
							<span class="add-on"><i class="halflings-icon lock"></i></span>
							<input type="password" name="login_pass" id="login_pass" class="input-large span10" maxlength="<?php echo config_item('max_chars_for_password'); ?>" autocomplete="off" readonly="readonly" onfocus="this.removeAttribute('readonly');" placeholder="type password" />
						</div>
						<div class="clearfix"></div>
						<?php
							if( config_item('allow_remember_me') )
							{
						?>
				
							<br />
							<label class="remember" for="remember"><input type="checkbox" id="remember_me" value="yes"/>Remember me</label>
				
						<?php
							}
						?>
						
						

						<div class="button-login">	
							<input type="submit" name="submit" value="Login" id="submit_button" class="btn btn-primary" />
						</div>
						<div class="clearfix"></div>
					</fieldset>
					</form>
					<hr>
					<?php
						$link_protocol = USE_SSL ? 'https' : NULL;
					?>
					<h3>Forgot Password?</h3>
					<p>
						No problem, <a href="<?php echo site_url('examples/recover', $link_protocol); ?>">click here</a> to get a new password.
					</p>
					<?php

						}
						else
						{
							// EXCESSIVE LOGIN ATTEMPTS ERROR MESSAGE
							echo '
								<div style="border:1px solid red;">
									<p>
										Excessive Login Attempts
									</p>
									<p>
										You have exceeded the maximum number of failed login<br />
										attempts that this website will allow.
									<p>
									<p>
										Your access to login and account recovery has been blocked for ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes.
									</p>
									<p>
										Please use the <a href="/examples/recover">Account Recovery</a> after ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes has passed,<br />
										or contact us if you require assistance gaining access to your account.
									</p>
								</div>
							';
						}	
					?>
				</div><!--/span-->
			</div><!--/row-->
			

	</div><!--/.fluid-container-->
	
		</div><!--/fluid-row-->
