<div class="span10" id="content">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i> <a href="index.html">Management</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-plus"></i> <a href="#">Register New User</a>
        </li>
    </ul>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title="">
                <h2><i class="halflings-icon plus"></i><span class=
                "break"></span>Register New User</h2>
            </div>
            <div class="box-content">
            <?php if($message!=null){echo $message;}?>
                <?php echo form_open( "access/user_register_post", ['class' => 'std-form form-horizontal'] );?>
                    <fieldset>
                        <div class="control-group <?php if (form_error("firstname") !=='') { echo 'error'; } ?>" value="<?php echo set_value("firstname"); ?>">
                            <label class="control-label" for=
                            "firstname">First Name</label>
                            <div class="controls">
                                <input class="input-xlarge" id="firstname"
                                name="firstname" type="text">
                            </div>
                        </div>
                        <div class="control-group <?php if (form_error("lastname") !=='') { echo 'error'; } ?>" value="<?php echo set_value("lastname"); ?>">
                            <label class="control-label" for=
                            "lastname">Last Name</label>
                            <div class="controls">
                                <input class="input-xlarge" id="lastname"
                                name="lastname" type="text">
                            </div>
                        </div>
                        <div class="control-group <?php if (form_error("username") !=='') { echo 'error'; } ?>" value="<?php echo set_value("username"); ?>">
                            <label class="control-label" for=
                            "username">Username</label>
                            <div class="controls">
                                <input class="input-xlarge" id="username"
                                name="username" type="text">
                                <span class="help-inline"> <?php if (form_error("username") !=='') { echo form_error("username"); } ?></span>
                            </div>
                        </div>
                        <div class="control-group <?php if (form_error("passwd") !=='') { echo 'error'; } ?>" value="<?php echo set_value("passwd"); ?>">
                            <label class="control-label" for=
                            "password">Password</label>
                            <div class="controls">
                                <input class="input-xlarge" id="password"
                                name="password" type="password">
                                 <span class="help-inline"> <?php if (form_error("passwd") !=='') { echo form_error("passwd"); } ?></span>
                            </div>
                        </div>
                        <div class="control-group <?php if (form_error("passwd1") !=='') { echo 'error'; } ?>" value="<?php echo set_value("passwd1"); ?>">
                            <label class="control-label" for=
                            "password1">Retype Password</label>
                            <div class="controls">
                                <input class="input-xlarge" id="password1"
                                name="password1" type="password">
                                 <span class="help-inline"> <?php if (form_error("passwd1") !=='') { echo form_error("passwd1"); } ?></span>
                            </div>
                        </div>
                        <div class="control-group <?php if (form_error("email") !=='') { echo 'error'; } ?>" value="<?php echo set_value("email"); ?>">
                            <label class="control-label" for=
                            "email">Email</label>
                            <div class="controls">
                                <input class="input-xlarge" id="email"
                                name="email" type="text">
                                <span class="help-inline"> <?php if (form_error("email") !=='') { echo form_error("email"); } ?></span>
                            </div>
                        </div>
                        <div class="control-group <?php if (form_error("auth_level") !=='') { echo 'error'; } ?>" value="<?php echo set_value("auth_level"); ?>">
                        
                            <label class="control-label" for=
                            "level">User Level</label>
                            <div class="controls">
                                <select  id="level" name="level">
                                    <option value="9">
                                        Administrator
                                    </option>
                                </select>
                                <?php if (form_error("auth_level") !=='') { echo form_error("auth_level"); } ?>
                            </div>
                        </div>
                        <div class="form-actions">
                        	<button class="btn btn-primary" type="submit">Register</button>
                            <button class="btn">Reset</button>
                        </div>
                    </fieldset>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>