<div class="container">
<?php echo $this->Form->create('User', array('action' => 'login',"class"=>"form-login")); ?>
    <?php echo $this->Session->flash();?>
    <h2 class="form-login-heading">sign in now</h2>
    <div class="login-wrap">
        <?php echo $this->Form->input('username', array('label' => '',"class"=>"form-control","placeholder"=>"Username","autofocus")); ?>
        <br>
        <?php echo $this->Form->input('password', array('label' => '',"class"=>"form-control","placeholder"=>"Password")); ?>
        <label class="checkbox">
            <span class="pull-right">
                &nbsp;
            </span>
        </label>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 col-md-offset-2">
                        <input type="radio" name="_login" checked="checked" id="_staff" />
                    </div>
                    <div class="col-md-8">
                        Staff
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 col-md-offset-2">
                        <input type="radio" name="_login" id="_client" />
                    </div>
                    <div class="col-md-8">
                        Client
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 col-md-offset-2">
                        <input type="radio" name="_login" id="_admin" />
                    </div>
                    <div class="col-md-8">
                        Admin
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
        <hr>
    </div>
    <?php echo $this->Form->end();?>
</div>

<script>
    $(document).ready( function () {
        _webroot = '<?php echo $this->webroot ?>';
        $('#_client').click( function() {
            $('#UserLoginForm').attr('action', _webroot + 'client');
        });
        $('#_staff').click( function() {
            $('#UserLoginForm').attr('action', _webroot + 'staff');
        });
        $('#_admin').click( function() {
            $('#UserLoginForm').attr('action', _webroot + 'admin');
        });
    });
</script>