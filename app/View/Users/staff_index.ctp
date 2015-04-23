<?php  //   print_r($_SESSION['Auth']); 

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style>
    tr{
        height: 20px;
    }
</style>
<div id="content-padding">
    <table width="100%" cellpadding="5" cellspacing="5">
        <tr>
            <th>File</th> <th>Description</th><th>Upload Date</th>
        </tr>
        <?php $i=0; foreach ($file as $files ){ ?>
        <tr>
            <td><?php echo $this->Html->link($files['Upload']['filename'],'/app/webroot/files/uploads/'.$_SESSION['Auth']['User']['id'].'/'.$files['Upload']['filename']) ?></td> <td><?php echo $files['Upload']['description'] ?></td><td><?php echo $files['Upload']['created'] ?></td>
        </tr>
        <?php $i++; } ?>
    </table>
</div>