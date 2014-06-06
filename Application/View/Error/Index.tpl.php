<?php
    $this->inherits('hoa://Application/View/Layout/Admin.tpl.php');
    $this->block('content');
        echo '<br /><div class="panel panel-danger">
        <div class="panel-heading">Error : '.$error.'</div>
        <div class="panel-body">'.$message.'</div>';
    $this->endBlock();
