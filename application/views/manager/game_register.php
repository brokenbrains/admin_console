<div class="span10" id="content">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i> <a href="index.html">Management</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-plus"></i> <a href="#">Register New Game</a>
        </li>
    </ul>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title="">
                <h2><i class="halflings-icon plus"></i><span class=
                "break"></span>Register New Game</h2>
            </div>
            <div class="box-content">
            <?php if(isset($message)){echo $message;}?>
                <?php echo form_open( "access/game_register_post", ['class' => 'std-form form-horizontal'] );?>
                    <fieldset>
                    
                        <div class="control-group <?php if (form_error("game_id") !=='') { echo 'error'; } ?>" value="<?php echo set_value("game_id"); ?>">
                            <label class="control-label" for=
                            "game_id">Game ID</label>
                            <div class="controls">
                                <input class="input-xlarge" id="game_id"
                                name="game_id" type="text">
                            </div>
                        </div>
                        
                        <div class="control-group <?php if (form_error("game_name") !=='') { echo 'error'; } ?>" value="<?php echo set_value("game_name"); ?>">
                            <label class="control-label" for=
                            "game_name">Game Name</label>
                            <div class="controls">
                                <input class="input-xlarge" id="game_name"
                                name="game_name" type="text">
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