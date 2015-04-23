<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style>
    #flashMessage{
        font-size: 15px;
    }
</style>
<fieldset style="border: solid 1px #000; width:500px; margin-left: 100px; margin-top: 100px;"><legend>Change Password</legend>
<div class="users form">

<?php echo $this->Form->create('User',array('action'=>'changepassword')); ?>

<?php echo $this->Form->input("User.old_password",array('type'=>'password')); ?>
<br><?php echo $this->Form->input("User.new_password",array('type'=>'password')); ?>
<br>
<?php echo $this->Form->input("User.conf_password",array('type'=>'password')); ?>
<br>
<?php echo $this->Form->end(__("Change Password")); ?>
</div>
</fieldset>