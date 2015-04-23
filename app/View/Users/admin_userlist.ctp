<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<label class="col-sm-3 col-sm-3 control-label">User</label>
<div class="col-sm-9">
<?php  
echo $this->Form->input('User.user_id',array('type'=>'select','options'=>$user,"label"=>false));
?>
</div>