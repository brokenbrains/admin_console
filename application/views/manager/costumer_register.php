<div class="span10" id="content">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i> <a href="index.html">Management</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-plus"></i> <a href="#">Register New Customer</a>
        </li>
    </ul>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title="">
                <h2><i class="halflings-icon plus"></i><span class=
                "break"></span>Register New Customer</h2>
            </div>
            <div class="box-content">
            <?php if(isset($message)){echo $message;}?>
                <?php echo form_open( "access/customer_register_post", ['class' => 'std-form form-horizontal'] );?>
                    <fieldset>

                     <!-- <div class="control-group <?php if (form_error("user_id") !=='') { echo 'error'; } ?>" value="<?php echo set_value("user_id"); ?>">
                            <label class="control-label" for=
                            "user_id"">Customer ID</label>
                            <div class="controls">
                                <input class="input-xlarge" id="user_id"
                                name="user_id"" type="text">
                                <span class="help-inline"> <?php if (form_error("user_id") !=='') { echo form_error("user_id"); } ?></span>
                            </div>
                        </div> -->   

                        <div class="control-group <?php if (form_error("username") !=='') { echo 'error'; } ?>" value="<?php echo set_value("username"); ?>">
                            <label class="control-label" for=
                            "username">Username</label>
                            <div class="controls">
                                <input class="input-xlarge" id="username"
                                name="username" type="text">
                                <span class="help-inline"> <?php if (form_error("username") !=='') { echo form_error("username"); } ?></span>
                            </div>
                        </div>

                        <div class="control-group <?php if (form_error("pnum") !=='') { echo 'error'; } ?>" value="<?php echo set_value("pnum"); ?>">
                            <label class="control-label" for=
                            "pnum">Phone Number</label>
                            <div class="controls">
                                <input class="input-xlarge" id="pnum"
                                name="pnum" type="text">
                                <span class="help-inline"> <?php if (form_error("pnum") !=='') { echo form_error("pnum"); } ?></span>
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

                        <div class="control-group <?php if (form_error("bank_name") !=='') { echo 'error'; } ?>" value="<?php echo set_value("bank_name"); ?>">
                            <label class="control-label" for=
                            "bank_name">Bank Name</label>
                            <div class="controls">
                                <input class="input-xlarge" id="bank_name"
                                name="bank_name" type="text">
                                <span class="help-inline"> <?php if (form_error("bank_name") !=='') { echo form_error("bank_name"); } ?></span>
                            </div>
                        </div>

                        <div class="control-group <?php if (form_error("bank_no") !=='') { echo 'error'; } ?>" value="<?php echo set_value("bank_no"); ?>">
                            <label class="control-label" for=
                            "bank_no">Bank Account Number</label>
                            <div class="controls">
                                <input class="input-xlarge" id="bank_no"
                                name="bank_no" type="text">
                                <span class="help-inline"> <?php if (form_error("bank_no") !=='') { echo form_error("bank_no"); } ?></span>
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